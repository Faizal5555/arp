<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Validator;
use App\Models\BusinessResearch;
use App\Models\BusinessTeamMember;
use App\Models\BusinessResearchQuestion;
use Carbon\Carbon;
use Yajra\DataTables\Facades\DataTables;
use Auth;
use App\Exports\SearchedDataExport;
use Maatwebsite\Excel\Facades\Excel;

class BusinessResearchController extends Controller
{
    //

    public function create()
    {   
        $user_id = auth()->user()->id;
        $team_member= User::where('user_type', 'business_team_member')->get();
        $today_date_input = now()->format('Y-m-d');
        return view('business.create',compact('user_id','team_member','today_date_input'));
    }

    public function store(Request $request)
{    
    
    $validator = Validator::make($request->all(), [
        'userid' => 'required|exists:users,id',
        'date' => 'required|date',
        'pn_number' => 'required|string',
        'subject_line' => 'required|string',
        'client_name' => 'required|string',
        'industry' => 'nullable|string',
        'others' => 'nullable|string',
        'users' => 'nullable|array',
        'users.*' => 'exists:users,id',
        'attachments.*' => 'file|mimes:pdf,doc,docx,xlsx,jpg,jpeg,png|max:5120', 
    ]);

    if ($validator->fails()) {
        return response()->json([
            'success' => false,
            'message' => 'Validation errors',
            'errors' => $validator->errors()
        ], 422);
    }

    // Create Business Research
    $businessResearch = new BusinessResearch();
    $businessResearch->user_id = $request->userid;
    $businessResearch->date = $request->date;
    $businessResearch->pn_number = $request->pn_number;
    $businessResearch->subject_line = $request->subject_line;
    $businessResearch->client_name = $request->client_name;
    $businessResearch->industry = $request->industry;
    $businessResearch->others = $request->others;
    $businessResearch->save();

    $attachmentPaths = [];
    if ($request->hasFile('attachments')) {
        $attachmentPaths = [];
    
        foreach ($request->file('attachments') as $file) {
            $filename = time() . '_' . $file->getClientOriginalName();
            $path = $file->storeAs('attachments', $filename, 'public'); // saves under storage/app/public/attachments
            $attachmentPaths[] = $path;
        }
    
        // Save as a comma-separated string
        $businessResearch->attachments = implode(',', $attachmentPaths);
        $businessResearch->save();
    }

    // Assign Team Members if present
    if ($request->has('users')) {
        foreach ($request->users as $userId) {
            $teamMember = new BusinessTeamMember();
            $teamMember->business_research_id = $businessResearch->id;
            $teamMember->user_id = $userId;
            $teamMember->save();
        }
    }

    return response()->json([
        'success' => true,
        'message' => 'Project created successfully'
    ]);
  }

    public function index(Request $request)
    {  
        if ($request->ajax()) {
            $data = BusinessResearch::with('teamMembers')->where('status','next')->latest()->get(); // eager load relationship if any
    
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('date', function($row) {
                    return \Carbon\Carbon::parse($row->date)->format('d-m-Y');
                })
                ->addColumn('team_members', function ($row) {
                    return $row->teamMembers->map(function ($member) {
                        return optional($member->user)->name;
                    })->implode(', ');
                })
               
                ->make(true);
        }

        $team_members = User::where('user_type', 'business_team_member')->get();
        
    
        return view('business.index',compact('team_members'));
    }

    public function edit($id)
    {
        $record = BusinessResearch::with('teamMembers')->findOrFail($id);
        return response()->json([
            'id' => $record->id,
            'date' => $record->date,
            'pn_number' => $record->pn_number,
            'subject_line' => $record->subject_line,
            'industry' => $record->industry,
            'client_name' => $record->client_name,
            'others' => $record->others,
            'team_members' => $record->teamMembers->pluck('user_id'),
            
        ]);
       
    }

    public function update(Request $request, $id)
    {
        // 1. Validate request
        $request->validate([
            'industry' => 'required|string',
            'pn_number' => 'nullable|string',
            'subject_line' => 'nullable|string',
            'client_name' => 'nullable|string',
            'others' => 'nullable|string',
            'date' => 'required|date',
            'team_members' => 'nullable|array',
            'team_members.*' => 'exists:users,id'
        ]);

        // 2. Find the business research
        $businessResearch = BusinessResearch::findOrFail($id);

        // 3. Update business_research table
        $businessResearch->update([
            'industry' => $request->industry,
            'pn_number' => $request->pn_number,
            'subject_line' => $request->subject_line,
            'client_name' => $request->client_name,
            'others' => $request->others,
            'date' => $request->date,
        ]);

      
        $currentTeamMembers = BusinessTeamMember::where('business_research_id', $id)->pluck('user_id')->toArray();

        // IDs coming from the form/request
        $newTeamMembers = $request->team_members ?? [];
        
        // Find users to delete (those not in the new list)
        $toDelete = array_diff($currentTeamMembers, $newTeamMembers);
        if (!empty($toDelete)) {
            BusinessTeamMember::where('business_research_id', $id)
                ->whereIn('user_id', $toDelete)
                ->delete();
        }
        
        // Find users to add (those not already assigned)
        $toAdd = array_diff($newTeamMembers, $currentTeamMembers);
        foreach ($toAdd as $userId) {
            BusinessTeamMember::create([
                'business_research_id' => $id,
                'user_id' => $userId,
            ]);
        }
       
        return response()->json(['success' => true, 'message' => 'Project updated successfully.']);
    }

    public function destroy($id)
    {
        $research = BusinessResearch::findOrFail($id);
        BusinessTeamMember::where('business_research_id', $id)->delete();
        $research->delete(); 
        return response()->json(['success' => true, 'message' => 'Project deleted successfully.']);
    }


        public function closeProject($id)
    {
        $project = BusinessResearch::findOrFail($id);
        $project->status = 'Closed';
        $project->save();

        return response()->json(['message' => 'Project has been closed successfully.']);
    }


    public function closed(Request $request)
    {   
        if ($request->ajax()) {
            $data = BusinessResearch::with('teamMembers')->where('status','closed')->latest()->get(); // eager load relationship if any
    
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('date', function($row) {
                    return \Carbon\Carbon::parse($row->date)->format('d-m-Y');
                })
                ->addColumn('team_members', function ($row) {
                    return $row->teamMembers->map(function ($member) {
                        return optional($member->user)->name;
                    })->implode(', ');
                })
               
                ->make(true);
        }

        $team_members = User::where('user_type', 'business_team_member')->get();

        return view('business.closed', compact('team_members'));
    }



    public function teamclosed(Request $request)
    {   
        if ($request->ajax()) {
            $authUserId = auth()->id();

            $data = BusinessResearch::with('teamMembers.user')
                ->where('status', 'closed')
                ->whereHas('teamMembers', function ($query) use ($authUserId) {
                    $query->where('user_id', $authUserId);
                })
                ->latest()
                ->get();
    
    
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('date', function($row) {
                    return \Carbon\Carbon::parse($row->date)->format('d-m-Y');
                })
                ->addColumn('team_members', function ($row) {
                    return $row->teamMembers->map(function ($member) {
                        return optional($member->user)->name;
                    })->implode(', ');
                })
               
                ->make(true);
        }

        $team_members = User::where('user_type', 'business_team_member')->get();

        return view('business_team.closed', compact('team_members'));
    }
    


    public function team()
    {   
        $data = BusinessResearch::with('teamMembers')->where('status','next')->latest()->get(); // eager load relationship if any
        return view('business_team.index');
    }




    public function getAllocatedProjects(Request $request)
    {
        $userId = auth()->user()->id;
    
        // Get only the projects allocated to the logged-in user
        $projects = BusinessResearch::whereHas('teamMembers', function ($query) use ($userId) {
                $query->where('user_id', $userId);
            })
            ->where('status', 'next')
            ->with(['teamMembers' => function ($query) use ($userId) {
                $query->where('user_id', $userId); // Only include logged-in user's team member record
            }, 'teamMembers.user'])
            ->orderBy('id', 'desc')
            ->get();
    
        return datatables()->of($projects)
            ->addIndexColumn()
            ->addColumn('date', function ($row) {
                return \Carbon\Carbon::parse($row->date)->format('d-m-Y');
            })
            ->addColumn('team_members', function ($row) {
                // Only show the current logged-in user’s name
                return $row->teamMembers->map(function ($member) {
                    return optional($member->user)->name;
                })->implode(', ');
            })// Make sure action buttons are rendered as HTML
            ->make(true);
    }




    public function getProjects(Request $request, $id)
    {

        $record = BusinessResearch::with('teamMembers.user')->findOrFail($id);
        $businessResearch = BusinessResearch::findOrFail($id);
        $teamMember = BusinessTeamMember::find($request->team_member_id);
        $selectedTeamMemberId = $request->team_member_id;

        return view('business.show', compact('record','businessResearch','teamMember','selectedTeamMemberId' ));
        
    }


    public function questions(Request $request)
    {
        $teamMember = BusinessTeamMember::find($request->team_member_id);
        $questions = BusinessResearchQuestion::where('business_research_id', $request->research_id)
            ->where('user_id', $teamMember->user_id)
            ->get();
    return view('business.business_data', compact('questions'));
    }


       

    public function show($id)
    {
        $record = BusinessResearch::with([
            'teamMembers.user', 
            'questions' => function ($query) {
                $query->where('user_id', Auth::id());
            }
        ])->findOrFail($id);
     
        $authUserId = Auth::id();

        // Optional: check if allocated
        $isOwner = $record->userid == $authUserId;
        $isAllocatedMember = $record->teamMembers->contains('user_id', $authUserId);
        
        if (!$isOwner && !$isAllocatedMember) {
            $message = 'You are not an allocated team member for this project.';
            return view('business_team.not_allocated', compact('message'));
        }
        
        return view('business_team.show', compact('record', 'authUserId'));
      
    }

    public function storeQuestions(Request $request, $businessResearchId)
{   
    //  dd($request->all());
    $request->validate([
        'que' => 'required|array',
        'ans' => 'required|array',
        'attachment.*' => 'nullable|file|mimes:jpg,jpeg,png,pdf,docx,doc,xlsx',
        'question_id' => 'nullable|array',
    ]);

    if ($request->filled('team_member_id')) {
        $teamMember = BusinessTeamMember::find($request->team_member_id);
        $userId = $teamMember ? $teamMember->user_id : auth()->id(); // fallback just in case
    } else {
        $userId = auth()->id();
    }

    $questionIds = $request->question_id ?? [];
    $questions = $request->que ?? [];
    $answers = $request->ans ?? [];
    
    
    $submittedIds = [];
    foreach ($questionIds as $index => $id) {
        // Check if corresponding question/answer exists at same index
        if (!empty($questions[$index]) || !empty($answers[$index])) {
            $submittedIds[] = $id;
        }
    }
    
    $existingIds = BusinessResearchQuestion::where('business_research_id', $businessResearchId)->pluck('id')->toArray();
    $idsToDelete = array_diff($existingIds, $submittedIds);
    
    if (!empty($idsToDelete)) {
        BusinessResearchQuestion::whereIn('id', $idsToDelete)->delete();
    }
    foreach ($request->que as $index => $questionText) {
        $questionId = $request->question_id[$index] ?? null;

        $attachmentPath = null;
        if ($request->hasFile("attachment.$index")) {
            $file = $request->file("attachment.$index");
            $filename = time() . '_' . $file->getClientOriginalName();
            $attachmentPath = $file->storeAs('attachments', $filename, 'public');
        }

        if ($questionId) {
            // Update existing
            $existingQuestion = BusinessResearchQuestion::where('id', $questionId)
            ->where('user_id', $userId)
            ->first();

            if ($existingQuestion) {
                $updateData = [
                    'question' => $questionText,
                    'answer' => $request->ans[$index],
                ];

                if ($attachmentPath) {
                    $updateData['attachment'] = $attachmentPath;
                }

                $existingQuestion->update($updateData);
            }
        } else {
            // Create new
            $createData = [
                'business_research_id' => $businessResearchId,
                'user_id' => $userId,
                'question' => $questionText,
                'answer' => $request->ans[$index],
            ];

            if ($attachmentPath) {
                $createData['attachment'] = $attachmentPath;
            }

            BusinessResearchQuestion::create($createData);
        }
    }


    return redirect()->back()->with('success', 'Questions and answers saved successfully.');
}


public function secondarySearch(Request $request)
{
    $keyword = $request->input('keyword');
    $clientName = $request->input('client_name');
    $industry = $request->input('industry');
    $pnNumber = $request->input('pn_number');

    $query = BusinessResearch::with(['teamMembers.user', 'questions']);

    if ($keyword) {
        $query->where(function ($q) use ($keyword) {
            $q->where('client_name', 'LIKE', "%{$keyword}%")
              ->orWhere('pn_number', 'LIKE', "%{$keyword}%")
              ->orWhere('subject_line', 'LIKE', "%{$keyword}%")
              ->orWhere('industry', 'LIKE', "%{$keyword}%")
              ->orWhereHas('questions', function ($qa) use ($keyword) {
                  $qa->where('question', 'LIKE', "%{$keyword}%")
                     ->orWhere('answer', 'LIKE', "%{$keyword}%");
              });
        });
    }

    if ($clientName) {
        $query->where('client_name', 'LIKE', "%{$clientName}%");
    }

    if ($industry) {
        $query->where('industry', 'LIKE', "%{$industry}%");
    }

    if ($pnNumber) {
        $query->where('pn_number', 'LIKE', "%{$pnNumber}%");
    }

    $results = $query->get();

    // Send distinct client names and industries for dropdown
    $clientNames = BusinessResearch::select('client_name')->distinct()->pluck('client_name');
    $industries = BusinessResearch::select('industry')->distinct()->pluck('industry');

    if ($request->ajax()) {
        return view('business_secondary.search_results', compact('results', 'keyword'));
    } else {
        return view('business_secondary.bm_secondary_dashboard', compact('results', 'keyword', 'clientNames', 'industries'));
    }
}

public function exportSearchResults(Request $request)
{
    // Apply the same logic as your search to filter data
    $results = BusinessResearch::with(['questions', 'teamMembers.user'])
    ->when($request->filled('keyword'), function ($query) use ($request) {
        $query->where(function ($q) use ($request) {
            $q->where('subject_line', 'like', '%' . $request->keyword . '%')
              ->orWhere('pn_number', 'like', '%' . $request->keyword . '%');
        });
    })
    ->when($request->filled('client_name'), fn($q) => $q->where('client_name', 'like', '%' . $request->client_name . '%'))
    ->when($request->filled('industry'), fn($q) => $q->where('industry', 'like', '%' . $request->industry . '%'))
    ->when($request->filled('pn_number'), fn($q) => $q->where('pn_number', $request->pn_number))
    ->get();

return Excel::download(new SearchedDataExport($results), 'searched_data.xlsx');
}
    
}

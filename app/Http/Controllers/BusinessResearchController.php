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
use DB;
use App\Imports\ProjectImport;
use App\Exports\SearchedDataExport;
use Maatwebsite\Excel\Facades\Excel;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use PhpOffice\PhpSpreadsheet\Cell\DataValidation;
use PhpOffice\PhpSpreadsheet\NamedRange;


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
        'feasibility_done' => 'required|boolean',
        'attachment.*' => 'nullable|file|max:20480|mimes:jpg,jpeg,png,pdf,docx,doc,xlsx,mp4,mov,avi,mp3,wav,m4a',

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
    $businessResearch->feasibility_done = $request->feasibility_done;
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
            'feasibility_done' => $record->feasibility_done, 
            
            
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
            'team_members.*' => 'exists:users,id',
            'feasibility_done' => 'required|boolean',
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
            'feasibility_done' => $request->feasibility_done,
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

        // $record = BusinessResearch::with('teamMembers.user')->findOrFail($id);
        // $businessResearch = BusinessResearch::findOrFail($id);
        // $teamMember = BusinessTeamMember::find($request->team_member_id);
        // $selectedTeamMemberId = $request->team_member_id;
       


        // return view('business.show', compact('record','businessResearch','teamMember','selectedTeamMemberId' ));
        $businessResearch = BusinessResearch::findOrFail($id);

        // Load related team members with users
        $record = BusinessResearch::with(['teamMembers.user'])->findOrFail($id);
    
        $teamData = [];
    
        foreach ($record->teamMembers as $member) {
            $questions = BusinessResearchQuestion::where('business_research_id', $id)
                ->where('user_id', $member->user_id)
                ->get();
    
            $teamData[] = [
                'id' => $member->id,
                'member' => $member->user->name,
                'user_id' => $member->user_id,
                'questions' => $questions
            ];
        }
       
        return view('business.show', compact('record', 'businessResearch', 'teamData'));
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
        $request->validate([
            'que' => 'required|array',
            'ans' => 'required|array',
            'attachment.*.*' => 'nullable|file|mimes:jpg,jpeg,png,pdf,docx,doc,xlsx,mp4,mov,avi,mp3,wav,m4a|max:20480',
            'question_id' => 'nullable|array',
        ]);
    
        $que = $request->input('que');
        $isGrouped = is_array(reset($que)); // true if format is que[userid][]
    
        if ($isGrouped) {
            foreach ($que as $userId => $questions) {
                $answers = $request->ans[$userId] ?? [];
                $questionIds = $request->question_id[$userId] ?? [];
                $attachments = $request->file("attachment.$userId") ?? [];
    
                $existingIds = BusinessResearchQuestion::where('business_research_id', $businessResearchId)
                    ->where('user_id', $userId)
                    ->pluck('id')
                    ->toArray();
    
                $submittedIds = [];
    
                foreach ($questions as $index => $questionText) {
                    if (is_array($questionText)) {
                        $questionText = implode(', ', $questionText);
                    }
    
                    $answer = $answers[$index] ?? null;
                    if (is_array($answer)) {
                        $answer = implode(', ', $answer);
                    }
                    
                    if (empty(trim($questionText)) && empty(trim($answer))) {
                        continue;
                    }
                    $questionId = $questionIds[$index] ?? null;
    
                    $attachmentPath = null;
                    if (isset($attachments[$index]) && $attachments[$index] instanceof \Illuminate\Http\UploadedFile) {
                        $file = $attachments[$index];
                        $filename = time() . '_' . $file->getClientOriginalName();
                        $attachmentPath = $file->storeAs('attachments', $filename, 'public');
                    }
    
                    if ($questionId) {
                        $submittedIds[] = $questionId;
    
                        $existing = BusinessResearchQuestion::where('id', $questionId)
                            ->where('user_id', $userId)
                            ->first();
    
                        if ($existing) {
                            $existing->update([
                                'question' => $questionText,
                                'answer' => $answer,
                                'attachment' => $attachmentPath ?? $existing->attachment,
                            ]);
                        }
                    } else {
                        BusinessResearchQuestion::create([
                            'business_research_id' => $businessResearchId,
                            'user_id' => $userId,
                            'question' => $questionText,
                            'answer' => $answer,
                            'attachment' => $attachmentPath,
                        ]);
                    }
                }
    
                $idsToDelete = array_diff($existingIds, $submittedIds);
                if (!empty($idsToDelete)) {
                    BusinessResearchQuestion::whereIn('id', $idsToDelete)->delete();
                }
            }
        } else {
            $userId = auth()->id();
            $questions = $request->que;
            $answers = $request->ans;
            $questionIds = $request->question_id ?? [];
            $attachments = $request->file('attachment') ?? [];
    
            $existingIds = BusinessResearchQuestion::where('business_research_id', $businessResearchId)
                ->where('user_id', $userId)
                ->pluck('id')
                ->toArray();
    
            $submittedIds = [];
    
            foreach ($questions as $index => $questionText) {
                if (is_array($questionText)) {
                    $questionText = implode(', ', $questionText);
                }
    
                $answer = $answers[$index] ?? null;
                if (is_array($answer)) {
                    $answer = implode(', ', $answer);
                }

                // if (empty(trim($questionText)) && empty(trim($answer))) {
                //     continue;
                // }
    
                $questionId = $questionIds[$index] ?? null;
    
                $attachmentPath = null;
                if (isset($attachments[$index])) {
                    if (is_array($attachments[$index])) {
                        foreach ($attachments[$index] as $file) {
                            if ($file instanceof \Illuminate\Http\UploadedFile) {
                                $filename = time() . '_' . $file->getClientOriginalName();
                                $attachmentPath = $file->storeAs('attachments', $filename, 'public');
                            }
                        }
                    } elseif ($attachments[$index] instanceof \Illuminate\Http\UploadedFile) {
                        $file = $attachments[$index];
                        $filename = time() . '_' . $file->getClientOriginalName();
                        $attachmentPath = $file->storeAs('attachments', $filename, 'public');
                    }
                }
                if ($questionId) {
                    $submittedIds[] = $questionId;
    
                    $existing = BusinessResearchQuestion::where('id', $questionId)
                        ->where('user_id', $userId)
                        ->first();
    
                    if ($existing) {
                        $existing->update([
                            'question' => $questionText,
                            'answer' => $answer,
                            'attachment' => $attachmentPath ?? $existing->attachment,
                        ]);
                    }
                } else {
                    BusinessResearchQuestion::create([
                        'business_research_id' => $businessResearchId,
                        'user_id' => $userId,
                        'question' => $questionText,
                        'answer' => $answer,
                        'attachment' => $attachmentPath,
                    ]);
                }
            }
    
            $idsToDelete = array_diff($existingIds, $submittedIds);
            if (!empty($idsToDelete)) {
                BusinessResearchQuestion::whereIn('id', $idsToDelete)->delete();
            }
        }
    
        return redirect()->back()->with('success', 'Q&A saved successfully.');
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
    $keyword = $request->keyword;

    $results = BusinessResearch::with(['questions', 'teamMembers.user'])
        ->when($request->filled('keyword'), function ($query) use ($request) {
            $query->where('pn_number', 'like', '%' . $request->keyword . '%') // Ensure pn_number is searched
                  ->orWhere('client_name', 'like', '%' . $request->keyword . '%')
                  ->orWhere('industry', 'like', '%' . $request->keyword . '%')
                  ->orWhereHas('questions', function ($q) use ($request) {
                      $q->where('question', 'like', '%' . $request->keyword . '%')
                        ->orWhere('answer', 'like', '%' . $request->keyword . '%');
                  });
        })
        ->when($request->filled('client_name'), fn($q) => $q->where('client_name', 'like', '%' . $request->client_name . '%'))
        ->when($request->filled('industry'), fn($q) => $q->where('industry', 'like', '%' . $request->industry . '%'))
        ->when($request->filled('pn_number'), fn($q) => $q->where('pn_number', 'like', '%' . $request->pn_number . '%')) // Make sure pn_number filtering works
        ->get();

    return Excel::download(new SearchedDataExport($results, $keyword), 'searched_data.xlsx');
}


public function filter(Request $request)
{
    $query = BusinessResearch::query();

    if ($request->start_date && $request->end_date) {
        $query->whereBetween('created_at', [$request->start_date, $request->end_date]);
    }

    if ($request->industry) {
        $query->where('industry', $request->industry);
    }

    // ✅ Get industry data from the filtered query, not the whole table
    // $statusData = BusinessResearch::select('type', DB::raw('count(*) as total'))
    // ->whereIn('status', ['next', 'closed'])
    // ->groupBy('status')
    // ->get();

    $clientCount = $query->distinct('client_name')->count('client_name');
    $projectCount = $query->count();
    $closedProjectCount = $query->where('status', 'Closed')->count();

    $teamMembersCount = User::where('user_type', 'business_team_member')->count();

    return response()->json([
        'clientCount' => $clientCount,
        'projectCount' => $projectCount,
        'teamMembersCount' => $teamMembersCount,
        'closedProjectCount' => $closedProjectCount
    ]);
}

public function generateSampleFile()
{
    $spreadsheet = new Spreadsheet();
    $sheet = $spreadsheet->getActiveSheet();

    // Set headers
    $headers = [
        'A1' => 'date',
        'B1' => 'pn_number',
        'C1' => 'subject_line',
        'D1' => 'client_name',
        'E1' => 'industry',
        'F1' => 'team_members',
        'G1' => 'others',
    ];

    foreach ($headers as $cell => $value) {
        $sheet->setCellValue($cell, $value);
    }

    // Sample data
    $sample = [
        'A2' => now()->format('Y-m-d'),
        'B2' => '12345',
        'C2' => 'Sample Subject',
        'D2' => 'Sample Client',
        'E2' => 'Technology Industry',
        'F2' => 'John Doe, Jane Smith',
        'G2' => 'Test',
    ];

    foreach ($sample as $cell => $value) {
        $sheet->setCellValue($cell, $value);
    }

    // 🔁 Pass the spreadsheet, not just sheet
    $this->applyDropdownValidationForIndustry($spreadsheet, $sheet, 2, 100);

    // Save the file
    $fileName = 'project_sample_file.xlsx';
    $filePath = public_path("assets/$fileName");
    $writer = new Xlsx($spreadsheet);
    $writer->save($filePath);

    return response()->download($filePath)->deleteFileAfterSend(false);
}

private function applyDropdownValidationForIndustry(Spreadsheet $spreadsheet, Worksheet $sheet, int $startRow, int $endRow)
{
    $industries = [
        "Manufacturing Industry", "Production Industry", "Food Industry", "Agricultural Industry",
        "Technology Industry", "Construction Industry", "Factory Industry", "Mining Industry",
        "Finance Industry", "Retail Industry", "Engineering Industry", "Marketing Industry",
        "Education Industry", "Transport Industry", "Chemical Industry", "Healthcare Industry",
        "Hospitality Industry", "Energy Industry", "Science Industry", "Waste Industry",
        "Chemistry Industry", "Teritiary Sector Industry", "Real Estate Industry",
        "Financial Services Industry", "Telecommunications Industry", "Distribution Industry",
        "Medical Device Industry", "Biotechnology Industry", "Aviation Industry", "Insurance Industry",
        "Trade Industry", "Stock Market Industry", "Electronics Industry", "Textile Industry",
        "Computers and Information Technology Industry", "Market Research Industry", "Machine Industry",
        "Recycling Industry", "Information and Communication Technology Industry", "E- Commerce Industry",
        "Research Industry", "Rail Transport Industry", "Food Processing Industry", "Small Business Industry",
        "Wholesale Industry", "Pulp and Paper Industry", "Vehicle Industry", "Steel Industry",
        "Renewable Energy Industry"
    ];

    // Create hidden sheet for dropdown values
    $dropdownSheet = new Worksheet($spreadsheet, 'Dropdowns');
    $spreadsheet->addSheet($dropdownSheet);
    $spreadsheet->setActiveSheetIndex(0); // Return to main sheet

    // Fill industries in column A
    foreach ($industries as $i => $industry) {
        $dropdownSheet->setCellValue("A" . ($i + 1), $industry);
    }

    // Create named range for dropdown
    $namedRange = new NamedRange('IndustryOptions', $dropdownSheet, '$A$1:$A$' . count($industries));
    $spreadsheet->addNamedRange($namedRange);

    // Apply dropdown to E2:E100
    for ($row = $startRow; $row <= $endRow; $row++) {
        $cell = "E$row";
        $validation = $sheet->getCell($cell)->getDataValidation();
        $validation->setType(DataValidation::TYPE_LIST);
        $validation->setErrorStyle(DataValidation::STYLE_STOP);
        $validation->setAllowBlank(false);
        $validation->setShowDropDown(true);
        $validation->setFormula1('=IndustryOptions');
        $sheet->getCell($cell)->setDataValidation($validation);
    }

    // Hide the sheet from user
    $dropdownSheet->setSheetState(Worksheet::SHEETSTATE_HIDDEN);
}
public function importProjectData(Request $request)
{
    $validator = Validator::make($request->all(), [
        'file' => 'required|mimes:xlsx,xls,csv|max:2048',
    ]);

    if ($validator->fails()) {
        return back()->withErrors($validator)->withInput();
    }

    try {
        Excel::import(new ProjectImport, $request->file('file'));
        return back()->with('success', 'Project data imported successfully.');
    } catch (\Maatwebsite\Excel\Validators\ValidationException $e) {
        $failures = $e->failures();
        $messages = [];

        foreach ($failures as $failure) {
            $messages[] = "Row {$failure->row()}, Attribute: {$failure->attribute()} - " . implode(', ', $failure->errors());
        }

        return back()->withErrors(['file' => $messages]);
    } catch (\Exception $e) {
        return back()->withErrors(['file' => 'Import failed: ' . $e->getMessage()]);
    }
}




public function getIndustryData(Request $request)
{
    $industry = $request->input('industry');
    $authUserId = $request->input('user_id'); // Get logged-in user ID from the request

    // Get unique client count based on the selected industry
    $clientCount = BusinessResearch::where('industry', $industry)
        ->distinct('client_name')
        ->count('client_name');

    // Get projects where the logged-in user is the owner
    $ownedProjectCount = BusinessResearch::where('user_id', $authUserId)
        ->where('industry', $industry)
        ->count();

    // Get projects where the logged-in user is an allocated team member
    $allocatedProjectCount = BusinessResearch::whereHas('teamMembers', function ($query) use ($authUserId) {
            $query->where('user_id', $authUserId);
        })
        ->where('industry', $industry)
        ->count();

        $closedProjectCount = BusinessResearch::where(function ($query) use ($authUserId) {
            $query->where('user_id', $authUserId)
                  ->orWhereHas('teamMembers', function ($q) use ($authUserId) {
                      $q->where('user_id', $authUserId);
                  });
        })
        ->where('industry', $industry)
        ->where('status', 'Closed') // Only closed projects
        ->count();

    // Total projects: owned + allocated
    $totalProjectCount = $ownedProjectCount + $allocatedProjectCount;

    return response()->json([
        'clientCount' => $clientCount,
        'projectCount' => $totalProjectCount,
        'closedProjectCount' => $closedProjectCount
    ]);
}


public function filterProjectsAndClients(Request $request)
{
    $startDate = $request->input('start_date');
    $endDate = $request->input('end_date');
    $authUserId = auth()->id(); // Get logged-in user ID

    // Get project IDs (business_research_id) assigned to the logged-in user
    $allocatedProjectIds = BusinessTeamMember::where('user_id', $authUserId)
                                             ->pluck('business_research_id')
                                             ->toArray();

    // Get all team members working on these projects
    $teamMemberIds = BusinessTeamMember::whereIn('business_research_id', $allocatedProjectIds)
                                       ->pluck('user_id')
                                       ->toArray();

    // Include logged-in user
    $teamMemberIds[] = $authUserId;

    // Count distinct projects allocated to the logged-in user and their team
    $projectsCount = BusinessResearch::whereIn('id', $allocatedProjectIds)
                                      ->whereBetween('created_at', [$startDate, $endDate])
                                      ->distinct('id')
                                      ->count('id');

    // Count distinct client_name for these projects
    $clientsCount = BusinessResearch::whereIn('id', $allocatedProjectIds)
                                     ->whereBetween('created_at', [$startDate, $endDate])
                                     ->distinct('client_name')
                                     ->count('client_name');

    $closedProjectsCount = BusinessResearch::whereIn('id', $allocatedProjectIds)
    ->whereBetween('created_at', [$startDate, $endDate])
    ->where('status', 'Closed') // Only closed projects
    ->distinct('id')
    ->count('id');

    return response()->json([
        'projectsCount' => $projectsCount,
        'clientsCount' => $clientsCount,
        'closedProjectsCount' => $closedProjectsCount
    ]);
}
    
}

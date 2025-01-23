<?php

namespace App\Http\Controllers;
use App\Models\ProjectFeasibility;

use Illuminate\Http\Request;

class ProjectFeasibilityController extends Controller
{
    //
    public function create()
    
    {    
        $user_id = auth()->user()->id;
        return view('project_feasibility.create',compact('user_id'));
    }

    public function store(Request $request)
{    

     //dd($request->all());
    // Validate the request
    $validated = $request->validate([
        'date' => 'required|date',
        'pn_number' => 'required|string|max:255',
        'email_subject_line' => 'required|string|max:255',
        'project_launch_date' => 'required|date',
        'target_countries' => 'required|array',
        'target_countries.*' => 'required|string|max:255',
        'responded_titles' => 'required|array',
        'responded_titles.*' => 'required|string|max:255',
        'no_of_sample_required' => 'required|integer',
        'no_of_sample_delivered' => 'required|integer',
        'incentive_promised' => 'required|string',
        'responded_email' => 'required|array',
        'responded_email.*' => 'required|email|max:255',
        'userid' => 'required|exists:users,id', 
        'total_incentive_paid' => 'required|string', // New field
        'incentive_paid_date' => 'required|date', // New field
        'mode_of_payment' => 'required|string|max:255', // New field
    ]);

    //dd($request->all());

    // Save the data
   ProjectFeasibility::create([
    'date' => $validated['date'],
    'pn_number' => $validated['pn_number'],
    'email_subject_line' => $validated['email_subject_line'],
    'project_launch_date' => $validated['project_launch_date'],
    'target_countries' => json_encode($validated['target_countries']),
    'responded_titles' => json_encode($validated['responded_titles']), // Store as JSON
    'no_of_sample_required' => $validated['no_of_sample_required'],
    'no_of_sample_delivered' => $validated['no_of_sample_delivered'],
    'incentive_promised' => $validated['incentive_promised'],
    'responded_emails' => json_encode($validated['responded_email']),
    'user_id' => $validated['userid'],
    'total_incentive_paid' => $validated['total_incentive_paid'], // New field
    'incentive_paid_date' => $validated['incentive_paid_date'], // New field
    'mode_of_payment' => $validated['mode_of_payment'], // New field
]);

    // Check if the request is AJAX
    if ($request->ajax()) {
        return response()->json([
            'success' => true,
            'message' => 'Project Feasibility saved successfully!',
        ]);
    }

    // For non-AJAX requests, redirect as usual
    return redirect()->route('ProjectFeasibility')->with('success', 'Project Feasibility saved successfully!');
}   


     public function index()
     {
        return view('project_feasibility.list');
     }


     public function ListData(Request $request)
     {
         // Get the authenticated user's type
         $userType = auth()->user()->user_type;
     
         // Initialize the query
         $query = ProjectFeasibility::query();
     
         // If the user is an employee, apply the user-specific filter
         if ($userType === 'user') {
             $query->where('user_id', auth()->id());
         }
     
         // Apply filters
         if ($request->has('from_date') && !empty($request->from_date)) {
             $query->where('date', '>=', $request->from_date);
         }
     
         if ($request->has('to_date') && !empty($request->to_date)) {
             $query->where('date', '<=', $request->to_date);
         }
     
         if ($request->has('pn_number') && !empty($request->pn_number)) {
             $query->where('pn_number', 'LIKE', '%' . $request->pn_number . '%');
         }
     
         if ($request->has('country') && !empty($request->country)) {
             $query->whereRaw('LOWER(JSON_EXTRACT(target_countries, "$")) LIKE ?', [strtolower($request->country)]);
         }
     
         if ($request->has('responded_titles') && !empty($request->responded_titles)) {
             $query->whereRaw('LOWER(responded_titles) LIKE ?', ['%' . strtolower($request->responded_titles) . '%']);
         }
     
         // Fetch data
         $projects = $query->get();
     
         return response()->json([
             'data' => $projects,
             'user_type' => $userType,
         ]);
     }
     

    public function edit($id)
{
    $project = ProjectFeasibility::findOrFail($id);

    return response()->json([
        'id' => $project->id,
        'date' => $project->date,
        'pn_number' => $project->pn_number,
        'email_subject_line' => $project->email_subject_line,
        'project_launch_date' => $project->project_launch_date,
        'target_countries' => $project->target_countries, // JSON field
        'responded_titles' => $project->responded_titles, // JSON field
        'responded_emails' => $project->responded_emails, // JSON field
        'no_of_sample_required' => $project->no_of_sample_required,
        'no_of_sample_delivered' => $project->no_of_sample_delivered,
        'incentive_promised' => $project->incentive_promised,
        'total_incentive_paid' => $project->total_incentive_paid,
        'incentive_paid_date' => $project->incentive_paid_date,
        'mode_of_payment' => $project->mode_of_payment,
    ]);
}

public function update(Request $request, $id)
{
    // Validate the request
    $validatedData = $request->validate([
        'date' => 'required|date',
        'pn_number' => 'required|string|max:255',
        'email_subject_line' => 'required|string|max:255',
        'project_launch_date' => 'required|date',
        'target_countries' => 'nullable|array',
        'target_countries.*' => 'nullable|string|max:255',
        'responded_titles' => 'nullable|array',
        'responded_titles.*' => 'nullable|string|max:255',
        'responded_email' => 'nullable|array',
        'responded_email.*' => 'nullable|email|max:255',
        'no_of_sample_required' => 'required|string',
        'no_of_sample_delivered' => 'required|string',
        'incentive_promised' => 'required|string',
        'total_incentive_paid' => 'nullable|string',
        'incentive_paid_date' => 'nullable|date',
        'mode_of_payment' => 'nullable|string|max:255',
    ]);

    // Find the project feasibility record by ID
    $project = ProjectFeasibility::findOrFail($id);

    // Update the project fields
    $project->date = $validatedData['date'];
    $project->pn_number = $validatedData['pn_number'];
    $project->email_subject_line = $validatedData['email_subject_line'];
    $project->project_launch_date = $validatedData['project_launch_date'];
    $project->target_countries = json_encode($validatedData['target_countries'] ?? []); // Save as JSON
    $project->responded_titles = json_encode($validatedData['responded_titles'] ?? []); // Save as JSON
    $project->responded_emails = json_encode($validatedData['responded_email'] ?? []); // Save as JSON
    $project->no_of_sample_required = $validatedData['no_of_sample_required'];
    $project->no_of_sample_delivered = $validatedData['no_of_sample_delivered'];
    $project->incentive_promised = $validatedData['incentive_promised'];
    $project->total_incentive_paid = $validatedData['total_incentive_paid'] ?? null;
    $project->incentive_paid_date = $validatedData['incentive_paid_date'] ?? null;
    $project->mode_of_payment = $validatedData['mode_of_payment'] ?? null;

    // Save the updated record
    $project->save();

    // Return a response (JSON for AJAX requests or redirect for standard requests)
    return response()->json([
        'success' => true,
        'message' => 'Project Feasibility updated successfully!',
    ]);
}


public function destroy($id)
{
    try {
        // Find the project feasibility record by ID
        $project = ProjectFeasibility::findOrFail($id);

        // Delete the record
        $project->delete();

        // Return a success response
        return response()->json([
            'success' => true,
            'message' => 'Project Feasibility deleted successfully!',
        ]);
    } catch (\Exception $e) {
        // Handle any errors
        return response()->json([
            'success' => false,
            'message' => 'Error deleting the project feasibility. Please try again.',
        ], 500);
    }
}




}

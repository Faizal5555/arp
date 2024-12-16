<?php

namespace App\Http\Controllers;
use App\Models\ProjectFeasibility;

use Illuminate\Http\Request;

class ProjectFeasibilityController extends Controller
{
    //
    public function create()
    {
        return view('project_feasibility.create');
    }

    public function store(Request $request)
{
    // Validate the request
    $validated = $request->validate([
        'date' => 'required|date',
        'pn_number' => 'required|string|max:255',
        'email_subject_line' => 'required|string|max:255',
        'project_launch_date' => 'required|date',
        'target_countries' => 'required|array',
        'target_countries.*' => 'required|string|max:255',
        'responded_title' => 'required|string|max:255',
        'no_of_sample_required' => 'required|integer',
        'no_of_sample_delivered' => 'required|integer',
        'incentive_promised' => 'required|numeric',
        'responded_email' => 'required|array',
        'responded_email.*' => 'required|email|max:255',
    ]);

    // Save the data
    ProjectFeasibility::create([
        'date' => $validated['date'],
        'pn_number' => $validated['pn_number'],
        'email_subject_line' => $validated['email_subject_line'],
        'project_launch_date' => $validated['project_launch_date'],
        'target_countries' => json_encode($validated['target_countries']),
        'responded_title' => $validated['responded_title'],
        'no_of_sample_required' => $validated['no_of_sample_required'],
        'no_of_sample_delivered' => $validated['no_of_sample_delivered'],
        'incentive_promised' => $validated['incentive_promised'],
        'responded_emails' => json_encode($validated['responded_email']),
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
        $query = ProjectFeasibility::query();

        // Apply filters
        if ($request->has('date') && !empty($request->date)) {
            $query->where('date', $request->date);
        }
    
        if ($request->has('pn_number') && !empty($request->pn_number)) {
            $query->where('pn_number', 'LIKE', '%' . $request->pn_number . '%');
        }
    
        if ($request->has('country') && !empty($request->country)) {
            $query->whereJsonContains('target_countries', $request->country);
        }
    
        if ($request->has('responded_title') && !empty($request->responded_title)) {
            $query->where('responded_title', 'LIKE', '%' . $request->responded_title . '%');
        }
    
        // Fetch data
        $projects = $query->get();
    
        return response()->json([
            'data' => $projects
        ]);

    }


}

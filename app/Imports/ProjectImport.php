<?php

namespace App\Imports;

use App\Models\User;
use App\Models\BusinessResearch;
use App\Models\BusinessTeamMember;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;

class ProjectImport implements ToModel, WithHeadingRow
{
    public function model(array $row)
    {
        // Basic validation
        if (empty($row['pn_number']) || empty($row['subject_line']) || empty($row['client_name'])) {
            return null;
        }

        // Create the BusinessResearch entry
        $project = new BusinessResearch([
            'user_id' => Auth::id(),
            'date' => $row['date'] ?? now(),
            'pn_number' => $row['pn_number'],
            'subject_line' => $row['subject_line'],
            'client_name' => $row['client_name'],
            'others' => isset($row['others']) ? trim($row['others']) : null,
            'industry' => $row['industry'] ?? null,
        ]);

        $project->save();

        // Handle team members (comma-separated names)
        if (!empty($row['team_members'])) {
            $names = explode(',', $row['team_members']);
            foreach ($names as $name) {
                $user = User::where('name', trim($name))->first();
                if ($user) {
                    BusinessTeamMember::create([
                        'business_research_id' => $project->id,
                        'user_id' => $user->id,
                    ]);
                }
            }
        }

        return $project;
    }
}

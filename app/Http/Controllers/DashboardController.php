<?php

namespace App\Http\Controllers;

use App\Models\Organization;
use App\Models\Survey;
use DB;

class DashboardController extends Controller
{
    public function index()
    {
        $survey = Survey::query()
            ->whereEnabled(true)
            ->whereDate('expired', '>=', now())
            ->first();

        $links = [];

        if ($survey) {
            /** @var $org Organization */
            $org = auth('org')->user();
            $universities = $org->universities;

            $entries_count = $org->entries()->select([
                DB::raw('count(university_id) as count'),
                'university_id',
            ])->groupBy('university_id')
                ->pluck('count', 'university_id');

            foreach ($universities as $university) {
                $link = [];
                $link['link'] = url("survey/{$university->slug}/{$survey->id}");
                $link['univer_name'] = $university->name;
                $link['survey_name'] = $survey->name;
                $link['entry_count'] = $entries_count[$university->id] ?? 0;
                $links[] = $link;
            }
        }

        return view('dashboard', compact('survey', 'links'));
    }
}

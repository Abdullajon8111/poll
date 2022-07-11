<?php

namespace App\Http\Controllers;

use App\Models\Organization;
use App\Models\Survey;
use Illuminate\Http\Request;

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


            foreach ($universities as $university) {
                $link = [];
                $link['link'] = url("survey/{$university->slug}/{$survey->id}");
                $link['univer_name'] = $university->name;
                $link['survey_name'] = $survey->name;
                $links[] = $link;
            }
        }

        return view('dashboard', compact('survey', 'links'));
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\Entry;
use App\Models\Survey;
use App\Models\University;
use Illuminate\Http\Request;

class SurveyController extends Controller
{
    public function index()
    {
        $surveys = Survey::query()
            ->whereEnabled(true)
            ->where('expired', '>', date('Y-m-d'))
            ->get();

        return view('surveys.index', compact('surveys'));
    }

    public function show(University $university, Survey $survey)
    {
        abort_if(!$this->check($university, $survey), 403);

        return view('surveys.show', compact('survey', 'university'));
    }

    public function check(University $university, Survey $survey)
    {
        $entries_count = Entry::query()
            ->whereUniversityId($university->id)
            ->whereSurveyId($survey->id)
            ->count();

        return $entries_count < $survey->limit_per_participant || $survey->limit_per_participant == -1;
    }
}

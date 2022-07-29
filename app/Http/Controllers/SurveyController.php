<?php

namespace App\Http\Controllers;

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

        return view('surveys.show', compact('survey', 'university'));
    }

}

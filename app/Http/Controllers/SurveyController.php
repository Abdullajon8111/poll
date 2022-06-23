<?php

namespace App\Http\Controllers;

use App\Models\Survey;
use Illuminate\Http\Request;

class SurveyController extends Controller
{
    public function index()
    {
        $surveys = Survey::query()
            ->whereEnabled(true)
            ->where('expired', '>=', date('Y-m-d'))
            ->get();

        return view('surveys.index', compact('surveys'));
    }

    public function show(Survey $survey)
    {
        abort_if($survey->expired->timestamp < now()->timestamp, 403);

        return view('surveys.show', compact('survey'));
    }

}

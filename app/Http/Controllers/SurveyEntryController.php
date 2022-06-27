<?php

namespace App\Http\Controllers;

use App\Models\Entry;
use App\Models\Survey;
use App\Models\University;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class SurveyEntryController extends Controller
{
    /**
     * @throws ValidationException
     */
    public function store(University $university, Survey $survey, Request $request): RedirectResponse
    {
        $answers = $this->validate($request, $survey->rules);
        $user = auth()->user();
        $entry = (new Entry())->for($survey)->fromArray($answers)->by($user);
        $entry->university_id = $university->id;
        $entry->push();

        return redirect()->route('dashboard');
    }
}

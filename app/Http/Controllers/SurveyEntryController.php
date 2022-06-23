<?php

namespace App\Http\Controllers;

use App\Models\Entry;
use App\Models\Survey;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class SurveyEntryController extends Controller
{
    /**
     * @throws ValidationException
     */
    public function store(Survey $survey, Request $request): RedirectResponse
    {
        $answers = $this->validate($request, $survey->rules);
        $user = auth()->user();
        (new Entry())->for($survey)->fromArray($answers)->by($user)->push();

        return redirect()->route('survey.index');
    }
}

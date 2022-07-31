<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Answer;
use App\Models\Entry;
use App\Models\Question;
use App\Models\Survey;
use DB;
use Illuminate\Database\Eloquent\Builder;

class AllAnswerController extends Controller
{
    public function index()
    {
        $survey = Survey::query()
            ->when(request('survey_id'), function (Builder $query, $survey_id) {
                $query->where('id', $survey_id);
            })->first();

        $surveys = Survey::all();

        $questions = Question::whereSurveyId($survey->id)->get();

        $entries = Entry::query()
            ->with(['survey', 'university', 'participant', 'answers'])
            ->paginate();

        $entries_pluck = [];
        foreach ($entries as $entry) {
            $entries_pluck[$entry->id] = $entry->answers->pluck('value', 'question_id')->toArray();
        }

        return view('all-answers.index', compact('survey', 'surveys', 'entries', 'entries_pluck', 'questions'));
    }
}

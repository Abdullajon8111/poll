<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Answer;
use App\Models\Entry;
use App\Models\Question;
use App\Models\Survey;
use App\Models\University;
use DB;
use Illuminate\Database\Eloquent\Builder;

class StatisticsController extends Controller
{
    public function index()
    {
        set_time_limit(480);

        $survey = Survey::query()
            ->when(request('survey_id'), function (Builder $query, $survey_id) {
                return $query->where('id', $survey_id);
            })->first();

        $surveys = Survey::latest()->get();
        $universities = University::all();

        $questions = Question::query()
            ->whereSurveyId($survey->id)
            ->whereIn('type', ['radio', 'multiselect'])
            ->get();

        $q = [];
        $questions->map(function (Question $question) use (&$q) {
            $options = json_decode((string)$question->options, true);
            $q[$question->id] = array_column($options, 'option');
        });

        $entries = Entry::whereSurveyId($survey->id)->get();
        $answers = Answer::query()
            ->join('entries', 'answers.entry_id', '=', 'entries.id')
            ->whereIn('question_id', $questions->pluck('id')->toArray())
            ->whereIn('entry_id', $entries->pluck('id')->toArray())
            ->select([DB::raw('answers.*'), 'entries.university_id'])
            ->get();

        $result = [];
        foreach ($universities as $university) {
            foreach ($questions as $question) {

                foreach ($q[$question->id] as $option) {
                    $result[$university->name][$question->id][$option] = $answers
                        ->where('question_id', $question->id)
                        ->where('value', $option)
                        ->where('university_id', $university->id)
                        ->count();
                }

            }
        }

        return view('statistics.index', compact('surveys', 'survey', 'questions', 'q', 'result'));
    }
}

<?php

namespace App\Http\Controllers\Admin;

use App\Exports\AllStatisticsExport;
use App\Http\Controllers\Controller;
use App\Models\Answer;
use App\Models\Entry;
use App\Models\Question;
use App\Models\Survey;
use DB;
use Illuminate\Database\Eloquent\Builder;
use Maatwebsite\Excel\Facades\Excel;

class AllAnswerController extends Controller
{
    public function index($export = false)
    {
        $view = $export ? 'excel.all-statistics' : 'all-answers.index';
        $entriesQuery = Entry::query()
            ->with(['survey', 'university', 'participant', 'answers']);

        $entries = $export ? $entriesQuery->get() : $entriesQuery->paginate();


        $survey = Survey::query()
            ->when(request('survey_id'), function (Builder $query, $survey_id) {
                $query->where('id', $survey_id);
            })->first();

        $surveys = Survey::all();

        $questions = Question::whereSurveyId($survey->id)->get();

        $entries_pluck = [];
        foreach ($entries as $entry) {
            $entries_pluck[$entry->id] = $entry->answers->pluck('value', 'question_id')->toArray();
        }

        return view($view, compact('survey', 'surveys', 'entries', 'entries_pluck', 'questions'));
    }

    public function export()
    {
        return Excel::download(new AllStatisticsExport(), 'all-statistics.xlsx');
    }
}

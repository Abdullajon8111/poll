<?php

namespace App\Http\Controllers;

use App\Models\Entry;
use App\Models\Organization;
use App\Models\Survey;
use App\Models\University;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class EntryController extends Controller
{
    public function index()
    {
        /** @var $user Organization */
        $user = auth('org')->user();
        $entries = $user
            ->entries()
            ->when(request('survey'), function (Builder $query, $survey) {
                $query->where('survey_id', $survey);
            })
            ->when(request('university'), function (Builder $query, $university) {
                $query->where('university_id', $university);
            })
            ->with('survey')
            ->paginate(15);

        $surveys = Survey::all();
        $universities = University::all();

        return view('entry.index', compact('entries', 'surveys', 'universities'));
    }

    public function show(Entry $entry)
    {
        $answers = $entry
            ->answers()
            ->with('question')
            ->get();

        return view('entry.show', compact('answers'));
    }
}

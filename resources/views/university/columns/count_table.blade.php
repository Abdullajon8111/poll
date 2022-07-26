@php
    /** @var $university \App\Models\University */
    /** @var $entry Eloquent */
    /** @var $surveys \App\Models\Survey[] */
    $university = $entry;
    $surveys = session('surveys');

    $surveyUniversityFilter = function (\App\Models\Entry $entry) use ($university) {
        return $entry->university_id == $university->id;
    }
@endphp

<table class="table table-sm">
    @foreach($surveys as $survey)
        <tr>
            <td>{{ $survey->name }}</td>
            <td>{{ $survey->entries->filter($surveyUniversityFilter)->count() }}</td>
        </tr>
    @endforeach
</table>

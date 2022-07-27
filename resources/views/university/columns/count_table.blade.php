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
    <thead>
    <tr>
        <th>{{ __('Survey') }}</th>
        <th>{{ __('Organization') }}</th>
        <th>{{ __('Count') }}</th>
    </tr>
    </thead>
    <tbody>
    @foreach($surveys as $survey)
        <tr>
            <td>{{ $survey->name }}</td>
            <td>
                <div class="badge badge-primary">
                    {{ $survey->entries->filter($surveyUniversityFilter)->unique('participant_id')->count() }}
                </div>
            </td>
            <td>
                <div class="badge badge-primary">
                    {{ $survey->entries->filter($surveyUniversityFilter)->count() }}
                </div>
            </td>
        </tr>
    @endforeach
    </tbody>
</table>

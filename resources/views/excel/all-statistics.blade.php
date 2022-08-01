<table class="table table-sm table-striped table-bordered font-sm" id="all-answers-table">
    <thead>
    <tr>
        <th>#</th>
        <th>{{ __('Organization') }}</th>
        <th>{{ __('University') }}</th>
        <th>{{ __('Survey') }}</th>
        @foreach($questions as $question)
            <th>{!! $question->content !!}</th>
        @endforeach
    </tr>
    </thead>

    <tbody>
    @foreach($entries as $index => $entry)
        <tr>
            <td>{{ $loop->iteration }}</td>
            <td>{{ $entry->participant->name }}</td>
            <td>{{ $entry->university->name ?? '' }}</td>
            <td>{{ $entry->survey->name }}</td>
            @foreach($questions as $question)
                <td>{{ $entries_pluck[$entry->id][$question->id] ?? '' }}</td>
            @endforeach
        </tr>
    @endforeach
    </tbody>
</table>

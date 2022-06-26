<select class="form-control custom-select select2" name="survey" id="survey-select">
    @foreach($surveys as $survey)
        <option value="{{ $survey->id }}">{{ $survey->name }}</option>
    @endforeach
</select>

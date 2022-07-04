@component('survey::questions.base', compact('question'))
    <textarea type="text"
              name="{{ $question->key }}"
              id="{{ $question->key }}"
              class="form-control"
              rows="3"
{{--              value="{{ $value ?? old($question->key) }}" --}}
              {{ ($disabled ?? false) ? 'disabled' : '' }}>{{ $value ?? old($question->key) }}</textarea>
@endcomponent

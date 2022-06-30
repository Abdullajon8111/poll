@component('survey::questions.base', compact('question'))
    @php
        try {
            $options = json_decode($question->options, true);
            $options = array_column($options, 'option');
        } catch (Exception $exception) {
            $options = [];
        }

    @endphp

    @foreach($options as $option)
        <div class="custom-control custom-radio">
            <input type="radio"
                   name="{{ $question->key }}"
                   id="{{ $question->key . '-' . Str::slug($option) }}"
                   value="{{ $option }}"
                   class="custom-control-input"
                {{ ($value ?? old($question->key)) == $option ? 'checked' : '' }}
                {{ ($disabled ?? false) ? 'disabled' : '' }}
            >
            <label class="custom-control-label"
                   for="{{ $question->key . '-' . Str::slug($option) }}">{{ $option }}
                @if($includeResults ?? false)
                    <span class="text-success">
                        ({{ number_format((new \App\Utilities\Summary($question))->similarAnswersRatio($option) * 100, 2) }}%)
                    </span>
                @endif
            </label>
        </div>
    @endforeach
@endcomponent

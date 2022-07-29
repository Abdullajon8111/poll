@php
    /** @var $answer \App\Models\Answer */
    /** @var $entry \Illuminate\Database\Eloquent\Model */

    $answer = $entry;
@endphp

<div>
    @if(isset($answer->question))
        {!! $answer->question->content !!}
    @else
        -
    @endif
</div>

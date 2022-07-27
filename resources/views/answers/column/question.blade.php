@php
    /** @var $answer \App\Models\Answer */
    /** @var $entry \Illuminate\Database\Eloquent\Model */

    $answer = $entry;
@endphp

<div>
    {!! $answer->question->content !!}
</div>

@php
/** @var $university \App\Models\University */
/** @var $university  */
$university = $entry;

@endphp

<label class="switch switch-label switch-outline-primary-alt" data-id="{{$university->id}}" onclick="return false">
    <input class="switch-input" type="checkbox" {{ $university->enabled ? 'checked' : '' }}>
    <span class="switch-slider" data-checked="On" data-unchecked="Off"></span>
</label>

@php
    /** @var $entry App\Models\University*/

@endphp

<div class="w-50" title="{{ $entry->name }}" data-toggle="tooltip" data-placement="top">
    {{ \Str::limit($entry->name, 84) }}
</div>

@php
    $slug = $entry->slug
@endphp

<button class="btn btn-info get-info-button" onclick="modal_show('{{ $slug }}')">
    <i class="la la-link">&ensp;</i>
    {{ __('get url') }}
</button>


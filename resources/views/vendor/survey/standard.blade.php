<div class="card my-4">
    <div class="card-body">
        <h2 class="mb-0">{{ $survey->name }} </h2>
        <h6 class="font-weight-bold text-danger">{{ $university->name }}</h6>
        @if(!$eligible)
            {{ __('We only accept') }}
            <strong>{{ $survey->limitPerParticipant() }} {{ __('entry') }}</strong>
            {{ __('per participant') }}.
        @endif

        @if($lastEntry)
{{--            {{ __('You last submitted your answers') }} <strong>{{ $lastEntry->created_at->diffForHumans() }}</strong>.--}}
        @endif
    </div>
</div>

@if(!$survey->acceptsGuestEntries() && auth()->guest())
    <div class="p-5">
        {{ __('Please login to join this survey') }}.
    </div>
@else
    @foreach($survey->sections as $section)
        <div class="bg-white mt-2">
            @include('survey::sections.single')
        </div>
    @endforeach

    @foreach($survey->questions()->withoutSection()->get() as $question)
        <div class="bg-white mt-2">
            @include('survey::questions.single')
        </div>
    @endforeach

    @if($eligible)
        <button class="btn btn-dark btn-block my-3">{{ __('Submit') }}</button>
    @endif
@endif




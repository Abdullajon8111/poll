<div class="card my-4">
    <div class="card-header bg-secondary">
        <h3 class="px-4 text-white mb-0">{{ $section->name }}</h3>
    </div>

    <div class="card-body">
        @foreach($section->questions as $question)
            @include('survey::questions.single')
        @endforeach
    </div>
</div>



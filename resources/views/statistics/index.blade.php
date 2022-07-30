@extends(backpack_view('blank'))

@php
    use App\Models\Question;
    use App\Models\Survey;

    /** @var $survey Survey */
    /** @var $surveys Survey[] */
    /** @var $q array */
    /** @var $result array */
    /** @var $questions Question[] */


    $defaultBreadcrumbs = [
      trans('backpack::crud.admin') => url(config('backpack.base.route_prefix'), 'dashboard'),
      __('Statistics') => false
    ];

    // if breadcrumbs aren't defined in the CrudController, use the default breadcrumbs
    $breadcrumbs = $breadcrumbs ?? $defaultBreadcrumbs
@endphp

@section('header')
    <div class="container-fluid">
        <h2>
            <span class="text-capitalize">{!! __('Statistics') !!}</span>
        </h2>
    </div>
@endsection

@section('after_styles')
    <style>
        .table thead tr th {
            text-align: center;
            vertical-align: middle;
        }
    </style>
@endsection

@section('content')
    <!-- Default box -->
    <div class="row">

        <!-- THE ACTUAL CONTENT -->
        <div class="col-lg-12">

            <table class="table table-striped table-bordered">
                <thead>
                <tr>
                    <th rowspan="2">#</th>
                    <th rowspan="2">{{ __('OTM') }}</th>
                    @foreach($questions as $question)
                        <th class="border-bottom" colspan="{{ count($q[$question->id]) }}">
                            {!! $question->content !!}
                        </th>
                    @endforeach
                </tr>
                <tr>
                    @foreach($questions as $question)
                        @foreach($q[$question->id] as $answer)
                            <th>{{ $answer }}</th>
                        @endforeach
                    @endforeach
                </tr>
                </thead>

                <tbody>
                @foreach($result as $university => $i_questions)
                    <tr>
                        <td>{{ $loop->index + 1 }}</td>
                        <td>{{ $university }}</td>
                        @foreach($i_questions as $i_question)
                            @foreach($i_question as $i_answer)
                                <td>{{ $i_answer }}</td>
                            @endforeach
                        @endforeach
                    </tr>
                @endforeach
                </tbody>
            </table>

        </div>

    </div>

@endsection


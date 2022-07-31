@extends(backpack_view('blank'))

@php
    use App\Models\Entry;use App\Models\Question;
    use App\Models\Survey;

    /** @var $survey Survey */
    /** @var $surveys Survey[] */
    /** @var $entries Entry[] */
    /** @var $questions Question[] */
    /** @var $entries_pluck array */


    $defaultBreadcrumbs = [
      trans('backpack::crud.admin') => url(config('backpack.base.route_prefix'), 'dashboard'),
      __('Answers') => false
    ];

    // if breadcrumbs aren't defined in the CrudController, use the default breadcrumbs
    $breadcrumbs = $breadcrumbs ?? $defaultBreadcrumbs
@endphp

@section('header')
    <div class="container-fluid">
        <h2>
            <span class="text-capitalize">{!! __('Answers') !!}</span>
        </h2>
    </div>
@endsection

@section('after_styles')
    <style>
        .table thead tr th {
            text-align: center;
            vertical-align: middle;
        }

        .table tbody tr td {
            text-align: center;
            vertical-align: middle;
        }
    </style>
@endsection

@section('content')
    <div class="row">
        <div class="col-lg-4">
            <div class="form-group">
                <select class="form-control" name="survey_id" id="survey-filter">
                    @foreach($surveys as $s)
                        <option value="{{ $s->id }}" {{ $survey->id == $s->id ? 'selected' : '' }}>{{ $s->name }}</option>
                    @endforeach
                </select>
            </div>
        </div>

        <div class="col-lg-4">
            <button class="btn btn-primary btn-search">
                <i class="la la-search"></i>
                {{ __('Search') }}
            </button>
        </div>

        <div class="col-lg-4">
            <div class="form-group d-flex justify-content-end">
                <button class="btn btn-success export-btn" onclick="tableToExcel('all-answers-table', 'statistika')">
                    <i class="la la-file-export"></i>
                    {{ __('Export to excel') }}
                </button>
            </div>
        </div>
    </div>

    <!-- Default box -->
    <div class="row">

        <!-- THE ACTUAL CONTENT -->
        <div class="col-lg-12">
            <div class="table-responsive card card-body p-0 mt-3">
                <table class="table table-sm table-striped table-bordered font-sm" id="all-answers-table">
                    <thead>
                    <tr>
                        <th>#</th>
                        <th>{{ __('Organization') }}</th>
                        <th>{{ __('University') }}</th>
                        <th>{{ __('Survey') }}</th>
                        @foreach($questions as $question)
                            <th>{!! $question->content !!}</th>
                        @endforeach
                    </tr>
                    </thead>

                    <tbody>
                    @foreach($entries as $index => $entry)
                        <tr>
                            <td>{{ $entries->firstItem() + $index }}</td>
                            <td>{{ $entry->participant->name }}</td>
                            <td>{{ $entry->university->name }}</td>
                            <td>{{ $entry->survey->name }}</td>
                            @foreach($questions as $question)
                                <td>{{ $entries_pluck[$entry->id][$question->id] ?? '' }}</td>
                            @endforeach
                        </tr>
                    @endforeach
                    </tbody>
                </table>

                {{ $entries->links() }}
            </div>

        </div>

    </div>

@endsection

@section('after_scripts')
    <script type="text/javascript" src="{{ asset('js/tableToExcel.js') }}"></script>
    <script>
        $('.btn-search').click(function () {
            let url = '{{ url()->current() }}';
            window.location.href = url + '?survey_id=' + $('#survey-filter').val()
        })
    </script>
@stop

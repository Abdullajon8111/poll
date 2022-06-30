<!-- Modal -->
<div class="modal fade" id="getUrlModal" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            {{--              <div class="modal-header">--}}
                {{--                  --}}{{--                    <h5 class="modal-title">Modal title</h5>--}}
                {{--                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">--}}
                    {{--                      <span aria-hidden="true">&times;</span>--}}
                    {{--                  </button>--}}
                {{--              </div>--}}
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-8">
                        <div class="form-group" id="univer-form">

                        </div>
                    </div>

                    <div class="col-md-4">

                        <button class="btn btn-info btn-block btn-survey-link" data-slug="">
                            <i class="la la-link">&ensp;</i>
                            {{ __('Generate') }}
                        </button>
                    </div>

                    <div class="col-md-10">
                        <div class="alert alert-link survey-link d-none mt-3"></div>
                    </div>

                    <div class="col-md-2 d-flex">
                        <button class="btn my-auto btn-secondary btn-block d-none btn-copy-link">
                            <i class="la la-copy"></i>

                        </button>
                    </div>
                </div>

            </div>
            {{--                <div class="modal-footer">--}}
                {{--                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>--}}
                {{--                    <button type="button" class="btn btn-primary">Save changes</button>--}}
                {{--                </div>--}}
        </div>
    </div>
</div>

<script>
    let surveys = false;
    let g_slug = '';
    function modal_show(slug) {
        g_slug = slug
        $('.btn-survey-link').attr('data-slug', slug)

        if (!surveys) {
            $.get('{{ route('admin.surveys.list') }}', function (response) {
                surveys = response
                $('#univer-form').html(surveys);

            })
        }
        $('#getUrlModal').modal('show')
    }

    $('.btn-survey-link').click(function () {
        let url = '{{ route('survey.show', ['university' => ':university', 'survey' => ':survey']) }}'
        let survey_id = $('#survey-select').val()

        url = url.replace(':university', g_slug).replace(':survey', survey_id);

        $('.survey-link').html(url).removeClass('d-none')
        $('.btn-copy-link').removeClass('d-none')

    })

    $('.btn-copy-link').click(function () {
        let copyText = $('.survey-link').html()
        navigator.clipboard.writeText(copyText)

    })
</script>

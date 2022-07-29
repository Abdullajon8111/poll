<x-app-layout>
    <x-slot name="header">
        <h2 class="h4 font-weight-bold">
            {{ $survey->name }} ({{ $university->name }})
        </h2>
    </x-slot>

    <form id="survey-form" action="{{ route('survey-entry.store', compact('university', 'survey')) }}" method="post">
        @csrf
        @include('survey::standard', ['survey' => $survey])
    </form>

    <x-slot name="js">
        <script>
            $('#survey-form').submit(function (e) {
                e.preventDefault()
                let data = $(this).serialize()
                let url = $(this).attr('action')
                let method = $(this).attr('method')

                $.post(url, data)

                    .done(response => {
                        new_version()
                    })

                    .fail(error => {
                        if (error.status === 422) {
                            let text = ''
                            let errors = error.responseJSON.errors

                            $.each(errors, function (index) {
                                text += errors[index][0] + '<br>';
                            })

                            swal.fire({
                                title: '{{ __('Error') }} !',
                                html: text,
                                icon: 'error',
                            })
                        }
                    })
            })

            function old_version() {
                swal.fire({
                    customClass: {
                        confirmButton: 'btn btn-dark mr-3',
                        denyButton: 'btn btn-info'
                    },

                    title: '{{ __('Success') }}',
                    icon: 'success',
                    showCancelButton: false,
                    showDenyButton: true,
                    confirmButtonText: '{{ __('View previous answers') }}',
                    denyButtonText: '{{ __('Submit another reply') }}'
                }).then((result) => {
                    if (result.isConfirmed) {
                        window.location = '{{ route('entry.index') }}'
                    } else if (result.isDenied) {
                        $('#survey-form')[0].reset()
                        window.location.reload()
                    }
                })
            }

            function new_version() {
                swal.fire({
                    customClass: {
                        confirmButton: 'btn btn-dark',
                    },

                    title: '{{ __('Success') }}',
                    icon: 'success',
                    confirmButtonText: '{{ __('Return to home page') }}',
                }).then((result) => {
                    window.location = '{{ route('dashboard') }}'
                })
            }
        </script>
    </x-slot>
</x-app-layout>

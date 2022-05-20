
    <script>
        //toast option
        toastr.options = {
            "closeButton": true,
            "debug": false,
            "newestOnTop": false,
            "progressBar": true,
            // "positionClass": "toast-top-full-width",
            "positionClass": "toast-top-center",
            "preventDuplicates": false,
            "onclick": null,
            "showDuration": "5000",
            "hideDuration": "3000",
            "timeOut": "5000",
            "extendedTimeOut": "1000",
            "showEasing": "swing",
            "hideEasing": "linear",
            "showMethod": "show",
            "hideMethod": "hide"
        }

        //show alert
        @if(session()->has('newFeedback'))
            @foreach(session()->get('newFeedback') as $feedback)
            toastr['{{ $feedback['type'] }}']("{{ $feedback['body'] }}", "{{ $feedback['title'] }}")
        @endforeach
        @endif

    </script>

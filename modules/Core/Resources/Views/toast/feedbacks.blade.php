
    <script>
        //toast option
        toastr.options = {
            "closeButton": true,
            "debug": false,
            "newestOnTop": false,
            "progressBar": true,
            "positionClass": "toast-bottom-right",
            "preventDuplicates": false,
            "onclick": null,
            "showDuration": "1000",
            "hideDuration": "1000",
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

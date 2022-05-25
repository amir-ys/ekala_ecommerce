<!-- begin::global scripts -->
<script src="/assets/panel/vendors/bundle.js"></script>
<!-- end::global scripts -->

<!-- begin::chart -->
{{--<script src="/assets/panel/vendors/charts/chart.min.js"></script>--}}
{{--<script src="/assets/panel/vendors/charts/sparkline.min.js"></script>--}}
{{--<script src="/assets/panel/vendors/circle-progress/circle-progress.min.js"></script>--}}
{{--<script src="/assets/panel/js/examples/charts.js"></script>--}}
<!-- end::chart -->

<!-- begin::swiper -->
{{--<script src="/assets/panel/vendors/swiper/swiper.min.js"></script>--}}
{{--<script src="/assets/panel/js/examples/swiper.js"></script>--}}
<!-- end::swiper -->

<!-- begin::custom scripts -->
 @include('Core::toast.feedbacks')
<script src="/assets/panel/js/app.js"></script>
<script src="/assets/panel/vendors/toastr/toastr.min.js"></script>
<script src="/assets/panel/vendors/datatables/datatables.min.js"></script>
<script src="/assets/panel/js/custom.js"></script>
<script>
    $(function () {
        $("#table").DataTable({
            "responsive": true,
            "autoWidth": false,
            "rtl" : true,
            "language": {
                "paginate": {
                    "previous": "قبلی",
                    "next" : "بعدی"
                },
                "sLengthMenu": "تعداد رکورد در صفحه _MENU_ ",
                "sSearch" : "جستجو:",
                "emptyTable":     "هیچ داده ای برای نمایش موجود نیست",
                "info":           "نمایش _START_ تا _END_ از _TOTAL_ رکورد",
                "infoEmpty":      "نمایش 0 تا 0 از 0 رکورد",
                "infoFiltered":   "(نتیجه جستجو بین _MAX_ رکورد)",
                "zeroRecords":    "اطلاعاتی مبنی بر جستجو شما موجود نیست...",
            },
        });
    });
</script>
<!-- end::custom scripts -->
@yield('script')

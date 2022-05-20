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
<script src="/assets/panel/js/custom.js"></script>
 @include('Core::toast.feedbacks')
<script src="/assets/panel/js/app.js"></script>
<script src="/assets/panel/vendors/toastr/toastr.min.js"></script>
<!-- end::custom scripts -->
@yield('script')

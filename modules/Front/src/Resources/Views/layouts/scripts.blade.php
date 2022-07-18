<script src="/assets/front/assets/js/jquery.min.js"></script>
<script src="/assets/front/assets/js/bootstrap.bundle.min.js"></script>
<script src="/assets/front/assets/plugins/fontawesome/js/all.min.js"></script>
<script src="/assets/front/assets/plugins/aos-master/dist/aos.js"></script>
<script src="/assets/front/assets/js/droopmenu.js"></script>
<script src="/assets/front/assets/js/nouislider.min.js"></script>
<script src="/assets/front/assets/js/pagination.js"></script>
<script src="/assets/front/assets/js/owl.carousel.js"></script>
<script src="/assets/front/assets/js/scripts.js"></script>
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<script>
    function deleteItem(event  , url ,  name) {
        event.preventDefault();
        console.log(url)
        swal({
            title: "آیا از انجام این کار اطمینان دارید?",
            text: "شما در حال حذف هستید و  این کار غبر قابل بازگشت است.!",
            icon: "warning",
            buttons: ["انصراف", "بله!"],
        }).then(function(value) {
            if (value) {
                window.location.href = url;
            }
        });
    }
</script>
@yield('script')

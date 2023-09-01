<!-- jQuery -->
<script src="{{ asset('gentella/vendors/jquery/dist/jquery.min.js') }}"></script>
<!-- Bootstrap -->
<script src="{{ asset('gentella/vendors/bootstrap/dist/js/bootstrap.bundle.min.js') }}"></script>
<!-- FastClick -->
<script src="{{ asset('gentella/vendors/fastclick/lib/fastclick.js') }}"></script>
<!-- NProgress -->
<script src="{{ asset('gentella/vendors/nprogress/nprogress.js') }}"></script>
<!-- Chart.js -->
<script src="{{ asset('gentella/vendors/Chart.js/dist/Chart.min.js') }}"></script>
<!-- jQuery Sparklines -->
<script src="{{ asset('gentella/vendors/jquery-sparkline/dist/jquery.sparkline.min.js') }}"></script>
<!-- Flot -->
<script src="{{ asset('gentella/vendors/Flot/jquery.flot.js') }}"></script>
<script src="{{ asset('gentella/vendors/Flot/jquery.flot.pie.js') }}"></script>
<script src="{{ asset('gentella/vendors/Flot/jquery.flot.time.js') }}"></script>
<script src="{{ asset('gentella/vendors/Flot/jquery.flot.stack.js') }}"></script>
<script src="{{ asset('gentella/vendors/Flot/jquery.flot.resize.js') }}"></script>
<!-- Flot plugins -->
<script src="{{ asset('gentella/vendors/flot.orderbars/js/jquery.flot.orderBars.js') }}"></script>
<script src="{{ asset('gentella/vendors/flot-spline/js/jquery.flot.spline.min.js') }}"></script>
<script src="{{ asset('gentella/vendors/flot.curvedlines/curvedLines.js') }}"></script>
<!-- DateJS -->
<script src="{{ asset('gentella/vendors/DateJS/build/date.js') }}"></script>
<!-- bootstrap-daterangepicker -->
<script src="{{ asset('gentella/vendors/moment/min/moment.min.js') }}"></script>
<script src="{{ asset('gentella/vendors/bootstrap-daterangepicker/daterangepicker.js') }}"></script>

<!-- Custom Theme Scripts -->
<script src="{{ asset('gentella/build/js/custom.min.js') }}"></script>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.0.19/dist/sweetalert2.all.min.js"></script>

<script>
    // Fungsi untuk menampilkan SweetAlert ketika tombol "Bantuan" diklik
    document.getElementById('btnBantuan').addEventListener('click', function() {
        Swal.fire({
            icon: 'info',
            title: 'Bantuan?',
            text: 'Hubungi nomor WhatsApp kami di 082191170349',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Hubungi Sekarang',
            cancelButtonText: 'Batal'
        }).then((result) => {
            if (result.isConfirmed) {
                let message = encodeURIComponent('Halo, Saya butuh bantuan...');
                window.open(`https://api.whatsapp.com/send?phone=6282191170349&text=${message}`, '_blank');
            }
        });
    });
</script>
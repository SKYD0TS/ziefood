<!-- Make sure jQuery is included before this script -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<!-- jQuery -->
<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.js"></script>
<script src="{{ asset('js')}}/jquery-3.7.1.min.js" type="text/javascript"></script>
<script src="{{ asset('assets') }}/vendors/jquery/dist/jquery.min.js"></script>
<!-- Bootstrap -->
<script src="{{ asset('assets') }}/vendors/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
<!-- FastClick -->
<script src="{{ asset('assets') }}/vendors/fastclick/lib/fastclick.js"></script>
<!-- NProgress -->
<script src="{{ asset('assets') }}/vendors/nprogress/nprogress.js"></script>
<!-- Chart.js -->
<script src="{{ asset('assets') }}/vendors/Chart.js/dist/Chart.min.js"></script>
<!-- gauge.js -->
<script src="{{ asset('assets') }}/vendors/gauge.js/dist/gauge.min.js"></script>
<!-- bootstrap-progressbar -->
<script src="{{ asset('assets') }}/vendors/bootstrap-progressbar/bootstrap-progressbar.min.js"></script>
<!-- iCheck -->
<script src="{{ asset('assets') }}/vendors/iCheck/icheck.min.js"></script>
<!-- Skycons -->
<script src="{{ asset('assets') }}/vendors/skycons/skycons.js"></script>
<!-- Flot -->
<script src="{{ asset('assets') }}/vendors/Flot/jquery.flot.js"></script>
<script src="{{ asset('assets') }}/vendors/Flot/jquery.flot.pie.js"></script>
<script src="{{ asset('assets') }}/vendors/Flot/jquery.flot.time.js"></script>
<script src="{{ asset('assets') }}/vendors/Flot/jquery.flot.stack.js"></script>
<script src="{{ asset('assets') }}/vendors/Flot/jquery.flot.resize.js"></script>
<!-- Flot plugins -->
<script src="{{ asset('assets') }}/vendors/flot.orderbars/js/jquery.flot.orderBars.js"></script>
<script src="{{ asset('assets') }}/vendors/flot-spline/js/jquery.flot.spline.min.js"></script>
<script src="{{ asset('assets') }}/vendors/flot.curvedlines/curvedLines.js"></script>
<!-- DateJS -->
<script src="{{ asset('assets') }}/vendors/DateJS/build/date.js"></script>
<!-- JQVMap -->
<script src="{{ asset('assets') }}/vendors/jqvmap/dist/jquery.vmap.js"></script>
<script src="{{ asset('assets') }}/vendors/jqvmap/dist/maps/jquery.vmap.world.js"></script>
<script src="{{ asset('assets') }}/vendors/jqvmap/examples/js/jquery.vmap.sampledata.js"></script>
<!-- bootstrap-daterangepicker -->
<script src="{{ asset('assets') }}/vendors/moment/min/moment.min.js"></script>
<script src="{{ asset('assets') }}/vendors/bootstrap-daterangepicker/daterangepicker.js"></script>

<!-- Custom Theme Scripts -->
<script src="{{ asset('assets') }}/build/js/custom.min.js"></script>

<script src="{{ asset('sweetalert') }}/dist/sweetalert2.min.js" crossorigin="anonymous"></script>
<script src="{{ asset('assets') }}/vendors/datatables.net/js/jquery.dataTables.js" crossorigin="anonymous"></script>
<script src="{{ asset('assets') }}/vendors/datatables.net/js/jquery.dataTables.min.js" crossorigin="anonymous"></script>
<script src="{{ asset('js')}}/canvasjs.min.js"></script>

@stack('script')
</body>

</html>
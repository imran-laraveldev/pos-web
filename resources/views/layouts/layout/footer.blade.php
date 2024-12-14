<div class="copyright">
    <?php echo date('Y');?> &copy; {{ config('app.name', 'Laravel') }}
</div>

<!--[if lt IE 9]>
<script src="{{ asset('assets/global/plugins/respond.min.js') }}"></script>
<script src="{{ asset('assets/global/plugins/excanvas.min.js') }}"></script>
<![endif]-->
<script src="{{ asset('assets/global/plugins/jquery-1.11.0.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('assets/global/plugins/jquery-migrate-1.2.1.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('assets/global/plugins/bootstrap/js/bootstrap.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('assets/global/plugins/bootstrap-hover-dropdown/bootstrap-hover-dropdown.min.js') }}"
        type="text/javascript"></script>
<script src="{{ asset('assets/global/plugins/jquery-slimscroll/jquery.slimscroll.min.js') }}"
        type="text/javascript"></script>
<script src="{{ asset('assets/global/plugins/jquery.blockui.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('assets/global/plugins/jquery.cokie.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('assets/global/plugins/uniform/jquery.uniform.min.js') }}" type="text/javascript"></script>

<script src="{{ asset('assets/global/plugins/jquery-validation/js/jquery.validate.min.js') }}"
        type="text/javascript"></script>
<script type="text/javascript" src="{{ asset('assets-cattle/datatable/js/addons/datatables.min.js')}}"></script>
<script type="text/javascript" src="{{ asset('assets-cattle/js/dataTables.buttons.min.js')}}"></script>
<script type="text/javascript" src="{{ asset('assets-cattle/js/buttons.html5.min.js')}}"></script>
<script type="text/javascript" src="{{ asset('assets-cattle/js/buttons.print.min.js')}}"></script>

{{--<script type="text/javascript" src="{{ asset('assets/globals/plugins/select2/select2.min.js') }}"></script>--}}

<script src="{{ asset('assets/global/scripts/metronic.js') }}" type="text/javascript"></script>
<script src="{{ asset('assets/admin/layout'.env('TEMPLATE_SUFFIX','').'/scripts/layout.js') }}" type="text/javascript"></script>
<script src="{{ asset('assets/admin/layout'.env('TEMPLATE_SUFFIX','').'/scripts/demo.js') }}" type="text/javascript"></script>
<script src="{{ asset('assets/admin/pages/scripts/tasks.js') }}" type="text/javascript"></script>

<script>
    jQuery(document).ready(function () {
        Metronic.init(); // init metronic core components
        Layout.init(); // init current layout
        // QuickSidebar.init() // init quick sidebar
        // Index.init();
    });
</script>

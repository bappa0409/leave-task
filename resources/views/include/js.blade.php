
<!--begin::Jquery-->
<script src="{{asset('assets/plugins/jquery/jquery-3.6.3.min.js')}}"></script>
<script src="{{ asset('assets/plugins/jquery-ui/jquery-ui.js') }}"></script>
<!--end::Jquery-->

<!--begin::Datatables-->
<script src="{{asset('assets/plugins/datatables/datatables.js')}}"></script>
<!--end::Datatables-->

<!--Start Date Time Picker With Moment-->
<script src="{{ asset('assets/plugins/moment/moment.min.js') }}"></script>
<script src="{{ asset('assets/plugins/daterangepicker/daterangepicker.js') }}"></script>
<!--End Date Time Picker-->

<script src="{{asset('assets/js/app.js')}}?v_{{date("h_i")}}"></script>




<!--begin::Sweet Alert-->
<script src="{{asset('assets/plugins/sweetalert2/sweetalert2.js')}}"></script>
<!--end::Sweet Alert-->



<!--begin::Custom-->
<script src="{{asset('assets/js/custom.js')}}?v_{{date("h_i")}}"></script>
<!--end::Custom-->
</div>
<meta name="_token" content="{!! csrf_token() !!}" />
<script src="{{URL::asset('js/jquery.min.js')}}"></script>
<script src="{{URL::asset('js/bootstrap.min.js')}}"></script>
<script src="{{URL::asset('custom/metisMenu/metisMenu.min.js')}}"></script>
@yield('js')
<script src="{{ URL::asset('custom/js/sb-admin-2.js') }}"></script>
<script src="{{ URL::asset('custom/sweetalert/sweetalert.min.js') }}"></script>
<script src="{{ URL::asset('custom/select2/js/select2.min.js') }}"></script>
<script src="{{ URL::asset('js/themes.js') }}"></script>
<script src="{{ URL::asset('js/main.js') }}"></script>
</body>
</html>
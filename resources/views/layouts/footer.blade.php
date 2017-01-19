</div>
<meta name="_token" content="{!! csrf_token() !!}" />
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<script src="{{URL::asset('js/bootstrap.min.js')}}"></script>
<script src="{{URL::asset('custom/metisMenu/metisMenu.min.js')}}"></script>
@yield('js')
<script src="{{URL::asset('custom/js/sb-admin-2.js')}}"></script>
<script src="{{URL::asset('custom/sweetalert/sweetalert.min.js')}}"></script>
<script src="{{ URL::asset('js/themes.js') }}"></script>
</body>
</html>
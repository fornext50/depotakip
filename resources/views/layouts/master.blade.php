@include('layouts.header')
@section('title','Master Sayfası')
@include('layouts.navigation')
<div id="page-wrapper">
@include('layouts.pagehead')
@yield('content')
</div>
<!-- /#page-wrapper -->
@include('layouts.footer')
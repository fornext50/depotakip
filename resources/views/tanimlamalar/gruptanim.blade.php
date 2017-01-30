@extends('layouts.master')
@section('title','Grup Tanımlama')
@section('css')
<link rel="stylesheet" href="{{URL::asset('/custom/datatables-plugins/dataTables.bootstrap.css')}}">
@endsection
@section('content')
<div class="row">
    <div class="col-lg-12">
        <div class="panel panel-default">
            <div class="panel-heading">
                <button id="btn-add-grp" class="btn btn-primary btn-default"><i class="fa fa-plus"></i> Yeni Ekle</button>
            </div>
            <!-- /.panel-heading -->
            <div class="panel-body">
                <table width="100%" class="table table-striped table-bordered table-hover" id="dtgrup">
                    <thead>
                    <tr>
                        <th>S.N</th>
                        <th>Grup Adı</th>
                        <th>Durumu</th>
                        <th>#</th>
                    </tr>
                    </thead>
                    <tbody id="glist" name="glist">
	                	@foreach($gruplar as $gr)
						 <tr id="grp-{{ $gr->id }}">
						 	<td>{{ $gr->id }}</td>
	                        <td>{{ $gr->name }}</td>
	                        <td>{{ $gr->state ? "Aktif" : "Pasif" }}</td>
	                        <td>
	                            <button data-toggle="tooltip" data-placement="top" title="Kayıt Düzenle" value="{{ $gr->id }}" class="btn btn-warning btn-circle btn-edit"><i class="fa fa-edit"></i></button>
	                            <button data-toggle="tooltip" data-placement="top" title="Kayıt Sil" class="btn btn-danger btn-circle btn-delete" value="{{ $gr->id }}"><i class="fa fa-times"></i></button>
	                             <button data-toggle="tooltip" data-placement="top" title="Aktif / Pasif" class="btn btn-primary btn-circle btn-active" value="{{ $gr->id }}"><i class="fa fa-link"></i></button>
	                        </td>
	                    </tr>
	                    @endforeach	
                    </tbody>
                </table>
                <!-- /.table-responsive -->
            </div>
            <!-- /.panel-body -->
        </div>
        <!-- /.panel -->
    </div>
    <!-- /.col-lg-12 -->
</div>
@endsection

@section('js')
<script src="{{ URL::asset('custom/datatables/js/jquery.dataTables.min.js')}} "></script>
<script src="{{ URL::asset('custom/datatables-plugins/dataTables.bootstrap.min.js') }}"></script>
<script src="{{ URL::asset('custom/datatables-responsive/dataTables.responsive.js') }}"></script>
<script src="{{ URL::asset('apis/jsgrup.js') }}"></script>
<script>
    $(document).ready(function() {
        $('#dtgrup').DataTable({
            responsive: true,
             "ordering": true
        });
    });
       $(function () {
          $('[data-toggle="tooltip"]').tooltip()
        });
</script>
@endsection
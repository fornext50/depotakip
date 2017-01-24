@extends('layouts.master')
@section('title','Malzemeler')
@section('css')
<link rel="stylesheet" href="{{URL::asset('/custom/datatables-plugins/dataTables.bootstrap.css')}}">
@endsection
@section('content')
    <div class="modal fade" id="md-malz">
        <div class="modal-dialog modal-lg" role="form">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        <span class="sr-only">Kapat</span>
                    </button>
                    <h4 class="modal-title">Malzeme Kayıt</h4>
                </div>
                <div class="modal-body">
                    <form  name="frmMalz" role="form" id="frmMalz">
                        <div class="form-group">
                            <label>Malzeme Adı</label>
                            <input name="madi" id="madi" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label>Kimlik No</label>
                            <input name="mkimlik" id="mkimlik"  class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label>Grubu</label>
                            <input id="mgrubu" class="form-control" required>
                        </div>
                        <div class="row">
                            <div class="col-xs-12 col-md-6">
                                <div class="form-group">
                                    <label>Marka</label>
                                    <input id="mmarka"  class="form-control">
                                </div>
                            </div>
                            <div class="col-xs-12 col-md-6">
                                <div class="form-group">
                                    <label>Model</label>
                                    <input id="mmodel" class="form-control">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-xs-12 col-md-6">
                                <div class="form-group">
                                    <label>Fiyatı</label>
                                    <div class="input-group">
                                        <input type="number"  min="0" step="0.01" data-number-to-fixed="2" data-number-stepfactor="100" class="form-control currency" name="mfiyat" id="c2" />
                                        <span class="input-group-addon">₺</span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xs-12 col-md-6">
                                <div class="form-group">
                                    <label>Durumu</label>
                                    <input id="mdurum" class="form-control required">
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label>Malzeme Özelliği</label>
                            <textarea id="mozellik" name="mozellik" class="form-control" rows="5"></textarea>
                        </div>
                        <div class="alert alert-danger" id="hata" role="alert" hidden></div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Kapat</button>
                    <button type="button" id="btn-save" class="btn btn-success">Kaydet</button>
                    <input type="hidden" id="m_id" name="m_id" value="0">
                </div>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->
    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <button id="btn-add-mal" class="btn btn-primary btn-default"><i class="fa fa-plus"></i> Yeni Ekle</button>
                </div>
                <!-- /.panel-heading -->
                <div class="panel-body">
                    <table width="100%" class="table table-striped table-bordered table-hover" id="dtMalList">
                        <thead>
                        <tr>
                            <th width="50px">Kimlik No</th>
                            <th width="250px">Malzeme Adı</th>
                            <th width="100px">Grubu</th>
                            <th width="70px">Durumu</th>
                            <th width="400px">Özelliği</th>
                            <th width="50px">#</th>
                        </tr>
                        </thead>
                        <tbody id="mal-list" name="mal-list">
                        @foreach($malzemeler as $malzeme)
                        <tr id="mal-{{ $malzeme->id }}">
                            <td>{{ $malzeme->mkimlik }}</td>
                            <td>{{ $malzeme->madi }}</td>
                            <td>{{ $malzeme->mgrubu }}</td>
                            <td>{{ $malzeme->mdurum }}</td>
                            <td>{{ $malzeme->mozellik }}</td>
                            <td>
                                <button value="{{ $malzeme->id }}" class="btn btn-warning btn-circle btn-detail btn-edit"><i class="fa fa-edit"></i></button>
                                <button class="btn btn-danger btn-circle btn-delete delete-malz" value="{{ $malzeme->id }}"><i class="fa fa-times"></i></button>
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
<script src="{{ URL::asset('apis/jsmalz.js') }}"></script>
<script>
    $(document).ready(function() {
        var my_url = window.location;
        $('#dtMalList').DataTable({
            responsive: true,
        });
    });
</script>
@endsection
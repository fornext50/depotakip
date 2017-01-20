@extends('layouts.master')
@section('title','Malzeme Çıkış')
@section('css')
<link rel="stylesheet" href="{{URL::asset('/custom/datatables-plugins/dataTables.bootstrap.css')}}">
<link rel="stylesheet" href="{{URL::asset('css/bootstrap-datepicker.min.css')}}">
@endsection
@section('content')
    <div class="modal fade" id="md-mc">
        <div class="modal-dialog modal-lg" role="form">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        <span class="sr-only">Kapat</span>
                    </button>
                    <h4 class="modal-title">Malzeme Çıkış</h4>
                </div>
                <div class="modal-body">
                    <form  name="frmMalc" role="form" id="frmMalc">
                        <div class="form-group">
                            <label>Malzeme Seç</label>
                            <select id="m_id" class="form-control">
                                @foreach($malzemeler as $malzeme)
                                <option value="{{ $malzeme->id }}">{{ $malzeme->madi . ' - '. $malzeme->mgrubu }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Çıkaran Kişi</label>
                            <input name="mcikaran" id="mcikaran"  class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label>Çıkarılan Kişi</label>
                            <input id="mcikarilan" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label>Çıkarılma Tarihi</label>
                            <div class="input-group date" id="datetimepicker1">
                                <input id="ctarih" type="text" class="form-control"><span class="input-group-addon"><span class="glyphicon-calendar glyphicon"></span></span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label>Gerekçe</label>
                            <input id="cgerekce" type="text" name="cgerekce" class="form-control" >
                        </div>
                        <div class="form-group">
                            <label>Açıklama</label>
                            <textarea id="caciklama" name="caciklama" class="form-control" rows="5"></textarea>
                        </div>
                        <div class="alert alert-danger" id="hata" role="alert" hidden></div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Kapat</button>
                    <button type="button" id="btn-save" class="btn btn-success">Kaydet</button>
                </div>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->
    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <button id="btn-add-mc" class="btn btn-primary btn-default"><i class="fa fa-plus"></i> Yeni Ekle</button>
                </div>
                <!-- /.panel-heading -->
                <div class="panel-body">
                    <table width="100%" class="table table-striped table-bordered table-hover" id="dtMalList">
                        <thead>
                        <tr>
                            <th>Malzeme Kimlik</th>
                            <th>Malzeme Adı</th>
                            <th>Grubu</th>
                            <th>Çıkaran Kişi</th>
                            <th>Çıkarılan Kişi</th>
                            <th>Çıkarma Tarihi</th>
                            <th>#</th>
                        </tr>
                        </thead>
                        <tbody id="mal-list" name="mal-list">
                        @foreach($hareketler as $hareket)
                        <tr id="mal-{{ $hareket->id }}">
                            <td>{{ $hareket->malzemeler->mkimlik }}</td>
                            <td>{{ $hareket->malzemeler->madi }}</td>
                            <td>{{ $hareket->malzemeler->mgrubu }}</td>
                            <td>{{ $hareket->cikaran_kisi }}</td>
                            <td>{{ $hareket->cikarilan_kisi }}</td>
                            <td>{{ $hareket->cikarma_tarihi }}</td>
                            <td>
                                <button value="{{ $hareket->malzeme_id }}" class="btn btn-warning btn-circle btn-detail btn-edit"><i class="fa fa-edit"></i></button>
                                <button class="btn btn-danger btn-circle btn-delete delete-malc" value="{{ $hareket->malzeme_id }}"><i class="fa fa-times"></i></button>
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
<script src="{{ URL::asset('js/bootstrap-datepicker.min.js')}} "></script
<script src="{{ URL::asset('js/bootstrap-datepicker.tr.min.js')}} "></script>
<script src="{{ URL::asset('apis/jsmalc.js') }}"></script>
<script>
    $(document).ready(function() {
        $('#dtMalList').DataTable({
            responsive: true,
        });
        $('#datetimepicker1').datepicker({
            format : "dd/mm/yyyy"
        });
    });
</script>
@endsection
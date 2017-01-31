@extends('layouts.master')
@if($pagetype === '0')
@section('title','Malzeme Çıkış')
@else
@section('title','Emanetteki Malzemeler')
@endif
@section('css')
<link rel="stylesheet" href="{{URL::asset('/custom/datatables-plugins/dataTables.bootstrap.css')}}">
<link rel="stylesheet" href="{{URL::asset('css/bootstrap-datepicker.min.css')}}">
@endsection
@section('content')
@if($pagetype === '0')
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
                            <label>Malzeme Seç<span style="color:red">*</span></label>
                            <select id="m_id" class="form-control">
                                @foreach($malzemeler as $malzeme)
                                <option value="{{ $malzeme->id }}">{{ $malzeme->mkimlik. ' - ' .$malzeme->madi }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Teslim Eden<span style="color:red">*</span></label>
                            <input name="mcikaran" id="mcikaran" value="{{ Auth::user()->name }}"  class="form-control" required disabled>
                        </div>
                        <div class="form-group">
                            <label>Teslim Alan<span style="color:red">*</span></label>
                            <input id="mcikarilan" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label>Teslim Birimi<span style="color:red">*</span></label>
                            <input id="tbirim" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label>Teslim Türü</label>
                            <select id="tturu" class="form-control">
                                <option value="0">Emanet Verildi</option>
                                <option value="1">Zimmet Edildi</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Çıkarılma Tarihi<span style="color:red">*</span></label>
                            <div class="input-group date" id="datetimepicker1">
                                <input id="ctarih" type="text" class="form-control"><span class="input-group-addon"><span class="glyphicon-calendar glyphicon"></span></span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label>Gerekçe<span style="color:red">*</span></label>
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
@endif
    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                @if($pagetype === '0')
                <div class="panel-heading">
                    <button id="btn-add-mc" class="btn btn-primary btn-default"><i class="fa fa-plus"></i> Çıkış Yap</button>
                </div>
                @endif
                <!-- /.panel-heading -->
                <div class="panel-body">
                    <table width="100%" class="table table-striped table-bordered table-hover" id="dtMalList">
                        <thead>
                        <tr>
                            <th>Malzeme Kimlik</th>
                            <th>Malzeme Adı</th>
                            <th>Grubu</th>
                            <th>Teslim Eden</th>
                            <th>Teslim Alan</th>
                            <th>Teslim Birimi</th>
                            <th>Teslim Türü</th>
                            <th>Çıkarma Tarihi</th>
                            <th>#</th>
                        </tr>
                        </thead>
                        <tbody id="mal-list" name="mal-list">
                        @foreach($hareketler as $hareket)
                        <tr id="mal-{{ $hareket->id }}">
                            <td>{{ $hareket->malzemeler[0]->mkimlik }}</td>
                            <td>{{ $hareket->malzemeler[0]->madi }}</td>
                            <td>{{ $hareket->malzemeler[0]->mgrubu }}</td>
                            <td>{{ $hareket->cikaran_kisi }}</td>
                            <td>{{ $hareket->cikarilan_kisi }}</td>
                            <td>{{ $hareket->teslim_birimi }}</td>
                            <td>{{ $hareket->teslim_turu == 0 ? "Emanet Verildi" : "Zimmet Edildi" }}</td>
                            <td>{{ $hareket->cikarma_tarihi }}</td>
                            <td>
                                @if($pagetype === '0')
                                    @if(!$hareket->onay)
                                        <button data-toggle="tooltip" data-placement="top" title="İptal Et" value="{{ $hareket->id }}" class="btn btn-danger btn-circle btn-delete delete-malc"><i class="fa fa-times"></i></button>
                                        <button value="{{ $hareket->teslim_turu }}" id="types" hidden></button> 
                                        <button data-toggle="tooltip" data-placement="top" title="Onayla" id="monay" class="btn btn-info btn-circle bonay" value="{{ $hareket->id }}"><i class="fa fa-check"></i></button>
                                    @else
                                        <button value="{{ $hareket->id }}" class="btn btn-info btn-view">Görüntüle</button>
                                    @endif
                                @else
                                    <button data-toggle="tooltip" data-placement="top" title="Geri Al" id="mgerial" class="btn btn-info btn-circle bgeri" value="{{ $hareket->id }}"><i class="fa fa-reply"></i></button>
                                @endif
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
             "ordering": false
        });
        $('#datetimepicker1').datepicker({
            format : "dd/mm/yyyy"
        });

        $("#m_id").select2({ width: '100%',dropdownAutoWidth : true });
        $(function () {
          $('[data-toggle="tooltip"]').tooltip()
        });
    });
</script>
@endsection
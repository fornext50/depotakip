@extends('layouts.master')
@section('title','Malzeme Detay')
@section('content')
    <div class="row">
        <div class="col-lg-12">
            <form role="form" method="post" action="{{ URL::to('malzemeler') }}">
                {{ csrf_field() }}
                <input name="_type" type="hidden" value="view">
                <div class="form-group">
                    <label>Malzeme Adı</label>
                    <input name="madi" value="{{ $data['madi'] }}" class="form-control">
                </div>
                <div class="form-group">
                    <label>Kimlik No</label>
                    <input name="mkimlik" value="{{ $data['mkimlik'] }}" class="form-control">
                </div>
                <div class="form-group">
                    <label>Grubu</label>
                    <input name="mgrubu" value="{{ $data['mgrubu'] }}" class="form-control">
                </div>
                <div class="row">
                    <div class="col-xs-12 col-md-6">
                        <div class="form-group">
                            <label>Marka</label>
                            <input name="mmarka" value="{{ $data['mmarka'] }}" class="form-control" required>
                        </div>
                    </div>
                    <div class="col-xs-12 col-md-6">
                        <div class="form-group">
                            <label>Model</label>
                            <input name="mmodel" value="{{ $data['mmodel'] }}" class="form-control">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-xs-12 col-md-6">
                        <div class="form-group">
                            <label>Fiyatı</label>
                            <div class="input-group">
                                <input name="mfiyat" type="number" value="{{ $data['mfiyat'] }}" min="0" step="0.01" data-number-to-fixed="2" data-number-stepfactor="100" class="form-control currency" id="c2" />
                                <span class="input-group-addon">₺</span>
                            </div>
                        </div>
                    </div>
                    <div class="col-xs-12 col-md-6">
                        <div class="form-group">
                            <label>Durumu</label>
                            <input value="{{ $data['mdurum'] }}" name="mdurum" class="form-control">
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <label>Malzeme Özelliği</label>
                    <textarea name="mozel" class="form-control" rows="5">{{ $data['mozellik'] }}</textarea>
                </div>
                <div class="row">
                    <div class="col-xs-6 col-md-3">
                        <button name="submit" type="submit" class="btn btn-success btn-lg btn-block">Kaydet</button><br>
                    </div>
                    <div class="col-xs-6 col-md-3">
                        <button type="reset" class="btn btn-danger btn-lg btn-block">Temizle</button>
                    </div>
                </div>

            </form>

        </div>
    </div>
@endsection
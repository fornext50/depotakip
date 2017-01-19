@extends('layouts.master')
@section('title','Panel')
@section('content')
    <div class="row">
        <div class="col-lg-6 col-md-6">
            <div class="panel panel-green">
                <div class="panel-heading">
                    <div class="row">
                        <div class="col-xs-3">
                            <i class="fa fa-tasks fa-5x"></i>
                        </div>
                        <div class="col-xs-9 text-right">
                            <div class="huge">{{ $data['malzemesayisi'] }}</div>
                            <div>Malzeme</div>
                        </div>
                    </div>
                </div>
                <a href="{{ URL::to('malzemeler') }}">
                    <div class="panel-footer">
                        <span class="pull-left">Tüme Malzemeler</span>
                        <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                        <div class="clearfix"></div>
                    </div>
                </a>
            </div>
        </div>
        <div class="col-lg-6 col-md-6">
            <div class="panel panel-yellow">
                <div class="panel-heading">
                    <div class="row">
                        <div class="col-xs-3">
                            <i class="fa fa-shopping-cart fa-5x"></i>
                        </div>
                        <div class="col-xs-9 text-right">
                            <div class="huge">{{ $data['hareketsayisi'] }}</div>
                            <div>Hareketler</div>
                        </div>
                    </div>
                </div>
                <a href="{{URL::to('hareketler')}}">
                    <div class="panel-footer">
                        <span class="pull-left">Malzeme Hareketleri</span>
                        <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                        <div class="clearfix"></div>
                    </div>
                </a>
            </div>
        </div>
    </div>
    <!-- /.row -->
@endsection
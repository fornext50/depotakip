@extends('layouts.master')
@section('title','Panel')
@section('content')
    <div class="row">
        <div class="col-lg-4 col-md-4">
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
                        <span class="pull-left">Tüm Malzemeler</span>
                        <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                        <div class="clearfix"></div>
                    </div>
                </a>
            </div>
        </div>
        <div class="col-lg-4 col-md-4">
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
        <div class="col-lg-4 col-md-4">
            <div class="panel panel-red">
                <div class="panel-heading">
                    <div class="row">
                        <div class="col-xs-3">
                            <i class="fa fa-tasks fa-5x"></i>
                        </div>
                        <div class="col-xs-9 text-right">
                            <div class="huge">{{ $data['emanetsayisi'] }}</div>
                            <div>Emanet</div>
                        </div>
                    </div>
                </div>
                <a href="{{ URL::to('hareketler/emanet') }}">
                    <div class="panel-footer">
                        <span class="pull-left">Tüm Emanetler</span>
                        <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                        <div class="clearfix"></div>
                    </div>
                </a>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-6 col-md-6">
             <div class="panel panel-default">
                <div class="panel-heading">
                    <i class="fa fa-bell fa-fw"></i> Son Eklenen 10 Malzeme
                </div>
                <!-- /.panel-heading -->
                <div class="panel-body">
                    <div class="list-group">
                        @foreach($data['malzemeler'] as $malzeme)
                        <div class="list-group-item">
                            <i class="fa fa-comment fa-desktop"></i> {{ $malzeme->mkimlik . ' ' .$malzeme->madi  }}
                            <span class="pull-right text-muted small"><em>{{ $malzeme->created_at }}</em>
                            </span>
                        </div>
                        @endforeach
                    </div>
                    <!-- /.list-group -->
                </div>
                <!-- /.panel-body -->
            </div>
        </div>
        <div class="col-lg-6 col-md-6">
             <div class="panel panel-default">
                <div class="panel-heading">
                    <i class="fa fa-bell fa-fw"></i> Emanetteki Malzemeler
                </div>
                <!-- /.panel-heading -->
                <div class="panel-body">
                    <div class="list-group">
                        @foreach($data['emanetler'] as $malzeme)
                        <div class="list-group-item">
                            <i class="fa fa-comment fa-desktop"></i> {{ sprintf("'%s' malzemesi %s biriminde %s kişisine teslim edildi. ",$malzeme->malzemeler[0]->madi,$malzeme->teslim_birimi,$malzeme->cikarilan_kisi) }}
                            <span class="pull-right text-muted small"><em>{{ $malzeme->created_at }}</em>
                            </span>
                        </div>
                        @endforeach
                    </div>
                    <!-- /.list-group -->
                </div>
                <!-- /.panel-body -->
            </div>
        </div>
    </div>
    <!-- /.row -->
@endsection
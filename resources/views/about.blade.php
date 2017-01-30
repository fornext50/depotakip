@extends('layouts.master')
@section('title','Program')
@section('content')
	<div class="row">
		<h3>{{ env('APP_NAME','Uygulama' )}}</h3>
		<ul>
			<li>Malzeme Kayıt Sistemi</li>
			<li>Malzeme Çıkış Sistemi</li>
			<li>Loglama Sistemi</li>
		</ul>
		<ul>
			<li>Malzeme Emanet Sistemi</li>
			<li>Malzeme Grup Tanımları</li>
		</ul>
	</div>
@endsection
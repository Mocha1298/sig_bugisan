@extends('fe.layout.main')

@section('title','Home')

@section('home','active')
@section('peta','')
@section('profile','')
@section('kontak','')
@section('data','')

@section('content')

<div class="ftco-blocks-cover-1">
    <div class="site-section-cover overlay" data-stellar-background-ratio="0.5" style="background-image: url('/images/hero_2.jpg')">
        <div class="container">
            <div class="row align-items-center ">
                <div class="col-md-5 mt-5 pt-5">
                <h1 class="mb-3">Sistem Informasi Geografis Bugisan.</h1>
                <p>Memuat informasi tentang kerusakan yang terjadi di Desa Bugisan yang tercatat di dokumen RPJMDes.</p>
                <p class="mt-5"><a href="/fe/peta" class="btn btn-primary">Lihat Peta</a></p>
                </div>
                <div class="col-md-6 ml-auto">
                    <div class="white-dots">
                        <img src="{{asset('/images/contoh1.jpg')}}" alt="" class="img-fluid">
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>{{-- Jumbotron --}}

@endsection
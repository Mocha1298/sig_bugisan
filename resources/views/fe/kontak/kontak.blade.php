@extends('fe.layout.main')

@section('title','Kontak')

@section('home','')
@section('peta','')
@section('profile','')
@section('kontak','active')
@section('data','')

@section('peta.css')
    <style>
        .leaflet-interactive{
            stroke: white;
            stroke-opacity: 1;
            stroke-width: 3;
            fill: black;
            fill-opacity: 0;
        }
        .leaflet-popup-content{
            margin: 5px 5px;
        }
        .leaflet-popup-close-button{
            display: none;
        }
    </style>
@endsection

@section('maps.css')
    {{-- LINK LEAFLET --}}
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.5.1/dist/leaflet.css" integrity="sha512-xwE/Az9zrjBIphAcBb3F6JVqxf46+CDLwfLMHloNu6KEQCAWi6HcDUbeOfBIptF7tcCzusKFjFw2yuvEpDL9wQ==" crossorigin=""/>
    <script src="https://unpkg.com/leaflet@1.5.1/dist/leaflet.js" integrity="sha512-GffPMF3RvMeYyc1LWMHtK8EbPv0iNZ8/oTtHPx9/cc2ILxQ+u905qIwdpULaqDkyBKgOaB57QTMg7ztg8Jm2Og==" crossorigin=""></script>
    <script src = "https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
@endsection

@section('content')

<div class="ftco-blocks-cover-1">
    <div class="site-section-cover overlay" data-stellar-background-ratio="0.5" style="background-image: url('/images/hero_2.jpg')">
        <div class="container">
            <div class="row align-items-center justify-content-center text-center">
                <div class="col-md-5 mt-5 pt-5">
                    <h1 class="mb-3">Kontak</h1>
                    <p>Halaman ini berisi informasi tentang alamat dan nomor yang bisa dihubungi</p>
                </div>
            </div>
        </div>
    </div>
</div>{{-- Jumbotron --}}

<div class="site-section bg-light pb-5" id="contact-section"  style="padding-top: 30px;">
    <div class="container">
        <div class="row justify-content-center text-center">
            <div class="col-7 text-center mb-4">
                <h1>Kontak</h1> 
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12 px-5">
                <div class="bg-white p-3 p-md-5">
                    <h3 class="text-black mb-4">Contact Info</h3>
                    <ul class="list-unstyled footer-link">
                        <li class="d-block mb-3">
                        <span class="d-block text-black">Address:</span>
                        <span>Jl. Candi Sewu, Cepoko, Bugisan, Kec. Prambanan</span></li>
                        <li class="d-block mb-3"><span class="d-block text-black">Phone:</span><span>0816 394 553</span></li>
                        <li class="d-block mb-3"><span class="d-block text-black">Email:</span><span>desa_bugisan@gmail.com</span></li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="row justify-content-center text-center mt-5">
            <div class="col-7 text-center mb-5">
                <h3>Alamat</h3> 
            </div>
        </div>
        <div id="mapid"></div>
        <script src="{{asset('/fe_aset/peta_aset/only_poly.js')}}"></script>
        <script src="{{asset('/fe_aset/peta_aset/bundle.js')}}"></script>
        <script src="{{asset('/fe_aset/peta_aset/alamat.js')}}"></script>
    </div>
</div>


@endsection
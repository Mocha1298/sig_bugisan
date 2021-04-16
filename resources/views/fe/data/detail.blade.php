@extends('fe.layout.main')

@section('title','Detail Kerusakan')

@section('home','')
@section('peta','')
@section('profile','')
@section('kontak','')
@section('data','active')

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
                    <h1 class="mb-3">Detail Kerusakan</h1>
                    <p>Halaman ini berisi berisi detail informasi dari kerusakan yang dimaksud.</p>
                </div>
              </div>
        </div>
    </div>
</div>{{-- Jumbotron --}}

<div class="site-section bg-light pb-5" id="contact-section">
    <div class="container">
        <div class="row justify-content-center text-center">
            <div class="col-7 text-center mb-5">
                <h2>DETAIL KERUSAKAN "<i>{{$data->Nama_Tempat}}</i>"</h2>
                <input type="hidden" id="id" value="{{$data->Id_Kerusakan}}">
            </div>
        </div>
        <div class="col-12">
            <div class="col-12 px-0 mb-5" id="wadahmaps">
                <div id="mapid"></div>
            </div>
        </div>
        <script src="{{asset('/fe_aset/peta_aset/only_poly.js')}}"></script>
        <script src="{{asset('/fe_aset/peta_aset/bundle.js')}}"></script>
        <script src="{{asset('/fe_aset/peta_aset/maps_detail.js')}}"></script>
        <div class="col-12 mt-5">
            <div class="card card-default">
                <!-- /.card-header -->
                <div class="card-body">
                    <div class="row mt-5">
                        <div class="col-md-5">
                            <h4>Alamat</h4>
                            <p>RT/RW            : <strong>{{$data->RT}}/{{$data->RW}}</strong></p><br>
                            <p>Garis Bujur      : <strong>{{$data->Garis_Bujur}}</strong></p><br>
                            <p>Garis Lintang    : <strong>{{$data->Garis_Lintang}}</strong></p><br>
                            <h4>Detail</h4>
                            <p>Jenis Kerusakan  : <strong>
                                    @foreach ($jenis as $jeniss)
                                        @if ($data->Id_Jenis == $jeniss->Id_Jenis)
                                            {{ $jeniss->Jenis_Kerusakan}}
                                        @endif
                                    @endforeach    
                            </strong></p><br>
                            <p>Level Kerusakan  : <strong>{{$data->Level_Kerusakan}}</strong></p><br>
                            <p>Status           : <strong>{{$data->Status}} dikerjakan</strong></p><br>
                            <p>Tahun Perbaikan  : <strong>{{$data->Tahun_Perbaikan}}</strong></p><br>
                            <p>Jenis Perbaikan  : <strong>{{$data->Jenis_Perbaikan}}</strong></p><br>
                            <p>Manfaat          : <strong>{{$data->Manfaat}}</strong></p><br>
                        </div>
                        <div class="col-md-6 ml-auto">
                            <h4>Foto</h4>
                            <p>Foto Kerusakan             : </p>
                            <img src="/be_aset/dist/img/kerusakan/{{$data->Foto1}}" alt="" width="100%" height="auto">
                            @if($data->Status == "Selesai")
                                    <br>
                                    <br>
                                    <p>Foto Perbaikan             : </p>
                                    <img src="/be_aset/dist/img/kerusakan/{{$data->Foto2}}" alt="" width="100%" height="auto">
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- KOMENTAR --}}
        <div class="row mt-5">
            <div class="col-12">
                <div class="card bg-gradient-light">
                    <div class="card-header">
                        <div class="card-title">
                            <h3>Tambah Komentar</h3>
                        </div>
                    </div>
                    <div class="card-body">
                        <form action="/komentar" method="POST">
                            @csrf
                            <input type="hidden" name="Id_Detail" value="{{ $data->Id_Detail }}">
                            <input type="hidden" name="Id_Kerusakan" value="{{ $data->Id_Kerusakan }}">
                            <div class="form-group">
                                <label for="exampleFormControlInput1">Email</label>
                                <input type="email" class="form-control @error('email') is-invalid @enderror"
                                    value="{{ old('email')}}" id="exampleFormControlInput1" name="email"
                                    placeholder="nama@example.com">
                                @error('email')
                                <div class="invalid-feedback">{{$message}}</div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="exampleFormControlTextarea1">Komentar</label>
                                <textarea class="form-control @error('komentar') is-invalid @enderror"
                                    id="exampleFormControlTextarea1" name="komentar" rows="3" placeholder="Komentar">{{ old('komentar')}}</textarea>
                                @error('komentar')
                                <div class="invalid-feedback">{{$message}}</div>
                                @enderror
                            </div>
                            <button type="submit" class="btn btn-primary">Kirim</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="row mt-5">
            <div class="col-12">
                <div class="card bg-gradient-light">
                    <div class="card-header">
                        <div class="card-title">
                            <h3>Komentar untuk "<i>{{$data->Nama_Tempat}}</i>"</h3>
                        </div>
                    </div>
                    <div class="card-body">
                        @foreach ($komentar as $komen)
                        @if ($komen->Id_Detail == $data->Id_Detail)
                            <div class="comment-personal">
                                <div class="row">
                                    <div class="col-10">
                                        <h6 class="ml-1 mt-2"><span id="from">Dari:</span> {{ $komen->email}}</h6>
                                        <p class="ml-5">{{ $komen->komentar }}</p>
                                    </div>
                                </div>
        
                                <hr>
                                @foreach ($balasan as $reply)
                                @if ($reply->Id_Komentar == $komen->Id_Komentar)
                                <div class="ml-5">
                                    <div class="ml-5 text-red">
                                            <h6 class=""><span id="reply-from">Reply from:</span> {{ $reply->email }}</h6>
                                            <p class="ml-5">{{ $reply->komentar }}</p>
                                            <hr>
                                        </div>
                                    </div>
                                    @endif
                                @endforeach
                                <h6 class="ml-5">Balas</h6>
                                <form class="ml-5" id="form-reply" action="/balas" method="POST">
                                    @csrf
                                    <input type="hidden" name="Id_Kerusakan" value="{{ $data->Id_Kerusakan }}">
                                    <input type="hidden" name="Id_Komentar" value="{{ $komen->Id_Komentar }}">
                                    <div class="form-group">
                                        <input type="email" class="form-control @error('email') is-invalid @enderror" name="email"
                                        id="email" placeholder="E-mail" required>
                                        @error('email')
                                        <div class="invalid-feedback">{{$message}}</div>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <textarea class="form-control @error('komentar') is-invalid @enderror" name="komentar" id="komentar" rows="2" placeholder="Komentar" required></textarea>
                                        @error('komentar')
                                        <div class="invalid-feedback">{{$message}}</div>
                                        @enderror
                                    </div>
                                    <button type="submit" class="btn btn-info">Balas</button>
                                </form>
                                <hr>
                                <hr>
                            </div>
                            @endif
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
@endsection
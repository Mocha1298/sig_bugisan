@extends('fe.layout.main')

@section('title','Peta Kerusakan')

@section('home','')
@section('peta','active')
@section('profile','')
@section('kontak','')
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
                    <h1 class="mb-3">Peta Kerusakan.</h1>
                    <p>Halaman ini berisi peta yang berisi informasi kerusakan jalan dan irigasi serta terdapat fitur filter untuk memudahkan Anda dalam menyaring informasi.</p>
                </div>
              </div>
        </div>
    </div>
</div>{{-- Jumbotron --}}

<div class="site-section bg-light" id="contact-section" style="padding-top: 30px;">
    <div class="container">
        <div class="row justify-content-center text-center">
            <div class="col-7 text-center mb-3">
                <h2>PETA KERUSAKAN DESA BUGISAN</h2>
            </div>
        </div>
        <div class="col-md-12 mb-5 mx">
            <div class="card card-default">
                <div class="card-header">
                    <h3 class="card-title">
                        <i class="fas fa-filter"></i>
                        Filter Marker
                    </h3>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                    <div class="box">
                        <div class="row">
                            <div class="col-md-4">
                                <div class="info-box bg-white">
                                    <div class="info-box-content">
                                        <span class="info-box-text">Filter Jenis Kerusakan</span>
                                        <span class="info-box-number">
                                            <br>
                                            <div class="form-group">
                                                <select class="form-control" name="Jenis_Kerusakan" id="Jenis_Kerusakan">
                                                    <option value="">-Pilih-</option>
                                                    @foreach ($jenis as $jeniss)
                                                        <option value="{{$jeniss->Id_Jenis}}">{{$jeniss->Jenis_Kerusakan}}</option>    
                                                    @endforeach
                                                </select>
                                            </div>
                                        </span>
                                    </div>
                                </div>
                            </div>
                        <div class="col-md-4">
                            <div class="info-box bg-white">
                                <div class="info-box-content">
                                    <span class="info-box-text">Filter Level Kerusakan</span>
                                    <span class="info-box-number">
                                        <br>
                                        <div class="form-group">
                                            <select class="form-control" name="Level_Kerusakan" id="Level_Kerusakan">
                                                <option value="">-Pilih-</option>
                                                <option value="Ringan">Ringan</option>
                                                <option value="Sedang">Sedang</option>
                                                <option value="Berat">Berat</option>
                                            </select>
                                        </div>
                                    </span>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="info-box bg-white">
                                <div class="info-box-content">
                                    <span class="info-box-text">Filter RW</span>
                                    <span class="info-box-number">
                                        <br>
                                        <div class="form-group">
                                            <select class="form-control" name="RW" id="RW">
                                                <option value="">-Pilih-</option>
                                                <option value="01">01</option>
                                                <option value="02">02</option>
                                                <option value="03">03</option>
                                                <option value="04">04</option>
                                                <option value="05">05</option>
                                                <option value="06">06</option>
                                                <option value="07">07</option>
                                                <option value="08">08</option>
                                            </select>
                                        </div>
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <button type="submit" class="btn btn-primary px-5 mb-4" id="filter">Filter</button>
                {{-- <div id="mapid"></div> --}}
            </div>
            <!-- /.card-body -->
        </div>
    </div>
</div>
<div class="col-10 px-0 mb-5 mx-auto" id="wadahmaps">
    <div class="card card-light " id="legenda">
        <div class="tombol">
            <span>LEGENDA</span>
        </div>
        <div class="card-body p-0">
            <div class="card card-light" id="content">
                <div class="card-body">
                    <p ><img src="{{asset('/be_aset/dist/img/marker/fix.png')}}" style="float:left;" width="30px"/> : Sedang diperbaiki</p>
                    <p ><img src="{{asset('/be_aset/dist/img/marker/marker-hijau.png')}}" style="float:left;" width="30px"/> : Selesai diperbaiki</p>
                    <p ><img src="{{asset('/be_aset/dist/img/marker/marker-merah.png')}}" style="float:left;" width="30px"/> : Rencana dikerjakan</p>
                </div>
            </div>
        </div>
    </div>
    <div id="mapid"></div>
</div>
<!-- Modal -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLongTitle"><i class="fas fa-warning"></i> Kerusakan tidak ada!</h5>
            </div>
            <div class="modal-footer">
                <div class="col-md-3 ml-auto">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
</div>
<script>$('#legenda .tombol').on('click', function() {
    $(this).parent().toggleClass('open');
  });</script>
<script src="{{asset('/fe_aset/peta_aset/pollygon.js')}}"></script>
<script src="{{asset('/fe_aset/peta_aset/bundle.js')}}"></script>
<script src="{{asset('/fe_aset/peta_aset/maps.js')}}"></script>
<script src="https://s3-us-west-2.amazonaws.com/s.cdpn.io/67683/ccbuildings.js"></script>

@endsection
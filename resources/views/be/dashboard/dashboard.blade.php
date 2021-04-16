@extends('be.layout.main')

@section('title','Dashboard')

@section('dashboard','active')
@section('peta','')
@section('data','')
@section('kerusakan','')
@section('admin','')
@section('master','')
@section('jenis','')

@section('maps.css')
    <!-- MAP -->
    <link rel="stylesheet" href="{{asset('/be_aset/css_peta/style.css')}}">
    <link rel="stylesheet" href="{{asset('/be_aset/css_peta/print.css')}}">
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.6.0/dist/leaflet.css"
    integrity="sha512-xwE/Az9zrjBIphAcBb3F6JVqxf46+CDLwfLMHloNu6KEQCAWi6HcDUbeOfBIptF7tcCzusKFjFw2yuvEpDL9wQ=="
    crossorigin=""/>
    <script src="https://unpkg.com/leaflet@1.6.0/dist/leaflet.js"></script>
    <script src = "https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
@endsection

@section('peta.css')
    <style>
        .leaflet-interactive{
            stroke: white;
            stroke-opacity: 1;
            stroke-width: 3;
            fill: black;
            fill-opacity: 0;
        }
    </style>
@endsection

@section('content')
@if (session('status'))
    <div class="alert alert-success" role="alert">
        {{ session('status') }}
    </div>
@endif
<div class="row">
    <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-info">
              <div class="inner">
                <h3>{{$total}}</h3>

                <p>Kerusakan</p>
              </div>
              <div class="icon">
                <i class="fa fa-puzzle-piece"></i>
              </div>
              <a href="/be/peta" class="small-box-footer">Lihat Lebih Banyak <i class="fas fa-arrow-circle-right"></i></a>
            </div>
    </div>
    <!-- ./col -->
    <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-success p-3">
              <div class="inner">
                <h3>{{$ringan}}</h3>

                <p>Level Ringan</p>
                <div class="icon">
                  <i class="fa fa-flag"></i>
                </div>
              </div>
            </div>
    </div>
    <!-- ./col -->
    <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-warning p-3">
              <div class="inner">
                <h3>{{$sedang}}</h3>

                <p>Level Sedang</p>
                <div class="icon">
                  <i class="fa fa-flag"></i>
                </div>
              </div>
            </div>
    </div>
    <!-- ./col -->
    <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-danger p-3">
              <div class="inner">
                <h3>{{$berat}}</h3>

                <p>Level Berat</p>
                <div class="icon">
                  <i class="fa fa-flag"></i>
                </div>
              </div>
            </div>
    </div>
    <!-- ./col -->
</div>
<section class="col-lg-12 connectedSortable ui-sortable">
  <div class="card bg-gradient-light">
      <div class="card-header border-0 ui-sortable-handle">
              <h3 class="card-title">
                <i class="fas fa-map-marker-alt mr-1"></i>
                Contoh Peta
              </h3>
              <!-- card tools -->
              <div class="card-tools">
                <button type="button" class="btn btn-light btn-sm" data-card-widget="collapse" data-toggle="tooltip" title="Collapse">
                  <i class="fas fa-minus"></i>
                </button>
              </div>
              <!-- /.card-tools -->
      </div>
      <div class="card-body" style="padding:0;">
          <div id="mapid"></div>
          <script src="{{asset('/be_aset/js/only_poly.js')}}"></script>
          <script src="{{asset('/be_aset/js/bundle.js')}}"></script>
          <script src="{{asset('/be_aset/js/maps_contoh.js')}}"></script>
      </div>
      <!-- /.card-body-->
  </div>
</div>

@endsection
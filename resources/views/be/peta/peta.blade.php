@extends('be.layout.main')

@section('title','Peta Kerusakan')

@section('dashboard','')
@section('peta','active')
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
@if(session('sukses'))
<div class="alert alert-success" role="alert">
  {{session('sukses')}}
</div>
@endif
<section class="col-lg-12 connectedSortable ui-sortable">
    <div class="col-md-12">
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
                            <div class="info-box bg-primary">
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
                        <div class="info-box bg-primary">
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
                        <div class="info-box bg-primary">
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
            <button type="submit" class="btn btn-primary px-5" id="filter">Filter</button>
        </div>
        <!-- /.card-body -->
    </div>
    <!-- Map card -->
    <div class="card bg-gradient-light">
        <div class="card-header border-0 ui-sortable-handle">
                <h3 class="card-title">
                  <i class="fas fa-map-marker-alt mr-1"></i>
                  Peta Kerusakan
                </h3>
                <!-- card tools -->
                <div class="card-tools">
                    <button class="btn btn-primary btn-sm" id="Tambah_Data">Tambah Data</button>
                    <button type="button" class="btn btn-secondary btn-sm" data-card-widget="collapse" data-toggle="tooltip" title="Collapse">
                        <i class="fas fa-minus"></i>
                    </button>
                </div>
                <!-- /.card-tools -->
        </div>
        <div class="card-body" style="padding:0;">
                <div id="mapid"></div>
                <script src="{{asset('/be_aset/js/pollygon.js')}}"></script>
                <script src="{{asset('/be_aset/js/bundle.js')}}"></script>
                <script src="{{asset('/be_aset/js/maps.js')}}"></script>
        </div>
        <!-- /.card-body-->
    </div>
    <!-- /.card -->
</section>
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
@endsection

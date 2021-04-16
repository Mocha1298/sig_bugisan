@extends('be.layout.main')

@section('title','Tabel Kerusakan')

@section('dashboard','')
@section('peta','')
@section('data','active')
@section('kerusakan','active')
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
@if(session('ubah'))
<div class="alert alert-warning" role="alert">
  {{session('ubah')}}
</div>
@endif
<div class="row">
    <div class="col-lg-6">
          <div class="card">
            <div class="card-header">
                <h3 class="card-title">Detail Kerusakan : <strong>{{$data->Nama_Tempat}}</strong></h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
                <input type="hidden" id="id" value="{{$data->Id_Kerusakan}}">
                <h4>Alamat</h4>
                <p>RT/RW            : <strong>{{$data->RT}}/{{$data->RW}}</strong></p>
                <p>Garis Bujur      : <strong>{{$data->Garis_Bujur}}</strong></p>
                <p>Garis Lintang    : <strong>{{$data->Garis_Lintang}}</strong></p>
                <h4>Detail</h4>
                <p>Jenis Kerusakan  : <strong>
                    @foreach ($jenis as $jeniss)
                        @if ($data->Id_Jenis == $jeniss->Id_Jenis)
                            {{ $jeniss->Jenis_Kerusakan}}
                        @endif
                    @endforeach    
                </strong></p>
                <p>Level Kerusakan  : <strong>{{$data->Level_Kerusakan}}</strong></p>
                <p>Status           : <strong>{{$data->Status}} dikerjakan</strong></p>
                <p>Tahun Perbaikan  : <strong>{{$data->Tahun_Perbaikan}}</strong></p>
                <p>Jenis Perbaikan  : <strong>{{$data->Jenis_Perbaikan}}</strong></p>
                <p>Manfaat          : <strong>{{$data->Manfaat}}</strong></p>
                <p>Foto Kerusakan             : </p>
                <img src="/be_aset/dist/img/kerusakan/{{$data->Foto1}}" alt="" width="100%" height="auto">
                @if($data->Status == "Selesai")
                    <br>
                    <br>
                    <p>Foto Perbaikan             : </p>
                    <img src="/be_aset/dist/img/kerusakan/{{$data->Foto2}}" alt="" width="100%" height="auto">
                @endif
            </div>
            <div class="card-footer d-flex col-12">
                <a href="/be/detail/all/{{$data->Id_Kerusakan}}" class="text-dark"><button class="btn btn-warning" type="button">Ubah Semua</button></a>
                <button class="btn btn-warning ml-3" type="button" data-toggle="modal" data-target="#exampleModal">
                    Ubah Status
                </button>
                <button type="button" class="btn btn-danger ml-auto" data-toggle="modal" data-target="#exampleModalCenter">
                    Hapus Data
                </button>
            </div>
            <!-- /.card-body -->
          </div>
          <!-- /.card -->
    </div>
    <!-- Map card -->
    <section class="col-lg-6 connectedSortable ui-sortable">
        <div class="card bg-gradient-primary">
            <div class="card-header border-0 ui-sortable-handle">
                    <h3 class="card-title">
                    <i class="fas fa-map-marker-alt mr-1"></i>
                    Peta Kerusakan : {{$data->Nama_Tempat}}
                    </h3>
                    <!-- card tools -->
                    <div class="card-tools">
                    <button type="button" class="btn btn-primary btn-sm" data-card-widget="collapse" data-toggle="tooltip" title="Collapse">
                        <i class="fas fa-minus"></i>
                    </button>
                    </div>
                    <!-- /.card-tools -->
            </div>
            <div class="card-body" style="padding:0;">
                <div id="mapid"></div>
                <script src="{{asset('/be_aset/js/only_poly.js')}}"></script>
                <script src="{{asset('/be_aset/js/bundle.js')}}"></script>
                <script src="{{asset('/be_aset/js/maps_detail.js')}}"></script>
            </div>
            <!-- /.card-body-->
        </div>

    </section>
</div>
<div class="row">
    <section class="col-lg-6 connectedSortable ui-sortable">
        <div class="card bg-gradient-light">
            <div class="card-header border-0 ui-sortable-handle">
                <h3 class="card-title">
                    Komentar  untuk "<i>{{$data->Nama_Tempat}}</i>"
                </h3>
                <!-- card tools -->
                <div class="card-tools">
                <button type="button" class="btn btn-light btn-sm" data-card-widget="collapse" data-toggle="tooltip" title="Collapse">
                    <i class="fas fa-minus"></i>
                </button>
                </div>
                <!-- /.card-tools -->
            </div>
            <div class="card-body">
                @foreach ($komentar as $komen)
                    @if ($komen->Id_Detail == $data->Id_Detail)
                        <div class="comment-personal">
                            <div class="row">
                                <div class="col-10">
                                    <h6 class="ml-1 mt-2"><span id="from">Dari:</span> {{ $komen->email}}</h6>
                                    <p class="ml-5">{{ $komen->komentar}}</p>
                                </div>
                                <div class="col-2">
                                    <form action="#" method="post" class="d-inline">
                                        @method('delete')
                                        @csrf
                                        <button type="submit" class="btn btn-danger btn-sm">Hapus</button>
                                    </form>
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
                            <form class="ml-5" id="form-reply" action="/be/komentar/balas" method="POST">
                                @csrf
                                <input type="hidden" name="Id_Kerusakan" value="{{ $data->Id_Kerusakan }}">
                                <input type="hidden" name="Id_Komentar" value="{{ $komen->Id_Komentar }}">
                                <input type="hidden" name="email" value="{{ Auth::user()->name }}">
                                <div class="form-group">
                                    <textarea class="form-control @error('komentar') is-invalid @enderror" name="komentar" id="komentar" rows="2" placeholder="komentar" required></textarea>
                                    @error('komentar')
                                    <div class="invalid-feedback">{{$message}}</div>
                                    @enderror
                                </div>
                                <button type="submit" class="btn btn-info">Reply</button>
                            </form>
                            <hr>
                            <hr>
                        </div>
                    @endif
                @endforeach
            </div>
        </div>
    </section>
</div>

<!-- Modal Ubah Status -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <form action="/be/kerusakan/proses_status" method="post" enctype="multipart/form-data" role="form">
        @csrf
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Ubah Status Kerusakan</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
            <input type="hidden" name="det" value="{{$data->Id_Detail}}">
                <div class="form-group">
                    <select name="Status" id="mySelect" class="form-control">
                        <option @if ($data->Status == 'Rencana') selected @endif value="Rencana">Rencana dikerjakan</option>
                        <option @if ($data->Status == 'Sedang') selected @endif value="Sedang">Sedang dikerjakan</option>
                        <option @if ($data->Status == 'Selesai') selected @endif value="Selesai">Selesai dikerjakan</option>
                    </select>
                </div>
                <div class="form-group">
                    <div id="judul"></div>
                    <div class="input-group">
                        <div class="custom-file">
                            <div id="foto"></div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-primary">Simpan</button>
            </div>
        </div>
        </form>
    </div>
</div>
<!-- Modal -->
<div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLongTitle">PERINGANTAN !!!</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-body">
            APAKAH ANDA YAKIN INGIN MENGHAPUS DATA ?
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
            <a href="/be/detail/delete/{{$data->Id_Kerusakan}}"><button type="button" class="btn btn-danger">Ya, Hapus</button></a>
        </div>
        </div>
    </div>
</div>
@endsection
@extends('be.layout.main')

@section('title','Ubah Semua Data Kerusakan')

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
<div class="row">
    <div class="col-md-12">
        <div class="card card-primary">
            <div class="card-header">
                <h3 class="card-title">Form Tambah Data</h3>
                <div class="card-tools">
                    <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i></button>
                </div>
            </div>
            <!-- /.card-header -->
            <!-- form start -->
            <form action="/be/kerusakan/proses_ubah" method="post" enctype="multipart/form-data" role="form" >
            @csrf
                <div class="card-body">
                <input type="hidden" name="rusak" value="{{$data->Id_Kerusakan}}">
                <input type="hidden" name="det" value="{{$data->Id_Detail}}">
                    <div class="form-group">
                        <label>Nama Tempat</label>
                        <input value="{{$data->Nama_Tempat}}" name="Nama_Tempat" id="Nama_Tempat" type="text" class="form-control @error('Nama_Tempat') is-invalid @enderror" placeholder="Masukan Nama Tempat">
                        @error('Nama_Tempat')
                        <div class="invalid-feedback">
                            {{$message}}
                        </div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label>RT</label>
                        <select name="RT" class="form-control @error('RT') is-invalid @enderror">
                            <option @if ($data->RT=='01') selected @endif value="01">01</option>
                            <option @if ($data->RT=='02') selected @endif value="02">02</option>
                            <option @if ($data->RT=='03') selected @endif value="03">03</option>
                            <option @if ($data->RT=='04') selected @endif value="04">04</option>
                            <option @if ($data->RT=='05') selected @endif value="05">05</option>
                        </select>
                        @error('RT')
                        <div class="invalid-feedback">
                            {{$message}}
                        </div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label>RW</label>
                        <select name="RW" class="form-control @error('RW') is-invalid @enderror">
                            <option @if ($data->RW=='01') selected @endif value="01">01</option>
                            <option @if ($data->RW=='02') selected @endif value="02">02</option>
                            <option @if ($data->RW=='03') selected @endif value="03">03</option>
                            <option @if ($data->RW=='04') selected @endif value="04">04</option>
                            <option @if ($data->RW=='05') selected @endif value="05">05</option>
                            <option @if ($data->RW=='06') selected @endif value="06">06</option>
                            <option @if ($data->RW=='07') selected @endif value="07">07</option>
                            <option @if ($data->RW=='08') selected @endif value="08">08</option>
                        </select>
                        @error('RW')
                        <div class="invalid-feedback">
                            {{$message}}
                        </div>
                        @enderror
                    </div>
                    <div class="card bg-gradient-light">
                        <div class="card-header border-0 ui-sortable-handle">
                            <h3 class="card-title">
                            <i class="fas fa-map-marker-alt mr-1"></i>
                            Pilih Lokasi
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
                        </div>
                        <div class="card-footer bg-transparent">
                            <div class="row">
                                <div class="col-4 text-center">
                                    <div class="text-white">
                                        <input value="{{$data->Garis_Bujur}}" type="text" class="form-control @error('Garis_Bujur') is-invalid @enderror" name="Garis_Bujur" id="Garis_Bujur" readonly>
                                        @error('Garis_Bujur')
                                        <div class="invalid-feedback">
                                            {{$message}}
                                        </div>
                                        @enderror
                                    </div>
                                </div>
                                <!-- ./col -->
                                <div class="col-4 text-center">
                                    <div class="text-white">
                                        <input value="{{$data->Garis_Lintang}}" type="text" class="form-control @error('Garis_Lintang') is-invalid @enderror" name="Garis_Lintang" id="Garis_Lintang" readonly>
                                        @error('Garis_Lintang')
                                        <div class="invalid-feedback">
                                            {{$message}}
                                        </div>
                                        @enderror
                                    </div>
                                </div>
                                <!-- ./col -->
                            </div>
                            <!-- /.row -->
                        </div>
                        <!-- /.card-body-->
                    </div>
                    <div class="form-group">
                        <label>Jenis Kerusakan</label>
                        <select name="Jenis_Kerusakan" class="form-control @error('Jenis_Kerusakan') is-invalid @enderror">
                            @foreach ($jenis as $jeniss)
                                <option 
                                @if (old('Jenis_Kerusakan') == $jeniss->Id_Jenis || $jeniss->Id_Jenis == $data->Id_Jenis)
                                    selected
                                @endif 
                                value="{{$jeniss->Id_Jenis}}">{{$jeniss->Jenis_Kerusakan}}</option>    
                            @endforeach
                        </select>
                        @error('Jenis_Kerusakan')
                        <div class="invalid-feedback">
                            {{$message}}
                        </div>
                        @enderror
                    </div>
                    <div class="form-group">
                            <label>Level Kerusakan</label>
                            <select name="Level_Kerusakan" class="form-control @error('Level_Kerusakan') is-invalid @enderror">
                                <option @if ($data->Level_Kerusakan=='Ringan') selected @endif value="Ringan">Ringan</option>
                                <option @if ($data->Level_Kerusakan=='Sedang') selected @endif value="Sedang">Sedang</option>
                                <option @if ($data->Level_Kerusakan=='Berat') selected @endif value="Berat">Berat</option>
                            </select>
                            @error('Level_Kerusakan')
                            <div class="invalid-feedback">
                                {{$message}}
                            </div>
                            @enderror
                    </div>
                    <div class="form-group col-6">
                        <label for="">Tahun Perbaikan</label>
                        <input value="{{$data->Tahun_Perbaikan}}" type="number" class="form-control @error('Tahun_Perbaikan') is-invalid @enderror" name="Tahun_Perbaikan" min="2019" value="2019" placeholder="2019">
                        @error('Tahun_Perbaikan')
                        <div class="invalid-feedback">
                            {{$message}}
                        </div>
                        @enderror
                    </div>
                    <div class="form-group">
                            <label>Jenis Perbaikan</label>
                            <select name="Jenis_Perbaikan" class="form-control @error('Jenis_Perbaikan')is-invalid @enderror">
                                <option @if ($data->Jenis_Perbaikan=='Kecil') selected @endif value="Kecil">Kecil</option>
                                <option @if ($data->Jenis_Perbaikan=='Besar') selected @endif value="Besar">Besar</option>
                            </select>
                            @error('Jenis_Perbaikan')
                            <div class="invalid-feedback">
                                {{$message}}
                            </div>
                            @enderror
                    </div>
                    <div class="form-group">
                          <label>Manfaat</label>
                          <textarea name="Manfaat" class="form-control @error('Manfaat') is-invalid @enderror" rows="3" >{{$data->Manfaat}}</textarea>
                          @error('Manfaat')
                            <div class="invalid-feedback">
                                {{$message}}
                            </div>
                            @enderror
                    </div>
                    <input type="hidden" name="Status" value="{{$data->Status}}">
                    <div class="form-group">
                        <label for="exampleInputFile">Foto Kerusakan</label>
                        <input type="hidden" name="foto_1" value="{{$data->Foto1}}">
                        <br>
                        <img src="/be_aset/dist/img/kerusakan/{{$data->Foto1}}" alt="" width="200px">
                        <br>
                        <br>
                        <input type="file" id="exampleInputFile" accept="image/*" name="Foto1" class="form-control @error('Foto1')is-invalid @enderror" style="border:0px;">
                        @error('Foto1')
                        <div class="invalid-feedback">
                            {{ $errors->first('Foto1') }}
                        </div>
                        @enderror
                    </div>
                    @if($data->Status=='Selesai')
                        <br>
                        <div class="form-group">
                            <label for="exampleInputFile">Foto Perbaikan</label>
                            <input type="hidden" name="foto_2" value="{{$data->Foto2}}">
                            <br>
                            <img src="/be_aset/dist/img/kerusakan/{{$data->Foto2}}" alt="" width="200px">
                            <br>
                            <br>
                            <input type="file" id="exampleInputFile" accept="image/*" name="Foto2" class="form-control @error('Foto2')is-invalid @enderror" style="border:0px;">
                            @error('Foto2')
                            <div class="invalid-feedback">
                                {{ $errors->first('Foto2') }}
                            </div>
                            @enderror
                        </div>
                    @endif
                    <script src="{{asset('/be_aset/js/pollygon.js')}}"></script>
                    <script src="{{asset('/be_aset/js/bundle.js')}}"></script>
                    <script src="{{asset('/be_aset/js/edit_maps.js')}}"></script>
                </div>
                <!-- /.card-body -->
                <div class="card-footer">
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
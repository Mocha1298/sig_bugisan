@extends('be.layout.main')

@section('title','Tambah Data Kerusakan')

@section('dashboard','')
@section('peta','')
@section('data','active')
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
{{-- @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif --}}
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
            <form action="/be/peta/post" method="post" enctype="multipart/form-data" role="form" >
            @csrf
                <div class="card-body">
                    <input type="hidden" name="id" value="{{ Auth::user()->name }}">
                    {{-- Nama Tempat --}}
                    <div class="form-group">
                        <label>Nama Tempat</label>
                        <input value="{{old('Nama_Tempat')}}" name="Nama_Tempat" type="text" class="form-control @error('Nama_Tempat') is-invalid @enderror" placeholder="Masukan Nama Tempat">
                        @error('Nama_Tempat')
                        <div class="invalid-feedback">
                            {{$message}}
                        </div>
                        @enderror
                    </div>
                    {{-- RT --}}
                    <div class="form-group">
                        <label>RT</label>
                        <select name="RT" class="form-control @error('RT') is-invalid @enderror">
                            <option value="">-Pilih-</option>
                            <option @if (old('RT') == '01')
                                selected
                            @endif value="01">01</option>
                            <option @if (old('RT') == '02')
                                selected
                            @endif value="02">02</option>
                            <option @if (old('RT') == '03')
                                selected
                            @endif value="03">03</option>
                            <option @if (old('RT') == '04')
                                selected
                            @endif value="04">04</option>
                            <option @if (old('RT') == '05')
                                selected
                            @endif value="05">05</option>
                        </select>
                        @error('RT')
                        <div class="invalid-feedback">
                            {{$message}}
                        </div>
                        @enderror
                    </div>
                    {{-- RW --}}
                    <div class="form-group">
                        <label>RW</label>
                        <select name="RW" class="form-control @error('RW') is-invalid @enderror">
                            <option value="">-Pilih-</option>
                            <option @if (old('RW') == '01')
                                selected
                            @endif value="01">01</option>
                            <option @if (old('RW') == '02')
                                selected
                            @endif value="02">02</option>
                            <option @if (old('RW') == '03')
                                selected
                            @endif value="03">03</option>
                            <option @if (old('RW') == '04')
                                selected
                            @endif value="04">04</option>
                            <option @if (old('RW') == '05')
                                selected
                            @endif value="05">05</option>
                            <option @if (old('RW') == '05')
                                selected
                            @endif value="06">06</option>
                            <option @if (old('RW') == '05')
                                selected
                            @endif value="07">07</option>
                            <option @if (old('RW') == '05')
                                selected
                            @endif value="08">08</option>
                        </select>
                        @error('RW')
                        <div class="invalid-feedback">
                            {{$message}}
                        </div>
                        @enderror
                    </div>
                    {{-- Pilih Lokasi --}}
                    <div class="form-group">
                        <label for="Garis Bujur">Garis Bujur</label>
                        <input name="Garis_Bujur" class="form-control @error('Garis_Bujur') is-invalid @enderror" type="text" readonly value="{{ $Garis_Bujur ?? old('Garis_Lintang')}}">
                    </div>
                    <div class="form-group">
                        <label for="Garis Lintang">Garis Lintang</label>
                        <input name="Garis_Lintang" class="form-control @error('Garis_Lintang') is-invalid @enderror" type="text" readonly value="{{ $Garis_Lintang ?? old('Garis_LIntang')}}">
                    </div>
                    {{-- Jenis Kerusakan --}}
                    <div class="form-group">
                        <label>Jenis Kerusakan</label>
                        <select name="Jenis_Kerusakan" class="form-control @error('Jenis_Kerusakan') is-invalid @enderror">
                            <option value="">-Pilih-</option>
                            @foreach ($jenis as $jeniss)
                                <option @if (old('Jenis_Kerusakan') == $jeniss->Id_Jenis)
                                    selected
                                @endif value="{{$jeniss->Id_Jenis}}">{{$jeniss->Jenis_Kerusakan}}</option>    
                            @endforeach
                        </select>
                        @error('Jenis_Kerusakan')
                        <div class="invalid-feedback">
                            {{$message}}
                        </div>
                        @enderror
                    </div>
                    {{-- Level Kerusakan --}}
                    <div class="form-group">
                            <label>Level Kerusakan</label>
                            <select name="Level_Kerusakan" class="form-control @error('Level_Kerusakan') is-invalid @enderror">
                                <option @if (old('Level_Kerusakan') == '')
                                    selected
                                @endif value="">-Pilih-</option>
                                <option @if (old('Level_Kerusakan') == 'Ringan')
                                    selected
                                @endif value="Ringan">Ringan</option>
                                <option @if (old('Level_Kerusakan') == 'Sedang')
                                    selected
                                @endif value="Sedang">Sedang</option>
                                <option @if (old('Level_Kerusakan') == 'Berat')
                                    selected
                                @endif value="Berat">Berat</option>
                            </select>
                            @error('Level_Kerusakan')
                            <div class="invalid-feedback">
                                {{$message}}
                            </div>
                            @enderror
                    </div>
                    {{-- Tahun --}}
                    <div class="form-group col-6">
                        <label for="">Tahun Perbaikan</label>
                        <input value="{{old('Tahun_Perbaikan')}}" type="number" class="form-control @error('Tahun_Perbaikan') is-invalid @enderror" name="Tahun_Perbaikan" min="2019" value="2019" placeholder="2019">
                        @error('Tahun_Perbaikan')
                        <div class="invalid-feedback">
                            {{$message}}
                        </div>
                        @enderror
                    </div>
                    {{-- Jenis Perbaikan --}}
                    <div class="form-group">
                            <label>Jenis Perbaikan</label>
                            <select name="Jenis_Perbaikan" class="form-control @error('Jenis_Perbaikan')is-invalid @enderror">
                                <option value="">-Pilih-</option>
                                <option @if (old('Jenis_Perbaikan') == 'Kecil')
                                    selected
                                @endif value="Kecil">Kecil</option>
                                <option @if (old('Jenis_Perbaikan') == 'Besar')
                                    selected
                                @endif value="Besar">Besar</option>
                            </select>
                            @error('Jenis_Perbaikan')
                            <div class="invalid-feedback">
                                {{$message}}
                            </div>
                            @enderror
                    </div>
                    {{-- Manfaat --}}
                    <div class="form-group">
                          <label>Manfaat</label>
                          <textarea name="Manfaat" class="form-control @error('Manfaat') is-invalid @enderror" rows="3" placeholder="Manfaat ...">{{old('Manfaat')}}</textarea>
                          @error('Manfaat')
                            <div class="invalid-feedback">
                                {{$message}}
                            </div>
                            @enderror
                    </div>
                    {{-- Foto --}}
                    <div class="form-group">
                        <label for="exampleInputFile">Foto Kerusakan</label>
                        <br>
                        <input type="file" id="exampleInputFile" accept="image/*" name="Foto1" class="form-control @error('Foto1')is-invalid @enderror" style="border:0px;">
                        @error('Foto1')
                        <div class="invalid-feedback">
                            {{ $errors->first('Foto1') }}
                        </div>
                        @enderror
                    </div>
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


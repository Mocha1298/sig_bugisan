@extends('fe.layout.main')

@section('title','Data Kerusakan')

@section('home','')
@section('peta','')
@section('profile','')
@section('kontak','')
@section('data','active')

@section('tabel.css')
    <!-- DataTables -->
    <link rel="stylesheet" href="{{asset('/be_aset/plugins/datatables-bs4/css/dataTables.bootstrap4.css')}}">
@endsection

@section('content')
    <div class="ftco-blocks-cover-1">
        <div class="site-section-cover overlay" data-stellar-background-ratio="0.5" style="background-image: url('/images/hero_2.jpg')">
            <div class="container">
                <div class="row align-items-center justify-content-center text-center">
                    <div class="col-md-5 mt-5 pt-5">
                        <h1 class="mb-3">Data Kerusakan.</h1>
                        <p>Halaman ini berisi tabel yang memuat informasi dari seluruh kerusakan yang terjadi di Desa Bugisan.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>{{-- Jumbotron --}}
    <div class="row justify-content-center text-center">
        <div class="col-7 text-center mt-5">
            <h2>DATA KERUSAKAN DESA BUGISAN</h2>
        </div>
    </div>
    <div class="site-section" id="contact-section" style="padding-top: 30px;">
        <div class="row mb-5">
            <div class="card mx-auto col-10 py-2">
                <div class="table-responsive">
                    <table id="example1" class="table table-bordered table-striped">
                    <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Nama Tempat</th>
                        <th scope="col">RT/RW</th>
                        <th scope="col">Jenis Kerusakan</th>
                        <th scope="col">Level Kerusakan</th>
                        <th scope="col">Detail</th>
                    </tr>
                    </thead>
                    <tbody>
                        @foreach ($data as $record)
                        <tr>
                            <th scope="row">{{ $loop->iteration }}</th>
                            <th>{{$record->Nama_Tempat}}</th>
                            <th>{{$record->RT}}/{{$record->RW}}</th>
                            <th>
                                @foreach ($jenis as $jeniss)
                                    @if ($record->Id_Jenis == $jeniss->Id_Jenis)
                                        {{ $jeniss->Jenis_Kerusakan}}
                                    @endif
                                @endforeach    
                            </th>
                            <th>{{ $record->Level_Kerusakan }}</th>
                            <th><a href="/fe/kerusakan/{{$record->Id_Kerusakan}}"><span class="badge bg-danger p-2 text-light">Detail</span></a></th> 
                        </tr>
                        @endforeach
                    </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('tabel')
    <!-- Datatable -->
    <script src="{{asset('/be_aset/plugins/datatables/jquery.dataTables.js')}}"></script>
    <script src="{{asset('/be_aset/plugins/datatables-bs4/js/dataTables.bootstrap4.js')}}"></script>
    <script>
        $(function () {
            $("#example1").DataTable();
            $('#example2').DataTable({
            "paging": true,
            "lengthChange": false,
            "searching": false,
            "ordering": true,
            "info": true,
            "autoWidth": false,
            'responsive':true
            });
        });
    </script>
@endsection

@extends('be.layout.main')

@section('title','Master')

@section('dashboard','')
@section('peta','')
@section('data','')
@section('kerusakan','')
@section('admin','')
@section('master','active')
@section('jenis','active')

@section('tabel.css')
    <!-- DataTables -->
    <link rel="stylesheet" href="{{asset('/be_aset/plugins/datatables-bs4/css/dataTables.bootstrap4.css')}}">
@endsection

@section('content')
@if(session('sukses'))
<div class="alert alert-success" role="alert">
  {{session('sukses')}}
</div>
@endif
@if(session('hapus'))
<div class="alert alert-danger" role="alert">
  {{session('hapus')}}
</div>
@endif
@if(session('ubah'))
<div class="alert alert-warning" role="alert">
  {{session('ubah')}}
</div>
@endif
<div class="row">
    <div class="col-12">
        <!-- /.card -->
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Tabel Master Jenis Kerusakan</h3>
                <div class="card-tools">
                <a href="#" data-toggle="modal" data-target="#exampleModall"><button class="btn btn-primary">Tambah Data</button></a>
            </div>
        </div>
        <!-- /.card-header -->
        <div class="card-body">
            <div class="table-responsive">
                <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                    <th>No</th>
                    <th>Jenis_Kerusakan</th>
                    <th>Aksi</th>
                </tr>
                </thead>
                <tbody>
                    @foreach($jenis as $record)
                    <tr>
                        <th>{{ $loop->iteration }}</td>
                        <td>{{ $record->Jenis_Kerusakan}}</td>
                        <td>
                            <a href="#" data-toggle="modal" data-target="#exampleModal1{{$record->Id_Jenis}}"><span class="badge bg-warning p-2">Edit</span></a>                        
                            <!-- Modal -->
                            <div class="modal fade" id="exampleModal1{{$record->Id_Jenis}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <form action="/be/jenis_kerusakan/{{$record->Id_Jenis}}" method="post">
                                    @csrf
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel">Edit Jenis Kerusakan</h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <div class="form-group">
                                                    <div class="form-row">
                                                        <label>Jenis Kerusakan</label>
                                                        @if ($record->Jenis_Kerusakan )
                                                            
                                                        @endif
                                                        <input name="Jenis_Kerusakan" type="text" class="form-control @error('Jenis_Kerusakan') is-invalid @enderror" value="{{ $record->Jenis_Kerusakan ?? old('Jenis_Kerusakan')}}">
                                                        @error('Jenis_Kerusakan')
                                                            <span class="invalid-feedback" role="alert">
                                                                <strong>{{ $message }}</strong>
                                                            </span>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                                                    <button type="submit" class="btn btn-warning">Simpan</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                            <a href="#" data-toggle="modal" data-target="#exampleModalCenter{{$record->Id_Jenis}}"><span class="badge bg-danger p-2">Hapus</span></a>
                            <!-- Modal -->
                            <div class="modal fade" id="exampleModalCenter{{$record->Id_Jenis}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalCenterTitle">PERINGATAN!!</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                    </div>
                                    <div class="modal-body">
                                        <h3>Apa Anda yakin untuk menghapus data tersebut?</h3>
                                    </div>
                                    <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                                    <a href="/be/jenis_kerusakan/hapus/{{$record->Id_Jenis}}"><button type="button" class="btn btn-danger">Ya, saya yakin</button></a>
                                    </div>
                                </div>
                                </div>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
                </table>
            </div>
        </div>
        <!-- /.card-body -->
    </div>
    <!-- /.col -->
</div>

<div class="modal fade" id="exampleModall" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <form action="/be/jenis_kerusakan/tambah" method="post">
        @csrf
        <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Edit Jenis Kerusakan</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            </div>
            <div class="modal-body">
                    <div class="form-group">
                        <div class="form-row">
                            <label>Jenis Kerusakan</label>
                            <input name="Jenis_Kerusakan" type="text" class="form-control @error('Jenis_Kerusakan') is-invalid @enderror" value="{{ old('Jenis_Kerusakan') }}">
                            @error('Jenis_Kerusakan')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
            </div>
        </div>
    </form>
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
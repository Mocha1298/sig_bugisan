@extends('be.layout.main')

@section('title','Data Admin')

@section('dashboard','')
@section('peta','')
@section('data','')
@section('kerusakan','')
@section('admin','active')
@section('master','')
@section('jenis','')

@section('tabel.css')
    <!-- DataTables -->
    <link rel="stylesheet" href="{{asset('/be_aset/plugins/datatables-bs4/css/dataTables.bootstrap4.css')}}">
@endsection

@section('content')
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
            <h3 class="card-title">Tabel Data Admin</h3>
            <div class="card-tools">
                <a href="/be/admin/tambah"><button class="btn btn-primary" >Tambah</button></a>
            </div>
        </div>
        <!-- /.card-header -->
        <div class="card-body">
            <div class="table-responsive">
                <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                    <th>No</th>
                    <th>Nama Admin</th>
                    <th>Email</th>
                    <th>Aksi</th>
                </tr>
                </thead>
                <tbody>
                    @foreach($user as $data)
                        @if ($data->name==Auth::user()->name)
                            <tr>
                                <th>{{ $loop->iteration }}</td>
                                <td>{{ $data->name}}</td>
                                <td>{{ $data->email}}</td>
                                <td>
                                    <a href="/be/admin/edit/{{$data->id}}" ><span class="badge bg-warning p-2">edit</span></a>
                                </td>
                            </tr>
                        @else
                            <tr>
                                <th>{{ $loop->iteration }}</td>
                                <td>{{ $data->name}}</td>
                                <td>{{ $data->email}}</td>
                                <td></td>
                            </tr>
                        @endif
                    @endforeach
                </tbody>
                </table>
            </div>
        </div>
        <!-- /.card-body -->
        </div>
    </div>
    <!-- /.col -->
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
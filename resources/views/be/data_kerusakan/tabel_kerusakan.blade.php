@extends('be.layout.main')

@section('title','Tabel Kerusakan')

@section('dashboard','')
@section('peta','')
@section('data','active')
@section('kerusakan','active')
@section('admin','')
@section('master','')
@section('jenis','')

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
<div class="row">
    <div class="col-12">
        <!-- /.card -->
        <div class="card">
          <div class="card-header">
            <h3 class="card-title">Tabel Data Kerusakan</h3>
            <div class="card-tools">
            <a href="/be/kerusakan/tambah"><button class="btn btn-primary">Tambah Data</button></a>
          </div>
          </div>
          <!-- /.card-header -->
          <div class="card-body">
            <div class="table-responsive">
                <table id="example1" class="table table-bordered table-striped">
                  <thead>
                  <tr>
                    <th>No</th>
                    <th>Nama Tempat</th>
                    <th>RT</th>
                    <th>RW</th>
                    <th>Jenis Kerusakan</th>
                    <th>Detail</th>
                  </tr>
                  </thead>
                  <tbody>
                      @foreach($data as $record)
                      <tr>
                          <th>{{ $loop->iteration }}</td>
                          <td>{{ $record->Nama_Tempat}}</td>
                          <td>{{ $record->RT}}</td>
                          <td>{{ $record->RW}}</td>
                          <td>
                              @foreach ($jenis as $jeniss)
                                  @if ($record->Id_Jenis == $jeniss->Id_Jenis)
                                      {{ $jeniss->Jenis_Kerusakan}}
                                  @endif
                              @endforeach
                          </td>
                          <td><a href="/be/kerusakan/{{$record->Id_Kerusakan}}"><span class="badge bg-danger p-2">Detail</span></a></td>
                      </tr>
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
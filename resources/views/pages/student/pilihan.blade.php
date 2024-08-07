@extends('layouts/aplikasi')

@section('css')
{{-- <link rel="stylesheet" href="	https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css"> --}}
@endsection

@section('navbrand')
<nav aria-label="breadcrumb">
  <ol class="breadcrumb bg-transparent mb-0 pb-0 pt-1 px-0 me-sm-6 me-5 mb-1">
    <li class="breadcrumb-item text-sm">
      <a class="opacity-5 text-dark" href="{{ auth()->user()->role == 'Guru' ? route('admin') : route('user') }}">LearnClass</a>
    </li>
    <li class="breadcrumb-item text-sm text-dark active" aria-current="page">Kelas</li>
  </ol>
  <h4 class="font-weight-bolder mb-0">Kelas</h4>
</nav>
@endsection

@section('konten')
<table id="myTable" class="table table-striped" style="width:100%">
  <thead>
      <tr>
          <th>No</th>
          <th>Nama Materi</th>
          <th>Tipe</th>
          <th>Aksi</th>
      </tr>
  </thead>
  <tbody>
    @php
        $no = 1;
    @endphp
    @foreach ($materiWithScore as $item)
      <tr>
          <td>{{ $no++ }}</td>
          <td><span class="badge badge-sm bg-gradient-success">{{ $item->judul_tugas }}</span></td>
          <td>{{ $item->tipe }}</td>
          <td class="align-middle text-center">
            <a href="/detailPilihan/{{ $item->id }}"><button type="button" class="btn btn-info"><i class="fa-solid fa-eye"></i></button></a>
          </td>
      </tr>
    @endforeach
  </tbody>
</table>
@endsection

@section('table')
<nav aria-label="breadcrumb">
  <ol class="breadcrumb bg-transparent mb-0 pb-0 pt-1 px-0 me-sm-6 me-5">
    <li class="breadcrumb-item text-sm"><a class="opacity-5 text-dark" href="javascript:;">Pages</a></li>
    <li class="breadcrumb-item text-sm text-dark active" aria-current="page">Quiz</li>
  </ol>
  <h6 class="font-weight-bolder mb-0">Daftar Essay</h6><br>
</nav>
<div class="col-12">
  <div class="card mb-4">
    <div class="card-header pb-0">
    </div>
    <div class="card-body px-0 pt-0 pb-2">
      <div class="table-responsive p-0">
        <table id="table" class="table table-striped" style="width:100%">
          <thead>
              <tr>
                  <th>No</th>
                  <th>Nama Materi</th>
                  <th>Tipe</th>
                  <th>Aksi</th>
              </tr>
          </thead>
          <tbody>
            @php
                $no = 1;
            @endphp
            @foreach ($materiWithoutScore as $item)
              <tr>
                  <td>{{ $no++}}</td>
                  <td><span class="badge badge-sm bg-gradient-success">{{ $item->judul_tugas  }}</span></td>
                  <td>{{ $item->tipe }}</td>
                  <td class="align-middle text-center">
                    <a href="/detailEssay/{{ $item->id }}"><button type="button" class="btn btn-info"><i class="fa-solid fa-eye"></i></button></a>
                  </td>
              </tr>
            @endforeach
          </tbody>
        </table>
      </div>
    </div>
    <div class="card-body px-0 pt-0 pb-2">
    </div>
  </div>
</div>
</div>
<script>
  $(document).ready(function() {
      $('#table').DataTable({
          "columnDefs": [
              { "className": "dt-center", "targets": "_all" }
          ]
      });
      $('#table thead th').addClass('dt-center');
  });
</script>
@endsection
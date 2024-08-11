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
    <li class="breadcrumb-item text-sm text-dark active" aria-current="page">Tugas</li>
  </ol>
  <h4 class="font-weight-bolder mb-0">Tugas</h4>
</nav>
@endsection

@section('konten')
<div class="col-md-12">
  <div class="card border-0">
    <div class="card-header bg-white d-flex align-items-center justify-content-between py-3">
      <div class="container">
        <table id="myTable" class="table table-striped" style="width:100%">
          <thead>
              <tr>
                  <th class="text-center" style="width: 5%;">No</th>
                  <th>Nama Materi</th>
                  <th>Refrensi</th>
                  <th>Aksi</th>
              </tr>
          </thead>
          <tbody>
            @php
                $no = 1;
            @endphp
            @foreach ($materi as $item)
              <tr>
                  <td class="text-center">{{ $no++ }}</td>
                  <td><span class="badge badge-sm bg-gradient-success">{{ $item->nama_materi }}</span></td>
                  <td>
                    <a href="{{ $item->link }}" class="btn btn-primary" target="_blank">Buka Link</a>
                  </td>
                  <td class="align-middle text-center">
                    <a href="/detailMateriStudent/{{ $item->id }}"><button type="button" class="btn btn-info"><i class="fa-solid fa-eye"></i></button></a>
                  </td>
              </tr>
            @endforeach
          </tbody>
        </table>
      </div>
    </div>
  </div>
</div>
@endsection
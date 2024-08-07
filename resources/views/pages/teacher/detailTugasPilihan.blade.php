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

{{-- @section('modal')
<a href="{{ route('tambahSoal', ['id' => $tugasPilihan->id]) }}"><button type="button" class="btn btn-primary float-end">Tambah Soal</button></a>
    </button>

    <h6>Materi</h6>
@endsection --}}

@section('konten')
<div class="col-md-12">
  <div class="card border-0">
    <div class="card-header bg-white d-flex align-items-center justify-content-between py-3">
      <h5 class="mb-0">Data Materi</h5>
      <a href="{{ route('tambahSoal', ['id' => $tugasPilihan->id]) }}" class="btn btn-primary m-0">
        Tambah Soal
      </a>
    </div>
    <div class="card-body px-2 py-3">
      <div class="table-responsive p-0">
      <table id="myTable" class="table table-striped" style="width:100%">
        <thead>
            <tr>
                <th>Nomor</th>
                <th>Soal</th>
                <th>Dibuat</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
          @php
            $no = 1;
          @endphp
          @foreach ($soal as $item)
            <tr>
                <td>{{ $no++ }}</td>
                <td>{!! $item->soal !!}</td>
                <td><span class="badge badge-sm bg-gradient-success">{{ $item->created_at }}</span></td>
                <td class="align-middle text-center">
                  <a href="/tampildataSoal/{{ $item->id }}"><button type="button" class="btn btn-warning"><i class="fa-solid fa-pen-to-square "></i></button></a>
                  <a href="/deleteSoal/{{ $item->id }}"><button type="button" class="btn btn-danger"><i class="fa-solid fa-trash"></i></button></a>
                </td>
            </tr>
          @endforeach
        </tbody>
      </table>
    </div>
  </div>
</div>
@endsection

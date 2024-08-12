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
    <li class="breadcrumb-item text-sm text-dark active" aria-current="page">Penugasan</li>
  </ol>
  <h4 class="font-weight-bolder mb-0">Penugasan</h4>
</nav>
@endsection

@section('konten')
<div class="col-md-12">
  <div class="card border-0">
    <div class="card-header bg-white d-flex align-items-center justify-content-between pb-0">
      <h5 class="mb-0">Detail Tugas - {{ $tugasPilihan->judul_tugas }}</h5>
    </div>
    <div class="card-body">
      <div class="row">
        <div class="col-md-12">
          <p>Tipe Materi: {{ ucfirst($tugasPilihan->tipe) }}</p>
          <p>Jumlah Soal : {{ $jumlahSoal }} Butir</p>
          <p>Deskripsi: {!! $tugasPilihan->deskripsi_tugas !!}</p>
        </div>
        <div class="col-md-12">
          <div class="d-flex justify-content-end">
            <div class="col-md-4 d-flex justify-content-between gap-3">
              <div class="w-100">
                <a href="/penugasan" class="btn btn-warning w-100 mb-0">Kembali</a>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <div class="card border-0 mt-4">
    <div class="card-header bg-white d-flex align-items-center justify-content-between py-3">
      <h5 class="mb-0">Data Soal</h5>
      <a href="{{ route('tambahSoal', ['id' => $tugasPilihan->id]) }}" class="btn btn-primary m-0">
        Tambah Soal
      </a>
    </div>
    <div class="card-body px-2 py-3">
      <div class="table-responsive p-0">
        <table id="myTable" class="table table-striped" style="width:100%">
          <thead>
            <tr>
              <th class="text-center" style="width: 5%;">No</th>
              <th>Soal</th>
              <th class="text-center w-20">Kunci Jawaban</th>
              <th class="text-center w-20">Tanggal Dibuat</th>
              <th class="text-center w-20">Aksi</th>
            </tr>
          </thead>
          <tbody>
            @php
              $no = 1;
            @endphp
            @foreach ($soal as $item)
              <tr>
                <th class="text-center">{{ $no++ }}</th>
                <th>
                  <div>{!! $item->soal !!}</div>
                </th>
                <th class="text-center">{{ $item->answer_key }}</th>
                <th class="text-center"><span class="badge badge-sm bg-gradient-success">{{ $item->created_at }}</span></th>
                <th class="align-middle text-center">
                  <a href="/tampildataSoal/{{ $item->id }}" class="btn btn-warning mb-0">
                    <i class="fa-solid fa-pen-to-square fa-xl"></i>
                  </a>
                  <a href="/deleteSoal/{{ $item->id }}" class="btn btn-danger mb-0">
                    <i class="fa-solid fa-trash fa-xl"></i>
                  </a>
                </th>
              </tr>
            @endforeach
          </tbody>
        </table>
      </div>
    </div>
  </div>
</div>
@endsection


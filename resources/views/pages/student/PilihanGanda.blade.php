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
      <h5 class="mb-0">Detail Tugas - {{ $tugasPilihan->judul_tugas }}</h5>
    </div>
    <div class="card-body">
      <div class="row">
        <div class="col-md-12">
          <p>Jenis Tugas  : {{ ucfirst($tugasPilihan->tipe) }}</p>
          <p>Jumlah Soal : {{ $jumlahSoal }} Butir</p>
          <p>Deskripsi : {!! $tugasPilihan->deskripsi_tugas !!}</p>
        </div>
      </div>
    </div>
    <div class="card-footer">
      <div class="d-flex justify-content-end">
        <div class="col-md-6 d-flex justify-content-between gap-3">
          <div class="w-100">
            <a href="/pilihan" class="btn btn-warning w-100 mb-0">Kembali</a>
          </div>
          <div class="w-100">
            @if ($tugasPilihan->completed)
              <button type="button" class="btn btn-info w-100" disabled>Sudah Selesai</button>
            @else
              <a
                class="btn btn-primary w-100 mb-0"
                href="{{ $tugasPilihan->tipe === 'essay' ? '/detailEssay/' . $tugasPilihan->id : '/detailPilihan/' . $tugasPilihan->id }}">
                Mulai
              </a>
            @endif
          </div>
        </div>
      </div>
    </div>
    </div>
  </div>
</div>
@endsection

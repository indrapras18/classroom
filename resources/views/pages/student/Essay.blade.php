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
      <h5 class="mb-0">Detail Materi</h5>
    </div>
    <div class="card-body">
      <div class="row">
        <div class="col-md-12">
          <h6>Judul Materi  : {{ $tugasEssay->judul_tugas }}</h6>
          <p>Tipe Materi  : {{ ucfirst($tugasEssay->tipe) }}</p>
          <p>Jumlah Soal : {{ $jumlahSoal }}</p>
          <p>Deskripsi  : {!! $tugasEssay->deskripsi_tugas !!}</p>
        </div>
      </div>
    </div>
    <div class="card-footer">
      <small class="text-muted">
        @if ($tugasEssay->completed)
          <button type="button" class="btn btn-info w-100" disabled>Sudah Selesai</button>
        @else
          <a href="{{ $tugasEssay->tipe === 'essay' ? '/detailEssay/' . $tugasEssay->id : '/detailPilihan/' . $tugasEssay->id }}">
            <button type="button" class="btn btn-primary w-100">Mulai</button>
          </a>
        @endif
      </small>
    </div>
  </div>
</div>
@endsection

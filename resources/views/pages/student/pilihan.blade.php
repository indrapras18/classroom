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
<div class="container">
  <div class="row">
    <div class="col-md-12">
      <div class="card border-0">
        <div class="card-header bg-white d-flex align-items-center justify-content-between py-3">
          <h5 class="mb-0">Daftar Tugas</h5>
        </div>
        <div class="card-body">
          @if ($materiWithScore->isNotEmpty() || $materiWithoutScore->isNotEmpty())
            <div class="row row-cols-1 row-cols-md-3 g-4">
              @foreach ($materiWithScore->merge($materiWithoutScore) as $item)
                <div class="col mb-4">
                  <div class="card h-100 text-muted position-relative">
                    <div class="card-body">
                      <h5 class="card-title">{{ $item->judul_tugas }}</h5>
                      <p class="card-text">{{ $item->tipe }}</p>
                      <p class="card-text">{!! Str::limit($item->deskripsi_tugas, 100) !!}</p>
                    </div>
                    <div class="card-footer">
                      <small class="text-muted">
                        @if ($item->completed)
                          <button type="button" class="btn btn-info" disabled><i class="fa-solid fa-eye"></i></button>
                        @else
                          <a href="{{ $item->tipe === 'essay' ? '/detailEssay/' . $item->id : '/detailPilihan/' . $item->id }}">
                            <button type="button" class="btn btn-info"><i class="fa-solid fa-eye"></i></button>
                          </a>
                        @endif
                      </small>
                    </div>
                  </div>
                </div>
              @endforeach
            </div>
          @else
            <div class="alert alert-info" role="alert">
              Belum ada tugas
            </div>
          @endif
        </div>
      </div>
    </div>
  </div>
</div>

@push('js')
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
@endpush
@endsection


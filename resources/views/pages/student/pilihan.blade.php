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
      <div class="card-header bg-white d-flex align-items-center justify-content-between pb-0">
        <h5 class="mb-0">List Tugas</h5>
      </div>
      <div class="card-body">
        @if ($materiWithScore->isNotEmpty() || $materiWithoutScore->isNotEmpty())
          <div class="row row-cols-1 row-cols-md-3 g-4">
            @foreach ($materiWithScore->merge($materiWithoutScore) as $item)
              <div class="col">
                <div class="card h-100 text-muted position-relative">
                  <div class="card-header d-flex align-items-center justify-content-between">
                    <h5 class="card-title">{{ $item->judul_tugas }}</h5>
                    <span class="badge badge-sm bg-gradient-success w-auto">{{ $item->tipe }}</span>
                  </div>
                  <div class="card-body">
                    <p class="card-text mb-0">{!! Str::limit($item->deskripsi_tugas, 100) !!}</p>
                  </div>
                  <div class="card-footer">
                    <small class="text-muted">
                      @if ($item->completed)
                        {{-- <button type="button" class="btn btn-info" disabled><i class="fa-solid fa-eye"></i></button> --}}
                        <button type="button" class="btn btn-info w-100 mb-0" disabled>
                          <i class="fa-solid fa-eye"></i>
                          <span class="ms-2">Lihat Tugas</span>
                        </button>
                      @else
                        {{-- <a href="{{ $item->tipe === 'essay' ? '/deskripsiEssay/' . $item->id : '/deskripsiPilihan/' . $item->id }}">
                          <button type="button" class="btn btn-info"><i class="fa-solid fa-eye"></i></button>
                        </a> --}}
                        <a href="{{ $item->tipe === 'essay' ? '/deskripsiEssay/' . $item->id : '/deskripsiPilihan/' . $item->id }}" class="btn btn-info w-100 mb-0">
                          <i class="fa-solid fa-eye"></i>
                          <span class="ms-2">Lihat Tugas</span>
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
            <p style="color: white">Belum Ada Data Tugas</p>
          </div>
        @endif
      </div>
    </div>
  </div>
@endsection

@push('js')
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
@endpush


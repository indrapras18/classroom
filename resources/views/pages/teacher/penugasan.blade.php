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
      <h5 class="mb-0">Data Tugas</h5>
      <a href="/tambahTugas" class="btn btn-primary m-0">
        Tambah Tugas
      </a>
    </div>
    <div class="container mt-5">
  <div class="row row-cols-1 row-cols-md-3 g-4 mx-3">
      @foreach ($data as $item)
      <div class="col mb-4">
          <div class="card h-100 text-muted position-relative">
              <div class="dropdown position-absolute top-0 end-0 m-2">
                  <button class="btn btn-light" type="button" id="dropdownMenuButton{{ $item->id }}" data-bs-toggle="dropdown" aria-expanded="false">
                      <i class="bi bi-three-dots"></i>
                  </button>
                  <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton{{ $item->id }}">
                      <li>
                          <a class="dropdown-item text-primary" href="{{ $item->tipe === 'essay' ? route('detailTugasEssay', ['id' => $item->id]) : route('detailTugasPilihan', ['id' => $item->id]) }}">
                              Preview
                          </a>
                      </li>
                      <li><a class="dropdown-item text-warning" href="/tampildataPenugasan/{{ $item->id }}">Edit</a></li>
                      <li>
                        <a class="dropdown-item text-danger" href="#" data-bs-toggle="modal" data-bs-target="#deleteModal{{ $item->id }}">
                          Hapus
                        </a>
                      </li>
                  </ul>
              </div>
              <div class="card-body">
                  <h5 class="card-title">{{ $item->judul_tugas }}</h5>
                  <p class="card-text">{!! $item->deskripsi_tugas !!}</p>
                  <p class="card-text">{{ $item->tipe }}</p>
              </div>
              <div class="card-footer">
                  <small class="text-muted">{{ $item->created_at }}</small>
              </div>
          </div>
      </div>

        <!-- Modal Delete -->
        <div class="modal fade" id="deleteModal{{ $item->id }}" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <h1 class="modal-title fs-5" id="deleteModalLabel">Hapus Data Tugas</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
              </div>
              <div class="modal-body">
                <form action="/deleteAssignment/{{ $item->id }}" method="GET">
                  <div class="text-center mb-5">
                    <i class="fa-solid fa-trash text-danger" style="font-size: 10rem;"></i>
                  </div>
                  <div class="d-flex align-items-center justify-content-between gap-3">
                    <button type="button" class="btn btn-secondary w-100 m-0" data-bs-dismiss="modal">Tutup</button>
                    <button type="submit" class="btn btn-danger w-100 m-0">Hapus</button>
                  </div>
                </form>
              </div>
            </div>
          </div>
        </div>

      @endforeach
  </div>
</div>

@push('js')
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
@endpush

@endsection



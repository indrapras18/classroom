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
    <div class="card border-0 overflow-hidden">
      <div class="card-header bg-white d-flex align-items-center justify-content-between py-3">
        <h5 class="mb-0">Data Tugas</h5>
        <a href="/tambahTugas" class="btn btn-primary m-0">Tambah Tugas</a>
      </div>
      <div class="card-body">
        @if (count($data) > 0)
          <div class="row row-cols-1 row-cols-md-3 g-4">
            @foreach ($data as $item)
              <div class="col">
                <div class="card h-100 text-muted position-relative">
                  <div class="dropdown position-absolute top-0 end-0 m-2">
                    <button class="btn btn-light dropdown-toggle" type="button" id="dropdownMenuButton{{ $item->id }}" data-bs-toggle="dropdown" aria-expanded="false"></button>
                    <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton{{ $item->id }}">
                      <li>
                        <a class="dropdown-item text-primary" href="{{ $item->tipe === 'essay' ? route('detailTugasEssay', ['id' => $item->id]) : route('detailTugasPilihan', ['id' => $item->id]) }}">
                          Preview
                        </a>
                      </li>
                      <li><a class="dropdown-item text-warning" href="/tampildataPenugasan/{{ $item->id }}">Edit</a></li>
                      <li>
                        <a class="dropdown-item text-danger" href="/deleteAssignment/{{ $item->id }}">
                          Hapus
                        </a>
                      </li>
                    </ul>
                  </div>
                  <div class="card-body">
                    <h5 class="card-title">{{ $item->judul_tugas }}</h5>
                    <span class="badge badge-sm bg-gradient-success w-auto">{{ $item->tipe }}</span>
                    <p class="card-text">{!! Str::limit($item->deskripsi_tugas, 100) !!}</p>
                  </div>
                  <div class="card-footer">
                    <small class="text-muted">{{ $item->created_at }}</small>
                  </div>
                </div>
              </div>
            @endforeach
          </div>
        @else
          <div class="alert alert-info" role="alert">
            Belum ada data tugas.
          </div>
        @endif
      </div>
    </div>
  </div>
@endsection

@push('js')
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
@endpush

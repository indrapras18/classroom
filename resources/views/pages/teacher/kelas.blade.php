@extends('layouts/aplikasi')

@section('css')

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

<div class="col-md-12">
  <div class="card border-0">
    <div class="card-header bg-white d-flex align-items-center justify-content-between py-3">
      <h5 class="mb-0">Data Kelas</h5>
      <button type="button" class="btn btn-primary m-0" data-bs-toggle="modal" data-bs-target="#createModal">
        Tambah Kelas
      </button>
    </div>
    <div class="card-body px-2 py-3">
      <div class="table-responsive p-0">
        <table id="myTable" class="table table-striped" style="width:100%">
          <thead class="text-start">
            <tr>
              <th class="text-center" style="width: 5%;">No</th>
              <th>Nama Kelas</th>
              <th class="text-center" style="width: 15%;">Aksi</th>
            </tr>
          </thead>
          <tbody>
            @php
              $no = 1;
            @endphp
            @foreach($semuaKelas as $item)
              <tr>
                <th class="text-center">{{ $no++ }}</th>
                <th>{{ $item->nama_kelas }}</th>
                <th class="d-flex align-items-center justify-content-center gap-2">
                  <button class="btn btn-warning m-0" data-bs-toggle="modal" data-bs-target="#editModal{{ $item->id }}">
                    <i class="fa-solid fa-pen-to-square"></i>
                  </button>
                  <button class="btn btn-danger m-0" data-bs-toggle="modal" data-bs-target="#deleteModal{{ $item->id }}">
                    <i class="fa-solid fa-trash"></i>
                  </button>
                </th>
              </tr>

              <!-- Modal Edit -->
              <div class="modal fade" id="editModal{{ $item->id }}" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h1 class="modal-title fs-5" id="editModalLabel">Edit Data Kelas</h1>
                      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                      <form action="/updateKelas/{{ $item->id }}" method="POST">
                        @csrf

                        <label for="">Nama Kelas</label>
                        <div class="input-group mb-3">
                          <input
                            type="text"
                            name="nama_kelas"
                            class="form-control"
                            placeholder="Nama Kelas"
                            value="{{ $item->nama_kelas }}"
                            required
                          >
                        @if ($errors->has('nama_kelas'))
                          <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('nama_kelas') }}</strong>
                          </span>
                        @endif
                        </div>
                        <div class="d-flex align-items-center justify-content-between gap-3">
                          <button type="button" class="btn btn-secondary w-100 m-0" data-bs-dismiss="modal">Tutup</button>
                          <button type="submit" class="btn btn-primary w-100 m-0">Simpan</button>
                        </div>
                      </form>
                    </div>
                  </div>
                </div>
              </div>

              <!-- Modal Delete -->
              <div class="modal fade" id="deleteModal{{ $item->id }}" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h1 class="modal-title fs-5" id="deleteModalLabel">Hapus Data Kelas</h1>
                      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                      <form action="/deleteKelas/{{ $item->id }}" method="GET">
                        <div class="text-center mb-5">
                          <i class="fa-solid fa-trash text-danger" style="font-size: 10rem;"></i>
                        </div>
                        @if ($errors->has('nama_kelas'))
                        <span class="invalid-feedback" role="alert">
                          <strong>{{ $errors->first('nama_kelas') }}</strong>
                        </span>
                        @endif
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
          </tbody>
        </table>
      </div>
    </div>
  </div>
</div>

<!-- Modal Create -->
<div class="modal fade" id="createModal" tabindex="-1" aria-labelledby="createModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="createModalLabel">Tambah Data Kelas</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form action="/tambahKelas" method="post">
          @csrf
          <label for="">Nama Kelas</label>
          <div class="input-group mb-3">
            <input
              type="text"
              name="nama_kelas"
              class="form-control @if($errors->has('nama_kelas')) is-invalid @endif"
              placeholder="Nama Kelas"
              value="{{ old('nama_kelas') }}">

              @if ($errors->has('nama_kelas'))
                <span class="invalid-feedback" role="alert">
                  <strong>{{ $errors->first('nama_kelas') }}</strong>
                </span>
              @endif
          </div>

          <div class="d-flex align-items-center justify-content-between gap-3">
            <button type="button" class="btn btn-secondary w-100 m-0" data-bs-dismiss="modal">Tutup</button>
            <button type="submit" class="btn btn-primary w-100 m-0">Submit</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>
@endsection

@push('js')

@endpush

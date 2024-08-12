@extends('layouts/aplikasi')

@section('css')
{{-- <link rel="stylesheet" href="	https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css"> --}}
@endsection

@section('navbrand')
<nav aria-label="breadcrumb">
  <ol class="breadcrumb bg-transparent mb-0 pb-0 pt-1 px-0 me-sm-6 me-5 mb-1">
    <li class="breadcrumb-item text-sm">
      <a class="opacity-5 text-dark" href="{{ route('admin') }}">LearnClass</a>
    </li>
    <li class="breadcrumb-item text-sm text-dark active" aria-current="page">Siswa</li>
  </ol>
  <h4 class="font-weight-bolder mb-0">Siswa</h4>
</nav>
@endsection

@section('konten')
<div class="col-md-12">
  <div class="card border-0">
    <div class="card-header bg-white d-flex align-items-center justify-content-between py-3">
      <h5 class="mb-0">Data Siswa</h5>
      <button type="button" class="btn btn-primary m-0" data-bs-toggle="modal" data-bs-target="#createModal">
        Tambah Siswa
      </button>
    </div>
    <div class="card-body px-2 py-3">
      <div class="table-responsive p-0">
        <table id="myTable" class="table table-striped" style="width:100%">
          <thead>
            <tr>
              <th class="text-center" style="width: 5%;">No</th>
              <th>Nama</th>
              <th class="text-center w-20">Status</th>
              <th class="text-center w-20">Kelas</th>
              <th class="text-center w-20">Aksi</th>
            </tr>
          </thead>
          <tbody>
            @php
              $no = 1;
            @endphp
            @foreach ($siswa as $item)
              <tr>
                <th class="text-center">{{ $no++ }}</th>
                <th>{{ $item->name }}</th>
                <th class="text-center">
                  <span class="badge badge-sm bg-gradient-success w-50">{{ $item->role }}</span>
                </th>
                <th class="text-center">
                  {{ $item->nama_kelas }}
                </th>
                <th class="d-flex align-items-center justify-content-center gap-2">
                  <button class="btn btn-warning m-0" data-bs-toggle="modal" data-bs-target="#editModal{{ $item->id }}">
                    <i class="fa-solid fa-pen-to-square fa-xl"></i>
                  </button>
                  <button class="btn btn-danger m-0" data-bs-toggle="modal" data-bs-target="#deleteModal{{ $item->id }}">
                    <i class="fa-solid fa-trash fa-xl"></i>
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
                      <form action="/updateSiswa/{{ $item->id }}" method="POST">
                        @csrf

                        <label for="">Nama Lengkap</label>
                        <div class="input-group mb-3">
                          <input
                            type="text"
                            name="name"
                            class="form-control"
                            placeholder="Nama Lengkap"
                            value="{{ $item->name }}"
                            required
                          >
                          @if ($errors->has('name'))
                          <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('name') }}</strong>
                          </span>
                          @endif
                        </div>

                        <label for="">Email</label>
                        <div class="input-group mb-3">
                          <input
                            type="text"
                            name="email"
                            class="form-control"
                            placeholder="Email"
                            value="{{ $item->email }}"
                            required
                          >
                        </div>

                        <div class="mb-3">
                          <label for="password" class="form-label">Password</label>
                          <input type="password" class="form-control" id="password" name="password" placeholder="Password">
                        </div>
                      
                        <div class="mb-3">
                          <label for="id_kelas" class="form-label">Pilih Kelas</label>
                          <select class="form-select" id="id_kelas" name="id_kelas" required>
                              <option selected disabled value="">Pilih Kelas</option>
                              @foreach ($semuaKelas as $kelas)
                              <option value="{{ $kelas->id }}" {{ $kelas->id == $item->id_kelas ? 'selected' : '' }}>{{ $kelas->nama_kelas }}</option>
                              @endforeach
                          </select>
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
                      <h1 class="modal-title fs-5" id="deleteModalLabel">Hapus Data Siswa</h1>
                      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                      <form action="/deleteSiswa/{{ $item->id }}" method="GET">
                        <div class="text-center mb-5">
                          <i class="fa-solid fa-trash text-danger" style="font-size: 10rem;"></i>
                        </div>
                        @if ($errors->has('name'))
                        <span class="invalid-feedback" role="alert">
                          <strong>{{ $errors->first('name') }}</strong>
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
        <h1 class="modal-title fs-5" id="createModalLabel">Tambah Data Siswa</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form action="/tambahSiswa" method="post">
          @csrf
          <div>
            <label for="">Nama Siswa</label>
            <div class="input-group mb-2">
              <input
                type="text"
                name="name"
                class="form-control @if($errors->has('name')) is-invalid @endif"
                placeholder="Nama Lengkap"
                value="{{ old('name') }}"
                required
              >
              @if ($errors->has('name'))
                <span class="invalid-feedback" role="alert">
                  <strong>{{ $errors->first('name') }}</strong>
                </span>
              @endif
            </div>
          </div>

          <div>
            <label for="">Email</label>
            <div class="input-group mb-2">
              <input
                type="email"
                name="email"
                class="form-control @if($errors->has('email')) is-invalid @endif"
                placeholder="Email"
                value="{{ old('email') }}"
                required
              >
              @if ($errors->has('email'))
                <span class="invalid-feedback" role="alert">
                  <strong>{{ $errors->first('email') }}</strong>
                </span>
              @endif
            </div>
          </div>

          <div>
            <label for="">Password</label>
            <div class="input-group mb-2">
              <input
                type="password"
                name="password"
                class="form-control @if($errors->has('password')) is-invalid @endif"
                placeholder="Password"
                required
              >
              @if ($errors->has('password'))
                <span class="invalid-feedback" role="alert">
                  <strong>{{ $errors->first('password') }}</strong>
                </span>
              @endif
            </div>
          </div>

          <div>
            <label for="">Kelas</label>
            <div class="input-group mb-2">
              <select class="form-select" id="id_kelas" name="id_kelas" required>
                <option selected>Pilih Kelas</option>
                @foreach ($semuaKelas as $item)
                <option value="{{ $item->id }}">{{ $item->nama_kelas }}</option>
                @endforeach
              </select>
            </div>
          </div>

          <div class="d-flex align-items-center justify-content-between gap-3 mt-4">
            <button type="button" class="btn btn-secondary w-100 mb-0" data-bs-dismiss="modal">Tutup</button>
            <button type="submit" class="btn btn-primary w-100 mb-0">Submit</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>
@endsection
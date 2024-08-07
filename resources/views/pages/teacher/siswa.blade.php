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
              <th>No</th>
              <th>Nama</th>
              <th>Status</th>
              <th>Kelas</th>
              <th>Aksi</th>
            </tr>
          </thead>
          <tbody>
            @php
              $no = 1;
            @endphp
            @foreach ($siswa as $item)
              <tr>
                <td>{{ $no++ }}</td>
                <td>{{ $item->name }}</td>
                <td><span class="badge badge-sm bg-gradient-success">{{ $item->role }}</span></td>
                <td>{{ $item->nama_kelas }}</td>
                <td class="align-middle text-center">
                  <a href="/tampildataSiswa/{{ $item->id }}"><button type="button" class="btn btn-warning"><i class="fa-solid fa-pen-to-square "></i></button></a>
                  <a href="/deleteSiswa/{{ $item->id }}"><button type="button" class="btn btn-danger"><i class="fa-solid fa-trash"></i></button></a>
                </td>
              </tr>
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
            <div class="input-group mb-3">
              <input
                type="text"
                name="name"
                class="form-control @if($errors->has('name')) is-invalid @endif"
                placeholder="Nama Lengkap"
                value="{{ old('name') }}"
                {{-- required --}}
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
            <div class="input-group mb-3">
              <input
                type="email"
                name="email"
                class="form-control @if($errors->has('email')) is-invalid @endif"
                placeholder="Email"
                value="{{ old('email') }}"
                {{-- required --}}
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
            <div class="input-group mb-3">
              <input
                type="password"
                name="password"
                class="form-control @if($errors->has('password')) is-invalid @endif"
                placeholder="Password"
                {{-- required --}}
              >
              @if ($errors->has('password'))
                <span class="invalid-feedback" role="alert">
                  <strong>{{ $errors->first('password') }}</strong>
                </span>
              @endif
            </div>
          </div>
          <div>
            <label for="">Pilih Kelas</label>
            <div class="input-group mb-3">
              <select class="form-select" id="id_kelas" name="id_kelas" required>
                <option selected>Pilih Kelas</option>
                @foreach ($semuaKelas as $item)
                <option value="{{ $item->id }}">{{ $item->nama_kelas }}</option>
                @endforeach
              </select>
            </div>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary">Simpan</button>
        </div>
      </form>
    </div>
  </div>
</div>
@endsection

@push('js')
{{-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/5.1.3/js/bootstrap.bundle.min.js"></script> --}}
@endpush
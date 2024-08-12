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
    <li class="breadcrumb-item text-sm text-dark active" aria-current="page">Materi</li>
  </ol>
  <h4 class="font-weight-bolder mb-0">Materi</h4>
</nav>
@endsection

@section('konten')
<div class="col-md-12">
  <div class="card border-0">
    <div class="card-header bg-white d-flex align-items-center justify-content-between py-3">
      <h5 class="mb-0">Data Materi</h5>
      <a href="/uploadMateri" class="btn btn-primary m-0">
        Tambah Materi
      </a>
    </div>
    <div class="card-body px-2 py-3">
      <div class="table-responsive p-0">
        <table id="myTable" class="table table-striped" style="width:100%">
          <thead>
            <tr>
              <th class="text-center w-5">No</th>
              <th class="w-auto">Nama Materi</th>
              <th class="text-center w-20">Refrensi</th>
              <th class="text-center w-20">Aksi</th>
            </tr>
          </thead>
          <tbody>
            @php
              $no = 1;
            @endphp
            @foreach($materi as $item)
              <tr>
                <th class="text-center">{{ $no++ }}</th>
                <th>{{ $item->nama_materi }}</th>
                <th class="text-center">
                  <a href="{{ $item->link }}" class="btn btn-danger mb-0" target="_blank">
                    <i class="fa-brands fa-youtube fa-xl me-2"></i>
                    Buka Link
                  </a>
                </th>
                <th class="d-flex align-items-center justify-content-between gap-2">
                  <a href="/detailMateri/{{ $item->id }}" class="btn btn-info mb-0">
                    <i class="fa-solid fa-eye fa-xl"></i>
                  </a>
                  <a href="/tampildataMateri/{{ $item->id }}" class="btn btn-warning mb-0">
                    <i class="fa-solid fa-pen-to-square fa-xl"></i>
                  </a>
                  <button class="btn btn-danger mb-0" data-bs-toggle="modal" data-bs-target="#deleteModal{{ $item->id }}">
                    <i class="fa-solid fa-trash fa-xl"></i>
                  </button>                    
                </th>
              </tr>

                <!-- Modal Delete -->
                <div class="modal fade" id="deleteModal{{ $item->id }}" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
                  <div class="modal-dialog">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h1 class="modal-title fs-5" id="deleteModalLabel">Hapus Data Materi</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                      </div>
                      <div class="modal-body">
                        <form action="/deleteMateri/{{ $item->id }}" method="GET">
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
          </tbody>
        </table>
      </div>
    </div>
  </div>
</div>
@endsection
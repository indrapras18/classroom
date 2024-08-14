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
    <li class="breadcrumb-item text-sm text-dark active" aria-current="page">Hasil Belajar</li>
  </ol>
  <h4 class="font-weight-bolder mb-0">Hasil Belajar</h4>
</nav>
@endsection

@section('konten')
<div class="col-md-12">
  <div class="card border-0">
    <div class="card-header bg-white d-flex align-items-center justify-content-between pb-0">
      <h5 class="mb-0">List Hasil Belajar</h5>
    </div>
    <div class="card-body px-2 py-3">
      <div class="table-responsive p-0">
        <table id="myTable" class="table table-striped" style="width:100%">
          <thead>
            <tr>
              <th class="text-center w-5">No</th>
              <th class="w-auto">Judul Tugas</th>
              <th class="w-20 text-center">Jenis Tugas</th>
              <th class="w-10 text-center">Skor</th>
              <th class="w-10 text-center">Tanggal</th>
              <th class="w-10 text-center">Aksi</th>
            </tr>
          </thead>
          @php
              $no = 1;
          @endphp
          <tbody>
            @foreach($studentScores as $score)
              <tr>
                <th class="text-center">{{ $no++ }}</th>
                <th>{{ $score->assignment->judul_tugas }}</th>
                <th class="text-center">
                  <span class="badge badge-sm bg-success">
                    {{ $score->assignment->tipe == 'pilihan' ? 'Pilihan Ganda' : 'Essay' }}
                  </span>
                </th>
                <th class="text-center">{{ $score->total_score }}</th>
                <th>
                  <span class="badge badge-sm bg-secondary">{{ $score->created_at }}</span>
                </th>
                <th class="text-center">
                  <a href="{{ route('detailTugas', $score->assignment->id) }}" class="btn btn-info btn-sm">Detail</a>
                </th>
              </tr>
            @endforeach
          </tbody>
        </table>
      </div>
    </div>
  </div>
</div>
@endsection


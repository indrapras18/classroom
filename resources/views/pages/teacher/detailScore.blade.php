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
            <h5 class="mb-0">Detail Hasil Belajar - {{ $student->name }}</h5>
        </div>
        <div class="card-body px-2 py-3">
            <div class="table-responsive p-0">
                <table id="myTable" class="table table-striped" style="width:100%">
                    <thead>
                        <tr>
                            <th class="text-center" style="width: 5%;">No</th>
                            <th class="w-auto">Judul Tugas</th>
                            <th class="text-center w-20">Tipe Tugas</th>
                            <th class="text-center w-20">Tanggal</th>
                            <th class="text-center w-10">Total Score</th>
                            <th class="text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                            $no = 1;
                        @endphp
                        @foreach($userScores as $userScore)
                            <tr>
                                <th class="text-center">{{ $no++ }}</th>
                                <th>{{ $userScore->assignment->judul_tugas }}</th>
                                <th class="text-center">
                                    <span class="badge badge-sm bg-success">
                                        {{ $userScore->assignment->tipe == 'pilihan' ? 'Pilihan Ganda' : 'Essay' }}
                                    </span>
                                </th>
                                <th class="text-center">
                                    <span class="badge badge-sm bg-secondary">{{ $userScore->created_at }}</span>
                                </th>
                                <th class="text-center">{{ $userScore->total_score }}</th>
                                <th class="text-center">
                                    <a href="{{ route('detailJawaban.show', [$userScore->id, $userScore->assignment->id]) }}" class="btn btn-info mb-0">
                                        <i class="fa-solid fa-eye fa-xl"></i>
                                    </a>
                                </th>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <div class="d-flex align-items-center justify-content-start mt-3 px-3">
                <div class="w-20 d-flex align-items-center justify-content-between gap-3">
                    <div class="w-100">
                        <a href="/pembelajaran" class="btn btn-warning w-100 mb-0">Kembali</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
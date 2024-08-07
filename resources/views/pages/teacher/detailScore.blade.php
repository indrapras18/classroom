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
    <li class="breadcrumb-item text-sm text-dark active" aria-current="page">Hasil Quiz</li>
  </ol>
  <h4 class="font-weight-bolder mb-0">Hasil Quiz</h4>
</nav>
@endsection

@section('konten')
<div class="container">
    <div class="col-md-12">
        <div class="card border-0">
          <div class="card-header bg-white d-flex align-items-center justify-content-between py-3">
            <div class="card-body px-2 py-3">
                <div class="table-responsive p-0">
                    <table class=table id="myTable" class="table table-striped" style="width:100%">
                        <thead>
                            <tr>
                                <th class="text-center" style="width: 5%;">No</th>
                                <th>Nama Siswa</th>
                                <th>Total Score</th>
                                <th>Judul Tugas</th>
                                <th>Tipe Tugas</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                                $no = 1;
                            @endphp
                            @foreach($userScores as $userScore)
                                <tr>
                                    <td>{{ $no++ }}</td>
                                    <td>{{ $userScore->user->name }}</td>
                                    <td>{{ $userScore->total_score }}</td>
                                    <td>{{ $userScore->assignment->judul_tugas }}</td>
                                    <td>{{ $userScore->assignment->tipe }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                  </div>
                </div>
            </div>
                </div>
            </div>
</div>
@endsection

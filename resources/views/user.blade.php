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
    <li class="breadcrumb-item text-sm text-dark active" aria-current="page">LearnClass</li>
  </ol>
  <h4 class="font-weight-bolder mb-0">Dashboard</h4>
</nav>
@endsection

@section('konten')
<div class="container-fluid py-4">
  <div class="row">
    <div class="col-md-6 mb-4">
        <div class="card">
            <div class="card-body p-3">
                <div class="row">
                    <div class="col-8">
                        <div class="numbers">
                            <p class="text-sm mb-0 text-capitalize font-weight-bold">Materi</p>
                            <h5 class="font-weight-bolder mb-0">
                                {{ $totalMateri }}
                            </h5>
                        </div>
                    </div>
                    <div class="col-4 text-end">
                        <div class="icon icon-shape bg-primary shadow text-center border-radius-md">
                            <i class="ni ni-money-coins text-lg opacity-10" aria-hidden="true"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-6 mb-4">
        <div class="card">
            <div class="card-body p-3">
                <div class="row">
                    <div class="col-8">
                        <div class="numbers">
                            <p class="text-sm mb-0 text-capitalize font-weight-bold">Tugas</p>
                            <h5 class="font-weight-bolder mb-0">
                              {{ $totalTugas }}
                            </h5>
                        </div>
                    </div>
                    <div class="col-4 text-end">
                        <div class="icon icon-shape bg-primary shadow text-center border-radius-md">
                            <i class="ni ni-world text-lg opacity-10" aria-hidden="true"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
  </div>
  <div class="row">
    <div class="col-12">
        <div class="card mt-3">
            <div class="card-body">
                <h5 class="card-title">Panduan Aplikasi</h5>
                <p class="card-text">
                  <ol>
                    <li><b>Buka menu kuis dari setiap materi yang tersedia.</b></li>
                    <ul>
                      <li>Mengerjakan 3 soal dari setiap materi.</li>
                      <li>Mengerjakan semua soal dengan benar.</li>
                      <li>Jika seluruh kuis sudah terjawab benar maka proyek akan terbuka.</li>
                    </ul>
                    <li><b>Buka Menu Proyek.</b></li>
                    <ul>
                      <li>Terdapat satu studi kasus yang harus diselesaikan.</li>
                      <li>Membuat jawaban berupa program dari studi kasus yang telah diberikan.</li>
                      <li>Setelah memasukkan jawaban bisa dilakukan jalankan program untuk mengetahui hasil dari jawaban tersebut.</li>
                      <li>Jika jawaban sudah benar maka bisa dilakukan submit jawaban.</li>
                    </ul>
                    <li><b>Untuk nilai kuis dan proyek bisa dilihat di halaman Dashboard.</b></li>
                    <li><b>Jika sudah menyelesaikan seluruh kuis dan proyek maka bisa keluar dari web.</b></li>
                  </ol>
                </p>
            </div>
        </div>
    </div>
  </div>
</div>
@endsection
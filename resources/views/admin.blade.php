@extends('layouts/aplikasi')

@section('navbrand')
<nav aria-label="breadcrumb">
  <ol class="breadcrumb bg-transparent mb-0 pb-0 pt-1 px-0 me-sm-6 me-5 mb-1">
    <li class="breadcrumb-item text-sm">
      <a class="opacity-5 text-dark" href="{{ route('admin') }}">LearnClass</a>
    </li>
  </ol>
  <h4 class="font-weight-bolder mb-0">Dashboard</h4>
</nav>
@endsection

@section('konten')
<div class="col-md-12">
  <div class="row">
    <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
      <div class="card">
        <div class="card-body p-3">
          <div class="row">
            <div class="col-8">
              <div class="numbers">
                <p class="text-sm mb-0 text-capitalize font-weight-bold">Total Kelas</p>
                <h5 class="font-weight-bolder mb-0">
                  {{ $totalKelas }}
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
    <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
      <div class="card">
        <div class="card-body p-3">
          <div class="row">
            <div class="col-8">
              <div class="numbers">
                <p class="text-sm mb-0 text-capitalize font-weight-bold">Total Siswa</p>
                <h5 class="font-weight-bolder mb-0">
                  {{ $totalSiswa }}
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
    <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
      <div class="card">
        <div class="card-body p-3">
          <div class="row">
            <div class="col-8">
              <div class="numbers">
                <p class="text-sm mb-0 text-capitalize font-weight-bold">Total Materi</p>
                <h5 class="font-weight-bolder mb-0">
                  {{ $totalMateri }}
                </h5>
              </div>
            </div>
            <div class="col-4 text-end">
              <div class="icon icon-shape bg-primary shadow text-center border-radius-md">
                <i class="ni ni-paper-diploma text-lg opacity-10" aria-hidden="true"></i>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="col-xl-3 col-sm-6">
      <div class="card">
        <div class="card-body p-3">
          <div class="row">
            <div class="col-8">
              <div class="numbers">
                <p class="text-sm mb-0 text-capitalize font-weight-bold">Total Tugas</p>
                <h5 class="font-weight-bolder mb-0">
                  {{ $totalhasil }}
                </h5>
              </div>
            </div>
            <div class="col-4 text-end">
              <div class="icon icon-shape bg-primary shadow text-center border-radius-md">
                <i class="ni ni-cart text-lg opacity-10" aria-hidden="true"></i>
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
                    <li><b>Buka menu kelas.</b></li>
                    <ul>
                      <li>Terdapat tabel yang menunjukkan informasi tentang kelas.</li>
                      <li>Terdapat 3 fungsi yaitu Tambah, Ubah, dan Hapus data kelas.</li>
                    </ul>
                    <li><b>Buka menu siswa.</b></li>
                    <ul>
                      <li>Terdapat tabel yang menunjukkan informasi tentang siswa.</li>
                      <li>Terdapat 3 fungsi yaitu Tambah, Ubah, dan Hapus data siswa.</li>
                    </ul>
                    <li><b>Buka menu materi.</b></li>
                    <ul>
                      <li>Terdapat tabel yang menunjukkan informasi tentang materi.</li>
                      <li>Terdapat 4 fungsi yaitu Tambah, Ubah, Hapus, dan Preview data dari materi.</li>
                    </ul>
                    <li><b>Buka menu penugasan.</b></li>
                    <ul>
                      <li>Terdapat tabel yang menunjukkan informasi tentang soal.</li>
                      <li>Terdapat 3 fungsi yaitu Tambah, Ubah, Hapus data dari soal.</li>
                      <li>Guru juga dapat memilih tipe soal essay ataupun pilihan ganda.</li>
                    </ul>
                    <li><b>Buka menu hasil pembelajaran.</b></li>
                    <ul>
                      <li>Terdapat tabel yang menunjukkan informasi tentang nilai, materi, dan nama siswa.</li>
                    </ul>
                  </ol>
                </p>                    
            </div>
        </div>
    </div>
  </div>
</div>
@endsection
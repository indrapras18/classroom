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
    <li class="breadcrumb-item text-sm text-dark active" aria-current="page">Materi</li>
  </ol>
  <h4 class="font-weight-bolder mb-0">Materi</h4>
</nav>
@endsection

@section('konten')
<div class="col-md-12">
  <div class="card border-0">
    <div class="card-header bg-white d-flex align-items-center justify-content-between pb-0">
      <h5 class="mb-0">Edit Materi</h5>
    </div>
    <div class="card-body bg-white">
      <form method="POST" action="/updateMateri/{{ $data->id }}" class="d-flex flex-column">
        @csrf
        <div class="form-group">
          <label class="form-label" for="inputAddress2">Judul Materi</label>
          <input class="form-control" name="nama_materi" value="{{ $data->nama_materi }}" type="text" placeholder="Judul Materi" required>
        </div>
        <div class="form-group">
          <label class="form-label" for="inputAddress2">Refrensi</label>
          <input class="form-control" name="link" value="{{ $data->link }}" type="text" placeholder="Refrensi" required>
        </div>
        <div class="form-group">
          <label for="editor1">Konten</label>
          <textarea name="content" id="editor1" rows="10" cols="80" required>{{ $data->content }}</textarea>
        </div>
        <div class="form-group d-flex align-items-center justify-content-end mt-3">
          <div class="w-50 d-flex align-items-center justify-content-between gap-3">
            <div class="w-100">
              <a href="/materi" class="btn btn-warning w-100 mb-0">Kembali</a>
            </div>
            <div class="w-100">
              <button class="btn btn-primary w-100 mb-0" type="submit">Simpan</button>
            </div>
          </div>
        </div>
      </form>
    </div>
  </div>
</div>
@endsection

@push('js')
  <script>
    CKEDITOR.replace('editor1');
  </script>
@endpush
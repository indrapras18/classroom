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
    <div class="card-header bg-white d-flex align-items-center justify-content-between py-3">
      <form method="POST" action="/updateMateri/{{ $data->id }}" class="row g-3 px-3">
        @csrf
        <div class="col-12">
          <label class="form-label" for="inputAddress2">Judul Materi</label>
          <input class="form-control" name="nama_materi" value="{{ $data->nama_materi }}" type="text" placeholder="Judul Materi" required>
        </div>
        <div class="col-12">
          <label class="form-label" for="inputAddress2">Refrensi</label>
          <input class="form-control" name="link" value="{{ $data->link }}" type="text" placeholder="Refrensi" required>
        </div>
        <div class="form-group">
            <label for="editor1">Content</label>
            <textarea name="content" id="editor1" rows="10" cols="80" required>{{ $data->content }}</textarea>
        </div>
        <div class="col-12 mt-5 d-flex justify-content-between">
          <button class="btn btn-primary w-50 me-2" type="submit">Simpan</button>
          <a href="/materi" class="w-50"><button class="btn btn-danger w-100" type="button">Kembali</button></a>
      </div>
    </form>
    </div>
  </div>
</div>

@push('js')
  <script>
    CKEDITOR.replace('editor1');
  </script>
@endpush
@endsection
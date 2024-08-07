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
    <li class="breadcrumb-item text-sm text-dark active" aria-current="page">Tugas</li>
  </ol>
  <h4 class="font-weight-bolder mb-0">Tugas</h4>
</nav>
@endsection

@section('konten')
<form method="POST" action="/submitTugas" class="row g-3 px-3">
    @csrf
    <div class="col-12">
        <label class="form-label" for="inputAddress2">Judul Tugas</label>
        <input class="form-control" name="judul_tugas" id="inputAddress2" type="text" placeholder="Judul Tugas">
    </div>
    <div class="col-12">
        <label class="form-label" for="selectTugas">Pilih Tipe</label>
        <select class="form-select" id="selectTugas" name="tipe">
            <option selected>Buka Untuk Memilih</option>
            <option value="pilihan">Pilihan Ganda</option>
            <option value="essay">Essay</option>
        </select>
    </div>
    <div class="form-group col-12">
        <label for="editor1">Deskripsi tugas</label>
        <textarea name="deskripsi_tugas" id="editor1" rows="10" cols="80" placeholder="Deskripsi Tugas"></textarea>
    </div>
    <button type="submit" class="btn btn-primary float-end">Simpan</button>
</form>
@push('js')
<script>
  CKEDITOR.replace('editor1');
</script>
@endpush
@endsection
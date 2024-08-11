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
<div class="col-md-12">
  <div class="card border-0">
    <div class="card-header bg-white d-flex align-items-center justify-content-between py-3">
      <form action="/updatePilihan/{{ $data->id }}" method="POST" class="row g-3 px-3" >
        @csrf
        <div class="form-group">
          <label for="editor1">Content</label>
          <textarea name="soal" id="editor1" rows="10" cols="80" placeholder="Soal" required>{{ $data->soal }}</textarea>
          <div id="editor1-error" style="color: red; display: none;"></div>
        </div>
        <div class="col-12">
          <label class="form-label" for="inputAddress2">Score</label>
          <input class="form-control" name="score" value="{{ $data->score }}" id="inputAddress2" type="number" placeholder="Nilai" required>
        </div>
        <div class="col-12">
          <label class="form-label" for="inputAddress2">Kunci Jawaban</label>
          <input class="form-control" name="answer_key" value="{{ $data->answer_key }}" id="inputAddress2" type="role" placeholder="Kunci Jawaban" required>
        </div>
        <div class="col-12">
            <label class="form-label" for="inputAddress2">Dibuat</label>
            <input class="form-control" name="created_at" value="{{ $data->created_at }}" id="inputAddress2" type="text" placeholder="Refrensi" disabled>
        </div>
        <div class="col-12 mt-5">
          <div class="col-12 mt-5 d-flex justify-content-between">
            <button class="btn btn-primary w-50 me-2" type="submit">Simpan</button>
            <a href="/penugasan" class="w-50"><button class="btn btn-warning w-100" type="button">Kembali</button></a>
        </div>
        </div>
      </form>
    </div>
  </div>
</div>
@push('js')
  <script>
    CKEDITOR.replace('editor1');
    document.addEventListener("DOMContentLoaded", function() {
        var form = document.querySelector("form");
        var editor = CKEDITOR.instances.editor1;
        var errorDiv = document.getElementById("editor1-error");

        form.addEventListener("submit", function(event) {
            errorDiv.style.display = 'none';
            errorDiv.textContent = '';
            if (!editor.getData().trim()) {
                errorDiv.textContent = "Content is required.";
                errorDiv.style.display = 'block';
                event.preventDefault();
                document.querySelector("textarea[name='deskripsi_tugas']").value = editor.getData();
            }
        });
    });
  </script>
@endpush
@endsection

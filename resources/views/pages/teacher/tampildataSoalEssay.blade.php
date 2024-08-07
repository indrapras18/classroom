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
      <form action="/updateEssay/{{ $data->id }}" method="POST" class="row g-3 px-3">
        @csrf
        <div class="form-group">
          <label for="editor1">Content</label>
          <textarea name="deskripsi_tugas" id="editor1" rows="10" cols="80" placeholder="Deskripsi Tugas" required>{{ $data->soal }}</textarea>
          <div id="editor1-error" style="color: red; display: none;"></div>
        </div>
      
        @foreach($data->resultEssays as $essay)
          <div class="col-12 mt-4">
              <input type="hidden" name="essay_ids[]" value="{{ $essay->id }}">
              <div class="col-12">
                  <label class="form-label" for="jawaban_essay_{{ $essay->id }}">Jawaban Essay</label>
                  <textarea class="form-control" required name="jawaban_essay[]" id="jawaban_essay_{{ $essay->id }}" rows="3">{{ $essay->jawaban_essay }}</textarea>
              </div>
              <div class="col-12">
                  <label class="form-label" for="essay_score_{{ $essay->id }}">Score</label>
                  <input class="form-control" name="essay_score[]" value="{{ $essay->essay_score }}" id="essay_score_{{ $essay->id }}" type="number" placeholder="Nilai Essay" required>
              </div>
          </div>
        @endforeach
        <div class="col-12">
          <label class="form-label" for="inputAddress2">Dibuat</label>
          <input class="form-control" name="created_at" value="{{ $data->created_at }}" id="inputAddress2" type="text" placeholder="Refrensi" disabled>
      </div>
        <div class="col-12 mt-5">
            <div class="row">
                <div class="col-6">
                    <button class="btn btn-primary w-100" type="submit">Simpan</button>
                </div>
                <div class="col-6">
                    <a href="/penugasan" class="btn btn-danger w-100">Kembali</a>
                </div>
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

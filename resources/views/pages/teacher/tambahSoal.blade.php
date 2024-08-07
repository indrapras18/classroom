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
      <form method="POST" action="/uploadSoal" class="row g-3 px-3">
        @csrf
        <input type="hidden" name="id_assignment" value="{{ $assignment->id }}">
        <div class="form-group">
            <label for="editor1">Soal</label>
            <textarea name="soal" id="editor1" rows="10" cols="80"></textarea>
        </div>
        <div class="col-md-6">
            <label for="inputAnswerKey" class="form-label">Kunci Jawaban</label>
            <input type="text" name="answer_key" class="form-control" id="inputAnswerKey">
        </div>
        <div class="col-md-6">
            <label for="inputScore" class="form-label">Skor</label>
            <input type="number" name="score" class="form-control" id="inputScore">
        </div>
        <div class="col-12">
            <label for="inputOptions" class="form-label">Opsi Jawaban</label>
        </div>
        <div class="container">
            @foreach (['A', 'B', 'C', 'D'] as $option)
            <div class="row mb-3 align-items-center">
                <div class="col-md-2">
                    <label for="inputOption{{ $option }}" class="form-label">Jawaban {{ $option }}</label>
                </div>
                <div class="col-md-10">
                    <input type="text" class="form-control" name="answers[{{ $loop->index }}][option_text]" placeholder="Jawaban">
                    <input type="hidden" name="answers[{{ $loop->index }}][option_alphabet]" value="{{ $option }}">
                </div>
            </div>
            @endforeach
        </div>
        <div class="row">
          <div class="col-6">
              <a href="/penugasan">
                  <button class="btn btn-danger w-100" type="button">Kembali</button>
              </a>
          </div>
          <div class="col-6">
              <button class="btn btn-primary w-100" type="submit">Simpan</button>
          </div>
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

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
      <form method="POST" action="{{ url('/updatePilihan/' . $data->id) }}" class="row g-3 px-3">
        @csrf
        <div class="col-12">
          <label for="editor1">Soal</label>
          <textarea name="soal" id="editor1" rows="10" cols="80">{{ old('soal', $data->soal) }}</textarea>
        </div>
        
        <div class="col-md-6">
          <label for="inputAnswerKey" class="form-label">Kunci Jawaban</label>
          <input type="text" name="answer_key" value="{{ old('answer_key', $data->answer_key) }}" class="form-control" id="inputAnswerKey">
        </div>

        <div class="col-md-6">
          <label for="inputScore" class="form-label">Skor</label>
          <input type="number" name="score" value="{{ old('score', $data->score) }}" class="form-control" id="inputScore">
        </div>
        
        <div class="col-12">
          <label for="inputOptions" class="form-label">Opsi Jawaban</label>
          <div class="row">
              @foreach ($answers as $key => $answer)
              <div class="col-md-6 mb-3">
                  <label for="inputOption{{ $answer->option_alphabet }}" class="form-label">Jawaban {{ $answer->option_alphabet }}</label>
                  <input type="text" class="form-control" name="answers[{{ $key }}][option_text]" value="{{ old('answers.' . $key . '.option_text', $answer->option_text) }}" placeholder="Jawaban">
                  <input type="hidden" name="answers[{{ $key }}][option_alphabet]" value="{{ $answer->option_alphabet }}">
              </div>
              @endforeach
          </div>
      </div>      

        <div class="col-12 mt-5 d-flex justify-content-between">
          <button class="btn btn-primary w-50 me-2" type="submit">Simpan</button>
          <a href="/penugasan" class="w-50"><button class="btn btn-warning w-100" type="button">Kembali</button></a>
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

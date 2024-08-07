@extends('layouts/aplikasi')

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
<form action="{{ route('saveAnswer') }}" method="post">
    @csrf
    <div class="container mt-2">
        <input type="hidden" name="id_assignments" value="{{ $assignmentId }}">
        @forelse ($questions as $question)
        <div class="card mb-1">
            <div class="card-body">
                <p class="card-text">{!! $question->soal !!}</p>
                <div class="mb-3">
                    <label for="answer_{{ $question->id }}" class="form-label">Jawaban</label>
                    <textarea class="form-control" name="answers[{{ $question->id }}]" id="answer_{{ $question->id }}" rows="3"></textarea>
                </div>
            </div>
        </div>
        @empty
        <p>Tidak ada soal essay yang ditemukan.</p>
        @endforelse
        <button type="submit" class="btn btn-primary float-end">Simpan</button>
    </div>
</form>
@endsection

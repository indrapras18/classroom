@extends('layouts/aplikasi')

@section('navbrand')
<nav aria-label="breadcrumb">
  <ol class="breadcrumb bg-light">
    <li class="breadcrumb-item"><a href="{{ auth()->user()->role == 'Guru' ? route('admin') : route('user') }}">LearnClass</a></li>
    <li class="breadcrumb-item active" aria-current="page">Essay Assignment</li>
  </ol>
  <h4 class="font-weight-bold">Essay</h4>
</nav>
@endsection

@section('konten')
<div class="container mt-4">
    @if($questions->isEmpty())
        <p>Tidak ada soal essay yang ditemukan.</p>
    @else
        <form action="{{ route('saveAnswer') }}" method="post">
            @csrf
            <input type="hidden" name="id_assignments" value="{{ $assignmentId }}">
            <input type="hidden" name="currentPage" value="{{ $currentPage }}">

            @foreach ($questions as $question)
                <div class="card mb-3">
                    <div class="card-body">
                        <h5 class="card-title">Pertanyaan {{ $currentQuestionNumber }}</h5>
                        <p class="card-text">{!! $question->soal !!}</p>
                        @php
                            $savedAnswer = \App\Models\Results::where('id_user', Auth::id())
                                           ->where('id_question', $question->id)
                                           ->first();
                            $answerText = old('answers.' . $question->id, $savedAnswer ? $savedAnswer->answer_text : '');
                        @endphp
                        <textarea class="form-control" name="answers[{{ $question->id }}]" id="answer_{{ $question->id }}" rows="3" required>{{ $answerText }}</textarea>
                    </div>
                </div>
                @php
                    $currentQuestionNumber++;
                @endphp
            @endforeach

            <div class="d-flex justify-content-between">
                @if ($currentPage > 1)
                    <button type="submit" name="action" value="previous" class="btn btn-primary">Kembali</button>
                @endif
                @if ($currentPage < $totalPages)
                    <button type="submit" name="action" value="next" class="btn btn-primary">Lanjut</button>
                @endif
                @if ($currentPage == $totalPages)
                    <button type="submit" name="action" value="finish" class="btn btn-primary">Simpan Jawaban</button>
                @endif
            </div>
        </form>
    @endif
</div>
@endsection

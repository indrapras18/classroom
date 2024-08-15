@extends('layouts/aplikasi')

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
    @if($questions->isEmpty())
        <p>Tidak ada soal essay yang ditemukan.</p>
    @else
        <div class="card">
            <div class="card-body">
                <form action="{{ route('saveAnswer') }}" method="post">
                    @csrf
                    <input type="hidden" name="id_assignments" value="{{ $assignmentId }}">
                    <input type="hidden" name="currentPage" value="{{ $currentPage }}">
        
                    @foreach ($questions as $question)
                        <div>
                            <h5 class="card-title">Pertanyaan {{ $currentQuestionNumber }}</h5>
                            <p class="card-text">{!! $question->soal !!}</p>
                            @php
                                $savedAnswer = \App\Models\Results::where('id_user', Auth::id())
                                                ->where('id_question', $question->id)
                                                ->first();
                                $answerText = old('answers.' . $question->id, $savedAnswer ? $savedAnswer->answer_text : '');
                            @endphp
                            <textarea class="form-control" name="answers[{{ $question->id }}]" id="answer_{{ $question->id }}" rows="3" placeholder="Tulis jawaban disini.." required>{{ $answerText }}</textarea>
                        </div>
                        @php
                            $currentQuestionNumber++;
                        @endphp
                    @endforeach
        
                    <div class="d-flex justify-content-end mt-3 mb-0">
                        {{-- @if ($currentPage > 1)
                            <button type="submit" name="action" value="previous" class="btn btn-primary">Kembali</button>
                        @endif --}}
                        @if($currentPage < $totalPages)
                            <button type="submit" name="action" value="next" class="btn btn-primary mb-0">Selanjutnya</button>
                        @elseif($currentPage == $totalPages)
                            <button type="submit" name="action" value="finish" class="btn btn-primary mb-0">Selesai</button>
                        @endif
                    </div>
                </form>
            </div>
        </div>

        {{-- <form action="{{ route('saveAnswer') }}" method="post">
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
        </form> --}}
    @endif
</div>
@endsection

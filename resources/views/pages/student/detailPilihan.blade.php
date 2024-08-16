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
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">
                <div class="card-header bg-info text-white">
                    {{ $assignment->judul_tugas }}
                </div>
                <div class="card-body">
                    @if(session('status'))
                        <div class="row">
                            <div class="col-12">
                                <div class="alert alert-success" role="alert">
                                    {{ session('status') }}
                                </div>
                            </div>
                        </div>
                    @endif

                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul class="mb-0">
                                @foreach ($errors->all() as $error)
                                    <li class="text-white">{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form id="quizForm" method="POST" action="{{ route('submit') }}">
                        @csrf
                        <input type="hidden" name="id_assignments" value="{{ $assignment->id }}">
                        <input type="hidden" name="currentPage" value="{{ $page }}">
                        <input type="hidden" name="action" value="">

                        @if ($soal)
                            <div class="d-flex flex-column">
                                {{-- Question --}}
                                <div>{!! $soal->soal !!}</div>

                                {{-- Answers --}}
                                <div class="answers">
                                    @foreach ($soal->answers as $answer)
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" required name="answers[{{ $soal->id }}]" id="answer_{{ $answer->id }}" value="{{ $answer->id }}"
                                            @if(isset($savedAnswers[$soal->id]) && $savedAnswers[$soal->id] == $answer->option_text) checked @endif>
                                        <label class="form-check-label" for="answer_{{ $answer->id }}">
                                            {{ $answer->option_alphabet }}. {{ $answer->option_text }}
                                        </label>
                                    </div>
                                    @endforeach
                                    
                                    @if($errors->has('answers.' . $soal->id))
                                        <span class="text-danger" role="alert">
                                            <strong>{{ $errors->first('answers.' . $soal->id) }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                        @else
                            <div class="alert alert-warning">
                                Pertanyaan tidak ditemukan.
                            </div>
                        @endif

                        <div class="row justify-content-center mb-0 mt-3">
                            <div class="col-md-6">
                                @if($page > 1)
                                    <button type="submit" class="btn btn-secondary w-100 mb-0" onclick="event.preventDefault(); document.querySelector('input[name=action]').value='previous'; document.getElementById('quizForm').submit();">
                                        Kembali
                                    </button>
                                @endif
                            </div>
                            <div class="col-md-6 text-right">
                                @if($page < $totalQuestions)
                                    <button type="submit" class="btn btn-primary w-100 mb-0" onclick="event.preventDefault(); document.querySelector('input[name=action]').value='next'; document.getElementById('quizForm').submit();">
                                        Selanjutnya
                                    </button>
                                @else
                                    <button type="submit" class="btn btn-success w-100 mb-0">
                                        Selesai
                                    </button>
                                @endif
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const form = document.getElementById('quizForm');
        form.addEventListener('submit', function (e) {
            const radios = document.querySelectorAll('input[type="radio"]:checked');

            if (radios.length === 0) {
                e.preventDefault();
                alert('Anda harus memilih salah satu jawaban sebelum lanjut.');
            }
        });
    });
</script>
@endsection

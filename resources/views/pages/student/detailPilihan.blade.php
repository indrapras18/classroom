@extends('layouts/aplikasi')

@section('navbrand')
<nav aria-label="breadcrumb">
    <ol class="breadcrumb bg-light">
        <li class="breadcrumb-item"><a href="{{ auth()->user()->role == 'Guru' ? route('admin') : route('user') }}">LearnClass</a></li>
        <li class="breadcrumb-item active" aria-current="page">Pilihan Ganda Assignment</li>
    </ol>
    <h4 class="font-weight-bold">Pilihan Ganda</h4>
</nav>
@endsection


@section('konten')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header" style="background-color: rgb(179, 170, 170); color:white;">
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
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
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
                            <div class="card mb-3">
                                <div class="card-header">{!! $soal->soal !!}</div>
                                <div class="card-body">
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

                        <div class="form-group row mb-0">
                            <div class="col-md-6">
                                @if($page > 1)
                                    <button type="submit" class="btn btn-secondary" onclick="event.preventDefault(); document.querySelector('input[name=action]').value='previous'; document.getElementById('quizForm').submit();">
                                        Kembali
                                    </button>
                                @endif
                            </div>
                            <div class="col-md-6 text-right">
                                @if($page < $totalQuestions)
                                    <button type="submit" class="btn btn-primary" onclick="event.preventDefault(); document.querySelector('input[name=action]').value='next'; document.getElementById('quizForm').submit();">
                                        Lanjut
                                    </button>
                                @else
                                    <button type="submit" class="btn btn-success">
                                        Submit
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

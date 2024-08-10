@extends('layouts/aplikasi')

@section('navbrand')
<nav aria-label="breadcrumb">
    <ol class="breadcrumb bg-light">
        <li class="breadcrumb-item"><a href="{{ auth()->user()->role == 'Guru' ? route('admin') : route('user') }}">LearnClass</a></li>
        <li class="breadcrumb-item active" aria-current="page">Essay Assignment</li>
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

                    <form method="POST" action="{{ route('submit') }}">
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
                                            <input class="form-check-input" type="radio" name="answers[{{ $soal->id }}]" id="answer_{{ $answer->id }}" value="{{ $answer->id }}"
                                                @if(session('selectedAnswers') && isset(session('selectedAnswers')[$soal->id]) && session('selectedAnswers')[$soal->id] == $answer->id) checked @endif>
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
                        @endif

                        <div class="form-group row mb-0">
                            <div class="col-md-6">
                                @if($page > 1)
                                    <button type="submit" class="btn btn-secondary" onclick="event.preventDefault(); this.closest('form').action.value='previous'; this.closest('form').submit();">
                                        Kembali
                                    </button>
                                @endif
                            </div>
                            <div class="col-md-6 text-right">
                                @if($page < $totalQuestions)
                                    <button type="submit" class="btn btn-primary" onclick="event.preventDefault(); this.closest('form').action.value='next'; this.closest('form').submit();">
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
@endsection


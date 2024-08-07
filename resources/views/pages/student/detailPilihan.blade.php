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

                    <form method="POST" action="/submit">
                        @csrf
                        <input type="hidden" name="id_assignments" value="{{ $assignment->id }}">

                        @foreach ($soal as $question_id => $answers)
                            <div class="card mb-3">
                                <div class="card-header">{!! $answers[0]->soal !!}</div>
                                <div class="card-body">
                                    @foreach ($answers as $answer)
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="answers[{{ $question_id }}]" id="answer_{{ $answer->answer_id }}" value="{{ $answer->answer_id }}" @if(old("answers.$question_id") == $answer->answer_id) checked @endif>
                                            <label class="form-check-label" for="answer_{{ $answer->answer_id }}">
                                                {{ $answer->option_alphabet }}. {{ $answer->option_text }}
                                            </label>
                                        </div>
                                    @endforeach

                                    @if($errors->has("answers.$question_id"))
                                        <span class="text-danger" role="alert">
                                            <strong>{{ $errors->first("answers.$question_id") }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                        @endforeach

                        <div class="form-group row mb-0">
                            <div class="col-md-6">
                                <button type="submit" class="btn btn-primary">
                                    Submit
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

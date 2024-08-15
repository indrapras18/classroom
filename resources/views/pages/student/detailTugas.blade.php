@extends('layouts/aplikasi')

@section('navbrand')
<nav aria-label="breadcrumb">
  <ol class="breadcrumb bg-transparent mb-0 pb-0 pt-1 px-0 me-sm-6 me-5 mb-1">
    <li class="breadcrumb-item text-sm">
      <a class="opacity-5 text-dark" href="{{ auth()->user()->role == 'Guru' ? route('admin') : route('user') }}">LearnClass</a>
    </li>
    <li class="breadcrumb-item text-sm text-dark active" aria-current="page">Hasil Belajar</li>
  </ol>
  <h4 class="font-weight-bolder mb-0">Hasil Belajar</h4>
</nav>
@endsection

@section('konten')
<div class="col-md-12">
  <div class="card border-0">
    <div class="card-header bg-white d-flex align-items-center justify-content-between pb-0">
      <h5 class="mb-0">{{ $assignment->judul_tugas }}</h5>
    </div>
    <div class="card-body px-2 py-3">
      <div class="table-responsive p-0">
        @if($assignment->tipe == 'pilihan')
          <table id="myTable" class="table table-striped" style="width:100%">
            <thead>
              <tr>
                <th class="text-center w-5">No</th>
                <th class="w-auto">Soal</th>
                <th class="w-20 text-center">Kunci Jawaban</th>
                <th class="w-auto text-center">Jawaban Siswa</th>
                <th class="w-20 text-center">Status</th>
                <th class="w-20 text-center">Nilai</th>
              </tr>
            </thead>
            <tbody>
              @php
                $list_answer = [];
              @endphp
              @foreach($assignment->questions as $key => $question)
                <tr>
                  <th class="text-center">{{ $key + 1 }}</th>
                  <th>{{ $question->soal }}</th>
                  <th class="text-center">{{ $question->answer_key }}</th>
                  <th class="text-center">
                    @foreach($question->answers as $answer)
                      @if($answer->option_text == $userAnswers[$question->id]->answer_text)
                        {{-- Push To Array --}}
                        @php
                          array_push($list_answer, $answer->option_alphabet);
                        @endphp
                        <span>{{ $answer->option_alphabet }}</span>
                      @endif
                    @endforeach
                  </th>
                  <th class="text-center">
                    {{ $list_answer[$key] == $question->answer_key ? 'Benar' : 'Salah' }}
                  </th>
                  <th class="text-center">
                    {{ $list_answer[$key] == $question->answer_key ? $question->score : 0 }}
                  </th>
                </tr>
              @endforeach
            </tbody>
          </table>
        @else
          <table id="myTable" class="table table-striped" style="width:100%">
            <thead>
              <tr>
                <th class="text-center w-5">No</th>
                <th class="w-auto">Soal</th>
                <th class="w-auto">Jawaban Siswa</th>
              </tr>
            </thead>
            <tbody>
              @php
                $list_answer = [];
              @endphp
              @foreach($assignment->questions as $key => $question)
                <tr>
                  <th class="text-center">{{ $key + 1 }}</th>
                  <th>{{ $question->soal }}</th>
                  <th class="text-start">
                    @foreach($question->results as $answer)
                      @php
                        array_push($list_answer, $answer->answer_text);
                      @endphp
                    @endforeach
                    <span>{{ $list_answer[$key] }}</span>
                  </th>
                </tr>
              @endforeach
            </tbody>
          </table>
        @endif
      </div>

      <div class="d-flex align-items-center justify-content-end mt-3">
        <div class="w-30 d-flex align-items-center justify-content-between gap-3">
          <div class="w-100">
            <a href="{{ route('hasilPembelajaran') }}" class="btn btn-warning w-100 mb-0">Kembali</a>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection

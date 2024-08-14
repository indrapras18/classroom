@extends('layouts/aplikasi')

@section('konten')
<div class="col-md-12">
  <div class="card border-0">
    <div class="card-header bg-white d-flex align-items-center justify-content-between pb-0">
      <h5 class="mb-0">{{ $assignment->judul_tugas }}</h5>
    </div>
    <div class="card-body px-2 py-3">
      <div class="table-responsive p-0">
        <table class="table table-striped">
          <thead>
            <tr>
              <th class="text-center w-5">No</th>
              <th class="w-auto">Soal</th>
              <th class="w-auto">Jawaban User</th>
            </tr>
          </thead>
          <tbody>
            @foreach($assignment->questions as $key => $question)
              <tr>
                <td class="text-center">{{ $key + 1 }}</td>
                <td>{{ $question->soal }}</td>
                <td>{{ $userAnswers[$question->id]->answer_text ?? '-' }}</td>
              </tr>
            @endforeach
          </tbody>
        </table>
      </div>
    </div>
  </div>
</div>
@endsection

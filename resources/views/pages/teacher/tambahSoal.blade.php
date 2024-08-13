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
    <li class="breadcrumb-item text-sm text-dark active" aria-current="page">Penugasan</li>
  </ol>
  <h4 class="font-weight-bolder mb-0">Penugasan</h4>
</nav>
@endsection

@section('konten')
<div class="col-md-12">
  <div class="card border-0">
    <div class="card-header bg-white d-flex align-items-center justify-content-between pb-0">
      <h5 class="mb-0">Tambah Soal - Pilihan Ganda</h5>
    </div>
    <div class="card-body bg-white">
      <form method="POST" action="/uploadSoal" class="d-flex flex-column">
        @csrf
        <input type="hidden" name="id_assignment" value="{{ $assignment->id }}">
        
        <div class="row">
          <div class="col-12">
            <div class="form-group">
              <label for="editor1">Pertanyaan</label>
              <textarea name="soal" id="editor1" rows="10" cols="80" placeholder="Pertanyaan"></textarea>
            </div>
          </div>
          
          <div class="col-md-6">
            <div class="form-group">
              <label for="inputAnswerKey" class="form-label">Kunci Jawaban</label>
              <input type="text" name="answer_key" class="form-control" id="inputAnswerKey" placeholder="Kunci Jawaban">
            </div>
          </div>
  
          <div class="col-md-6">
            <div class="form-group">
              <label for="inputScore" class="form-label">Skor</label>
              <input type="number" name="score" class="form-control" id="inputScore" placeholder="Skor">
            </div>
          </div>
          
          <div class="col-12">
            <label for="inputOptions" class="form-label">Opsi Jawaban</label>
            <div class="row">
              @foreach (['A', 'B', 'C', 'D'] as $option)
                <div class="col-md-6">
                  <div class="form-group">
                    <label for="inputOption{{ $option }}" class="form-label">Jawaban {{ $option }}</label>
                    <input type="text" class="form-control" name="answers[{{ $loop->index }}][option_text]" placeholder="Jawaban {{ $option }}">
                    <input type="hidden" name="answers[{{ $loop->index }}][option_alphabet]" value="{{ $option }}">
                  </div>
                </div>
              @endforeach
            </div>
          </div>
  
          <div class="col-md-12">
            <div class="d-flex align-items-center justify-content-end mt-3">
              <div class="w-50 d-flex align-items-center justify-content-between gap-3">
                <div class="w-100">
                  <a href="{{ route('detailTugasPilihan', $assignment->id) }}" class="btn btn-warning w-100 mb-0">Kembali</a>
                </div>
                <div class="w-100">
                  <button class="btn btn-primary w-100 mb-0" type="submit">Submit</button>
                </div>
              </div>
            </div>
          </div>
        </div>
      </form>
    </div>
  </div>
</div>
@endsection

@push('js')
<script>
    ClassicEditor
      .create( document.querySelector( '#editor1' ) )
      .catch( error => {
          console.error( error );
      } );
</script>
@endpush

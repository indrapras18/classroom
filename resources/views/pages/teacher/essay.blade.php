@extends('layouts/aplikasi')

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
      <h5 class="mb-0">Tambah Soal - Essay</h5>
    </div>
    <div class="card-body bg-white">
      <form action="/uploadEssay" method="post" class="d-flex flex-column">
        @csrf
        <input type="hidden" name="id_assignment" value="{{ $assignment->id }}">

        <div class="form-group">
          <label for="editor1" class="form-label">Pertanyaan</label>
          <div>
            <textarea name="soal" id="editor1" rows="15" class="form-control"></textarea>
          </div>
        </div>

        <div class="form-group">
          <label for="editor1" class="form-label">Opsi Jawaban</label>

          {{-- List Option --}}
          <div id="input-fields">
            <div class="form-group row">
              <div class="col-md-6">
                <input type="text" name="inputs[0][jawaban_essay]" placeholder="Jawaban" class="form-control">
              </div>
              <div class="col-md-4">
                <input type="text" name="inputs[0][essay_score]" placeholder="Poin" class="form-control">
              </div>
              <div class="col-md-2">
                <button type="button" name="add" id="add" class="btn btn-success w-100 mb-0">Tambah Opsi</button>
              </div>
            </div>
          </div>
        </div>

        {{-- <div class="col-12 mt-5 d-flex justify-content-between">
          <button class="btn btn-primary w-50 me-2" type="submit">Simpan</button>
          <a href="{{ url('detailTugasPilihan/' . $assignment->id) }}" class="w-50">
            <button class="btn btn-warning w-100" type="button">Kembali</button>
          </a>
        </div> --}}
        <div class="col-md-12">
          <div class="d-flex align-items-center justify-content-end mt-3">
            <div class="w-50 d-flex align-items-center justify-content-between gap-3">
              <div class="w-100">
                <a href="{{ route('detailTugasEssay', $assignment->id) }}" class="btn btn-warning w-100 mb-0">Kembali</a>
              </div>
              <div class="w-100">
                <button class="btn btn-primary w-100 mb-0" type="submit">Submit</button>
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

  var i = 0;
  $('#add').click(function() {
    ++i;
    $('#input-fields').append(
      `<div class="form-group row">
          <div class="col-md-6">
            <input type="text" name="inputs[${i}][jawaban_essay]" placeholder="Jawaban" class="form-control"/>
          </div>
          <div class="col-md-4">
            <input type="text" name="inputs[${i}][essay_score]" placeholder="Poin" class="form-control"/>
          </div>
          <div class="col-md-2">
            <button type="button" class="btn btn-danger remove-field w-100 mb-0">Hapus</button>
          </div>
      </div>`
    );
  });

  $(document).on('click', '.remove-field', function() {
      $(this).closest('.form-group').remove();
  });
</script>
@endpush

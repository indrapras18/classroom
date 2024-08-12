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

{{-- @section('konten')
<div class="col-md-12">
  <div class="card border-0">
    <div class="card-header bg-white d-flex align-items-center justify-content-between py-3">
      <form action="/uploadEssay" method="post" class="row g-3 px-3">
        @csrf
        <input type="hidden" name="id_assignment" value="{{ $assignment->id }}">
        <div class="form-group row">
            <div class="form-group col-12">
                <label for="editor1">Soal</label>
                <textarea name="soal" id="editor1" rows="10" cols="80" class="form-control"></textarea>
            </div>
        </div>
        <div id="input-fields">
            <div class="form-group row">
                <div class="col">
                    <input type="text" name="inputs[0][jawaban_essay]" placeholder="Jawaban" class="form-control">
                </div>
                <div class="col">
                    <input type="text" name="inputs[0][essay_score]" placeholder="Poin" class="form-control">
                </div>
                <div class="col">
                    <button type="button" name="add" id="add" class="btn btn-success">Tambah Opsi Jawaban</button>
                </div>
            </div>
        </div>
        <div class="col-12 mt-5 d-flex justify-content-between">
          <button class="btn btn-primary w-50 me-2" type="submit">Simpan</button>
          <a href="/penugasan" class="w-50"><button class="btn btn-warning w-100" type="button">Kembali</button></a>
      </div>
    </form>
    
    </div>
  </div>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.ckeditor.com/4.16.2/standard/ckeditor.js"></script>
<script>
    var i = 0;
    $('#add').click(function() {
        ++i;
        $('#input-fields').append(
            `<div class="form-group row">
                <div class="col">
                    <input type="text" name="inputs[${i}][jawaban_essay]" placeholder="Jawaban" class="form-control"/>
                </div>
                <div class="col">
                    <input type="text" name="inputs[${i}][essay_score]" placeholder="Poin" class="form-control"/>
                </div>
                <div class="col">
                    <button type="button" class="btn btn-danger remove-field">Hapus</button>
                </div>
            </div>`);
    });

    $(document).on('click', '.remove-field', function() {
        $(this).closest('.form-group').remove();
    });

    CKEDITOR.replace('editor1');
</script>
@endsection --}}


@section('konten')
<div class="col-md-12">
  <div class="card border-0">
    <div class="card-header bg-white d-flex align-items-center justify-content-between pb-0">
      <h5 class="mb-0">Tambah Soal</h5>
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

        <div class="d-flex align-items-center justify-content-end mt-3">
          <div class="w-50 d-flex align-items-center justify-content-between gap-3">
            <div class="w-100">
              <a href="/penugasan" class="btn btn-warning w-100 mb-0">Kembali</a>
            </div>
            <div class="w-100">
              <button class="btn btn-primary w-100 mb-0" type="submit">Submit</button>
            </div>
          </div>
        </div>
      </form>
    </div>
  </div>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.ckeditor.com/4.16.2/standard/ckeditor.js"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.ckeditor.com/ckeditor5/34.1.0/classic/ckeditor.js"></script>

<script>
    var i = 0;
    $('#add').click(function() {
        ++i;
        $('#input-fields').append(
            `<div class="form-group row">
                <div class="col">
                    <input type="text" name="inputs[${i}][jawaban_essay]" placeholder="Jawaban" class="form-control"/>
                </div>
                <div class="col">
                    <input type="text" name="inputs[${i}][essay_score]" placeholder="Poin" class="form-control"/>
                </div>
                <div class="col">
                    <button type="button" class="btn btn-danger remove-field">Hapus</button>
                </div>
            </div>`);
    });

    $(document).on('click', '.remove-field', function() {
        $(this).closest('.form-group').remove();
    });

    CKEDITOR.replace('editor1');
</script>
@endsection

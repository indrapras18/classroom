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
      <h5 class="mb-0">Tambah Tugas</h5>
    </div>
    <div class="card-body bg-white">
      <form method="POST" action="/submitTugas" class="d-flex flex-column">
        @csrf
        <div class="form-group">
          <label for="">Judul Tugas</label>
          <div class="input-group">
            <input
              type="text"
              name="judul_tugas"
              class="form-control @if($errors->has('judul_tugas')) is-invalid @endif"
              placeholder="Judul Tugas"
              value="{{ old('judul_tugas') }}"
              required
            >
            @if ($errors->has('judul_tugas'))
              <span class="invalid-feedback" role="alert">
                <strong>{{ $errors->first('judul_tugas') }}</strong>
              </span>
            @endif
          </div>
        </div>

        <div class="form-group">
          <label class="form-label" for="selectTugas">Jenis Tugas</label>
          <select
            class="form-select @error('tipe') is-invalid @enderror"
            id="selectTugas"
            name="tipe"
            required
          >
            <option value="" disabled selected>Pilih Jenis Tugas</option>
            <option value="pilihan" {{ old('tipe') == 'pilihan' ? 'selected' : '' }}>Pilihan Ganda</option>
            <option value="essay" {{ old('tipe') == 'essay' ? 'selected' : '' }}>Essay</option>
          </select>
          @error('tipe')
            <div class="invalid-feedback">
                <strong>{{ $message }}</strong>
            </div>
          @enderror
        </div>

        <div class="form-group">
          <label for="editor1" class="form-label">Deskripsi Tugas</label>
          <textarea
            name="deskripsi_tugas"
            id="editor1"
            rows="10"
            cols="80"
            class="form-control @error('deskripsi_tugas') is-invalid @enderror"
          >{{ old('deskripsi_tugas') }}</textarea>
          @error('deskripsi_tugas')
            <span class="invalid-feedback" role="alert">
              <strong>{{ $message }}</strong>
            </span>
          @enderror
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
@endsection

@push('js')
<script>
    ClassicEditor
      .create( document.querySelector( '#editor1' ), )
      .catch( error => {
          console.error( error );
      } );
</script>
@endpush
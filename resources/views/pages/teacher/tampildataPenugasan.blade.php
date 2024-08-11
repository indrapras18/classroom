@extends('layouts/aplikasi')

@section('navbrand')
<nav aria-label="breadcrumb">
  <ol class="breadcrumb bg-transparent mb-0 pb-0 pt-1 px-0 me-sm-6 me-5 mb-1">
    <li class="breadcrumb-item text-sm">
      <a class="opacity-5 text-dark" href="{{ auth()->user()->role == 'Guru' ? route('admin') : route('user') }}">LearnClass</a>
    </li>
    <li class="breadcrumb-item text-sm text-dark active" aria-current="page">Tugas</li>
  </ol>
  <h4 class="font-weight-bolder mb-0">Edit Tugas</h4>
</nav>
@endsection

@section('konten')
<div class="col-md-12">
  <div class="card border-0">
    <div class="card-header bg-white d-flex align-items-center justify-content-between py-3">
      <form method="POST" action="/updatePenugasan/{{ $items->id }}" class="row g-3 px-3">
        @csrf
        <div>
          <label for="">Judul Tugas</label>
          <div class="input-group mb-3">
            <input
              type="text"
              name="judul_tugas"
              class="form-control @if($errors->has('judul_tugas')) is-invalid @endif"
              placeholder="Judul Tugas"
              value="{{ $items->judul_tugas }}"
              {{-- required --}}
            >
            @if ($errors->has('judul_tugas'))
              <span class="invalid-feedback" role="alert">
                <strong>{{ $errors->first('judul_tugas') }}</strong>
              </span>
            @endif
          </div>
        </div>
        <div class="col-12 mb-3">
          <label class="form-label" for="selectTugas">Pilih Tipe</label>
          <select
              class="form-select @error('tipe') is-invalid @enderror"
              id="selectTugas"
              name="tipe"
              disabled
          >
              <option>{{ $items->tipe }}</option>
          </select>
          @error('tipe')
              <div class="invalid-feedback">
                  <strong>{{ $message }}</strong>
              </div>
          @enderror
        </div>

        <div class="form-group">
          <label for="editor1">Content</label>
          <textarea name="deskripsi_tugas" id="editor1" rows="10" cols="80" placeholder="Deskripsi Tugas" required>{{ $items->deskripsi_tugas }}</textarea>
          <div id="editor1-error" style="color: red; display: none;"></div> <!-- Error message container -->
      </div>
        <div class="col-12 mt-5 d-flex justify-content-between">
          <button class="btn btn-primary w-50 me-2" type="submit">Simpan</button>
          <a href="/penugasan" class="w-50"><button class="btn btn-warning w-100" type="button">Kembali</button></a>
        </div>
    </form>
    </div>
  </div>
</div>

@push('js')
  <script>
    CKEDITOR.replace('editor1');
    document.addEventListener("DOMContentLoaded", function() {
        var form = document.querySelector("form");
        var editor = CKEDITOR.instances.editor1;
        var errorDiv = document.getElementById("editor1-error");

        form.addEventListener("submit", function(event) {
            errorDiv.style.display = 'none';
            errorDiv.textContent = '';
            if (!editor.getData().trim()) {
                errorDiv.textContent = "Content is required.";
                errorDiv.style.display = 'block';
                event.preventDefault();
                document.querySelector("textarea[name='deskripsi_tugas']").value = editor.getData();
            }
        });
    });

  </script>
@endpush
@endsection
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
    <li class="breadcrumb-item text-sm text-dark active" aria-current="page">Tugas</li>
  </ol>
  <h4 class="font-weight-bolder mb-0">Tugas</h4>
</nav>
@endsection

@section('konten')
<div class="col-md-12">
    <div class="card border-0">
      <div class="card-body px-2 py-3">
        <div class="table-responsive p-0">
          <table id="myTable" class="table table-striped" style="width:100%">
            <thead>
                <tr>
                    <th class="text-center" style="width: 5%;">No</th>
                    <th>Nama Materi</th>
                    <th>Tipe</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
              @php
                  $no = 1;
              @endphp
              @foreach ($materiWithScore as $item)
                <tr>
                    <td class="text-center">{{ $no++ }}</td>
                    <td><span class="badge badge-sm bg-gradient-success">{{ $item->judul_tugas }}</span></td>
                    <td>{{ $item->tipe }}</td>
                    <td class="align-middle text-center">
                      @if ($item->completed)
                          <button type="button" class="btn btn-info" disabled><i class="fa-solid fa-eye"></i></button>
                      @else
                          <a href="/detailPilihan/{{ $item->id }}">
                              <button type="button" class="btn btn-info"><i class="fa-solid fa-eye"></i></button>
                          </a>
                      @endif
                    </td>
                </tr>
              @endforeach
            </tbody>
          </table>
        </div>
    </div>
@endsection



@section('table')
<nav aria-label="breadcrumb">
  <ol class="breadcrumb bg-transparent mb-0 pb-0 pt-1 px-0 me-sm-6 me-5">
    <li class="breadcrumb-item text-sm"><a class="opacity-5 text-dark" href="javascript:;">Pages</a></li>
    <li class="breadcrumb-item text-sm text-dark active" aria-current="page">Quiz</li>
  </ol>
  <h6 class="font-weight-bolder mb-0">Daftar Essay</h6><br>
</nav>
<div class="col-md-12">
  <div class="card border-0">
    <div class="card-body px-2 py-3">
      <div class="table-responsive p-0">
        <table id="table" class="table table-striped" style="width:100%">
          <thead>
              <tr>
                  <th class="text-center" style="width: 5%;">No</th>
                  <th>Nama Materi</th>
                  <th>Tipe</th>
                  <th>Aksi</th>
              </tr>
          </thead>
          <tbody>
            @php
                $no = 1;
            @endphp
            @foreach ($materiWithoutScore as $item)
              <tr>
                  <td class="text-center">{{ $no++ }}</td>
                  <td><span class="badge badge-sm bg-gradient-success">{{ $item->judul_tugas }}</span></td>
                  <td>{{ $item->tipe }}</td>
                  <td class="align-middle text-center">
                    @if ($item->completed)
                      <button type="button" class="btn btn-info" disabled><i class="fa-solid fa-eye"></i></button>
                    @else
                      <a href="/detailEssay/{{ $item->id }}">
                        <button type="button" class="btn btn-info"><i class="fa-solid fa-eye"></i></button>
                      </a>
                    @endif
                  </td>
              </tr>
            @endforeach
          </tbody>
        </table>
      </div>
    </div>
  </div>
</div>
@push('js')
<script>
  $(document).ready(function() {
    $('#table').DataTable({
        "columnDefs": [
          // { "className": "dt-center", "targets": "_all" }
        ]
    });
  });
</script>
@endpush
@endsection
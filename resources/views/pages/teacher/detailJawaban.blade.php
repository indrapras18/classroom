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
    <li class="breadcrumb-item text-sm text-dark active" aria-current="page">Hasil Quiz</li>
  </ol>
  <h4 class="font-weight-bolder mb-0">Hasil Quiz</h4>
</nav>
@endsection


@section('konten')
<div class="container">
    <div class="col-md-12">
        <div class="card border-0">
            <div class="card-header bg-white py-3">
                <h4>Jawaban User</h4>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class=table id="myTable" class="table table-striped" style="width:100%">
                        <thead>
                            <tr>
                                <th class="text-center w-1">No</th>
                                <th>Pertanyaan</th>
                                <th>Jawaban</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($jawaban as $index => $item)
                            <tr>
                                <td class="text-center">{{ $index + 1 }}</td>
                                <td>{!! $item->soal !!}</td>
                                <td>{!! $item->answer_text !!}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

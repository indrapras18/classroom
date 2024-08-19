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
    <li class="breadcrumb-item text-sm text-dark active" aria-current="page">Materi</li>
  </ol>
  <h4 class="font-weight-bolder mb-0">Materi</h4>
</nav>
@endsection

@section('konten')
<div class="col-md-12">
    <div class="card border-0">
        <div class="card-header bg-white d-flex align-items-center justify-content-between pb-0">
            <h5 class="mb-0">Detail Materi - {{ $data->nama_materi }}</h5>
        </div>
        <div class="card-body">
            <div class="content">
                <div id="materi-content">
                    {!! $data->content !!}
                </div>
                <div id="video-container" class="text-center mt-3" style="display: none;">
                </div>
            </div>

            {{-- Button --}}
            <div id="pagination-controls" class="mt-3 d-flex justify-content-center">
                <div class="col-md-6 d-flex justify-content-center justify-content-between gap-3">
                    <button type="button" onclick="prevPage()" id="prev-btn" class="btn btn-primary mb-0 w-100">Sebelumnya</button>
                    <button type="button" onclick="nextPage()" id="next-btn" class="btn btn-primary mb-0 w-100">Selanjutnya</button>
                </div>
            </div>
        </div>
    </div>

    <div class="mt-3">
        <a href="/materiStudent" class="float-end btn btn-warning w-50">Kembali</a>
    </div>

</div>
@endsection

@push('js')
<script>
    let videoUrl = "{{ $data->link }}";
    const nextMateriId = @json($next ? $next->id : null);
    const previousMateriId = @json($previous ? $previous->id : null);

    document.addEventListener('DOMContentLoaded', function() {
        renderVideo(videoUrl);
        document.getElementById('video-container').style.display = 'block';
    });

    function prevPage() {
        if (previousMateriId) {
            window.location.href = `{{ url('detailMateriStudent') }}/${previousMateriId}`;
        }
    }

    function nextPage() {
        if (nextMateriId) {
            window.location.href = `{{ url('detailMateriStudent') }}/${nextMateriId}`;
        }
    }

    function renderVideo(url) {
        const pattern = /^(?:https?:\/\/)?(?:www\.)?(?:youtube\.com\/(?:[^\/\n\s]+\/\S+\/|(?:v|e(?:mbed)?)\/|\S*?[?&]v=)|youtu\.be\/)([a-zA-Z0-9_-]{11})/;
        const matches = url.match(pattern);
        const videoId = matches ? matches[1] : null;
        const embedUrl = videoId ? `https://www.youtube.com/embed/${videoId}` : null;

        if (embedUrl) {
            document.getElementById('video-container').innerHTML = `<iframe width="600px;" height="400px;" src="${embedUrl}" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>`;
        } else {
            document.getElementById('video-container').innerHTML = `<p>${url}</p>`;
        }
    }
</script>
@endpush

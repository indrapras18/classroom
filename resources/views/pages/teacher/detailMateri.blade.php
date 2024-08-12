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
            {{-- Old --}}
            {{-- <div id="materi-content">
                {!! $data->content !!}
                <div id="video-container"></div>
            </div> --}}

            {{-- New --}}
            <div class="content">
                <div class="material-content">
                    {!! $data->content !!}
                </div>
                <div class="material-video text-center">
                    <iframe width="600" height="400" src="{{ $data->link }}"></iframe>
                </div>
            </div>

            {{-- Button --}}
            {{-- <div id="pagination-controls" class="mt-3 d-flex justify-content-center">
                <div class="col-md-6 d-flex justify-content-center justify-content-between gap-3">
                    <button type="button" onclick="prevPage()" id="prev-btn" class="btn btn-primary mb-0 w-100">Sebelumnya</button>
                    <button type="button" onclick="nextPage()" id="next-btn" class="btn btn-primary mb-0 w-100">Selanjutnya</button>
                </div>
            </div> --}}

            <div class="d-flex justify-content-end mt-3">
                <div class="col-md-4 d-flex justify-content-between gap-3">
                  <div class="w-100">
                    <a href="/materi" class="btn btn-warning w-100 mb-0">Kembali</a>
                  </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('js')
<script>
    let currentPage = {{ $page }};
    const itemsPerPage = 5;
    let contentSections;
    let videoUrl = "{{ $data->link }}";
    const nextMateriId = @json($next ? $next->id : null);

    document.addEventListener('DOMContentLoaded', function() {
        contentSections = document.getElementById('materi-content').innerHTML.split(/(<\/p>)/).filter(Boolean);
        
        contentSections = contentSections.map((section, index) => {
            if (index % 2 === 1) {
                return contentSections[index - 1] + section;
            }
            return section;
        }).filter((_, index) => index % 2 === 0);

        renderPage(currentPage);

        renderVideo(videoUrl);
    });

    function renderPage(page) {
        const start = (page - 1) * itemsPerPage;
        const end = start + itemsPerPage;
        const visibleContent = contentSections.slice(start, end).join('');
        document.getElementById('materi-content').innerHTML = visibleContent;
        updateButtons();

        renderVideo(videoUrl);
    }

    function prevPage() {
        if (currentPage > 1) {
            currentPage--;
            renderPage(currentPage);
            updateURL();
        }
    }

    function nextPage() {
        if (currentPage * itemsPerPage < contentSections.length) {
            currentPage++;
            renderPage(currentPage);
            updateURL();
        } else if (nextMateriId) {
            window.location.href = `{{ url('detailMateri') }}/${nextMateriId}`;
        }
    }

    function updateURL() {
        const currentUrl = `{{ url('detailMateri/' . $data->id) }}/${currentPage}`;
        window.history.pushState({ path: currentUrl }, '', currentUrl);
        console.log("Navigating to: " + currentUrl);
    }

    function updateButtons() {
        document.getElementById('prev-btn').disabled = currentPage === 1;
        document.getElementById('next-btn').disabled = currentPage * itemsPerPage >= contentSections.length && !nextMateriId;
    }

    function renderVideo(url) {
        console.log("Video URL:", url);
        const pattern = /^(?:https?:\/\/)?(?:www\.)?(?:youtube\.com\/(?:[^\/\n\s]+\/\S+\/|(?:v|e(?:mbed)?)\/|\S*?[?&]v=)|youtu\.be\/)([a-zA-Z0-9_-]{11})/;
        const matches = url.match(pattern);
        const videoId = matches ? matches[1] : null;
        const embedUrl = videoId ? `https://www.youtube.com/embed/${videoId}` : null;

        if (embedUrl) {
            console.log("Embed URL:", embedUrl);
            document.getElementById('video-container').innerHTML = `<iframe width="100%" height="315" src="${embedUrl}" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>`;
        } else {
            document.getElementById('video-container').innerHTML = `<p>${url}</p>`;
        }
    }
</script>
@endpush

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
<h6 style="margin-left: 20px;">Detail Materi</h6>
<div class="card">
    <div class="card-body">
        <div id="materi-content">
            {!! $data->content !!}
            <div id="video-container"></div>
        </div>
    </div>
</div>

<div id="pagination-controls" style="text-align: center; margin-top: 10px;">
    <button type="button" onclick="prevPage()" id="prev-btn" class="btn btn-primary">Sebelum</button>
    <button type="button" onclick="nextPage()" id="next-btn" class="btn btn-primary">Lanjut</button>
</div>

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
@endsection

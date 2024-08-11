<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link rel="apple-touch-icon" sizes="76x76" href="../assets/img/apple-icon.png">
  <link rel="icon" type="image/png" href="../assets/img/favicon.png">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
  <link href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css" rel="stylesheet">
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  <title>LearnClass</title>

  @include('components.css')
  @yield('css')

  <style>
    #myTable td {
      /* padding: 0;
      line-height: 10px;
      vertical-align: middle;
      display: flex;
      justify-content: center;
      align-items: center; */
    }
  
    #myTable td button {
      /* margin: 0 5px; */
    }
  </style>
</head>

<body class="g-sidenav-show  bg-gray-100">
  <aside class="sidenav navbar navbar-vertical navbar-expand-xs border-0 border-radius-xl my-3 fixed-start ms-3 " id="sidenav-main" style="background-color: white;">
    <div class="sidenav-header">
      <i class="fas fa-times p-3 cursor-pointer text-secondary opacity-5 position-absolute end-0 top-0 d-none d-xl-none" aria-hidden="true" id="iconSidenav"></i>
      <a class="navbar-brand m-0" href="#">
        <img src="{{ asset('../assets/images/logo-ct-dark.png') }}" class="navbar-brand-img h-100" alt="main_logo">
        <span class="ms-1 font-weight-bold">LearnClass</span>
      </a>
    </div>
    <hr class="horizontal dark mt-0">
    <div>
      {{-- @yield('nav') --}}
      @include('components.sidebar')
    </div>
  </aside>

  <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg">
    @include('components.navbar')

    {{-- Content --}}
    <div class="container-fluid py-4">
      <div class="row">
        {{-- <div class="col-12">
          <div class="card mb-4">
            <div class="card-header pb-0">
             @yield('modal')
            </div>
            <div class="card-body px-0 pt-0 pb-2">
              <div class="table-responsive p-0">

                @yield('konten')
                
              </div>
            </div>
            <div class="card-body px-0 pt-0 pb-2">
            </div>
          </div>
        </div> --}}

        @yield('konten')
      </div>
      @yield('table')
    </div>
  </main>

  @include('components.js')

  @stack('js')

  @if(session('success'))
    <script>
        Swal.fire({
            icon: 'success',
            title: 'Berhasil',
            text: '{{ session('success') }}',
            showConfirmButton: false,
            timer: 1500
        });
    </script>
@endif
</body>
</html>


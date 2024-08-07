<!-- Navbar -->
<nav class="navbar navbar-main navbar-expand-lg px-0 mx-4 shadow-none border-radius-xl" id="navbarBlur" navbar-scroll="true">
  <div class="container-fluid pt-3 pb-0 px-0">

    @yield('navbrand')

    <div class="collapse navbar-collapse mt-sm-0 mt-2 me-md-0 me-sm-4" id="navbar">
      <div class="ms-md-auto pe-md-3 d-flex align-items-center">
        <div class="input-group">
          {{-- <span class="input-group-text text-body"><i class="fas fa-search" aria-hidden="true"></i></span> --}}
          {{-- <input type="text" class="form-control" placeholder="Type here..."> --}}
        </div>
      </div>
      <ul class="navbar-nav  justify-content-end">
        <li class="nav-item d-flex align-items-center">
          <a class="btn btn-outline-primary btn-sm mb-0 me-3" href="/logout">Logout</a>
        </li>
      </ul>
    </div>
  </div>
</nav>
<!-- End Navbar -->
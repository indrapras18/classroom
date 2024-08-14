<!-- Navbar -->

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
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
      <ul class="navbar-nav justify-content-end">
        <li class="nav-item dropdown d-flex align-items-center">
          <a class="nav-link dropdown-toggle-split" href="#" id="settingsDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            <i class="fa-solid fa-cog fa-lg"></i>
          </a>
          <ul class="dropdown-menu dropdown-menu-end p-3 shadow-sm" aria-labelledby="settingsDropdown">
            <li class="text-center">
              <strong>{{ Auth::user()->name }}</strong>
            </li>
            <li><hr class="dropdown-divider"></li>
            <li class="text-center">
              <a class="btn btn-outline-primary btn-sm" href="{{ route('logout') }}" 
                 onclick="event.preventDefault(); 
                 document.getElementById('logout-form').submit();">
                Logout
              </a>
              <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                @csrf
              </form>
            </li>
          </ul>
        </li>
      </ul>
    </div>
  </div>
</nav>

<!-- End Navbar -->



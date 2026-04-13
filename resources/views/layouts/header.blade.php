  <div class="header">
      <div class="main-header">

          <div class="header-left">
              <a href="{{ route('home') }}" class="logo">
                  <img src="{{ asset('assets/img/logo.svg') }}" alt="Orange Mali RH">
              </a>
              <a href="{{ route('home') }}" class="dark-logo">
                  <img src="{{ asset('assets/img/logo-white.svg') }}" alt="Orange Mali RH">
              </a>
          </div>

          <a id="mobile_btn" class="mobile_btn" href="#sidebar">
              <span class="bar-icon">
                  <span></span>
                  <span></span>
                  <span></span>
              </span>
          </a>

          <div class="header-user">
              <div class="nav user-menu nav-list">

                  <div class="me-auto d-flex align-items-center" id="header-search">
                      <div class="input-group input-group-flat d-inline-flex me-1">
                          <span class="input-icon-addon">
                              <i class="ti ti-search"></i>
                          </span>
                          <input type="text" class="form-control" placeholder="Rechercher un employé">
                      </div>
                  </div>

                  <div class="d-flex align-items-center">
                      <div class="me-1">
                          <a href="#" class="btn btn-menubar btnFullscreen">
                              <i class="ti ti-maximize"></i>
                          </a>
                      </div>
                      <div class="dropdown profile-dropdown">
                          <a href="javascript:void(0);" class="dropdown-toggle d-flex align-items-center"
                              data-bs-toggle="dropdown">
                              <span class="avatar avatar-sm online">
                                  <img src="{{ asset('assets/img/profiles/1.jpg') }}" alt="Img"
                                      class="img-fluid rounded-circle">
                              </span>
                          </a>
                          <div class="dropdown-menu shadow-none">
                              <div class="card mb-0">
                                  <div class="card-header">
                                      <div class="d-flex align-items-center">
                                          <span class="avatar avatar-lg me-2 avatar-rounded">
                                              <img src="{{ asset('assets/img/profiles/1.jpg') }}"
                                                  alt="img">
                                          </span>
                                          <div>
                                              <h5 class="mb-0">{{ Auth::user()->name }}</h5>
                                              <p class="mb-0 text-muted">RH - Gestion des employés et congés</p>
                                          </div>
                                      </div>
                                  </div>
                                  <div class="card-footer">
                                      <a class="dropdown-item d-inline-flex align-items-center p-0 py-2"
                                          href="{{ route('logout') }}"
                                          onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                          <i class="ti ti-logout me-2"></i>Déconnexion
                                      </a>
                                      <form id="logout-form" action="{{ route('logout') }}" method="POST"
                                          class="d-none">
                                          @csrf
                                      </form>
                                  </div>
                              </div>
                          </div>
                      </div>
                  </div>
              </div>
          </div>

          <!-- Mobile Menu -->
          <div class="dropdown mobile-user-menu">
              <a href="javascript:void(0);" class="nav-link dropdown-toggle" data-bs-toggle="dropdown"
                  aria-expanded="false"><i class="fa fa-ellipsis-v"></i></a>
              <div class="dropdown-menu dropdown-menu-end">
                  <a class="dropdown-item" href="{{ route('logout') }}"
                      onclick="event.preventDefault();
                        document.getElementById('logout-form').submit();">
                      Déconnexion
                  </a>
                  <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                      @csrf
                  </form>
              </div>
          </div>
          <!-- /Mobile Menu -->

      </div>

  </div>

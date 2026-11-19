<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Input Meja</title>



  <!-- SEO Optimization -->
  <meta name="description" content="UI Forms - Spark Admin Premium Bootstrap 5 Admin Dashboard Template">
  <meta name="author" content="Spark Admin Team">

  <!-- Favicon -->
  <link rel="icon" type="image/png" href="{{ asset('assets/images/favicon.ico') }}">



  <!-- Local Third-Party Libraries (100% Offline Compatible) -->
  <link rel="stylesheet" href="{{ asset('assets/libs/bootstrap/css/bootstrap.min.css') }}">
  <link rel="stylesheet" href="{{ asset('assets/libs/bootstrap-icons/bootstrap-icons.css') }}">
  <link rel="stylesheet" href="{{ asset('assets/libs/apexcharts/apexcharts.css') }}">
  <link rel="stylesheet" href="{{ asset('assets/libs/flatpickr/flatpickr.min.css') }}">



  <!-- Main Design System & Custom Stylesheet -->
  <link rel="stylesheet" href="{{ asset('assets/css/main.css') }}">
</head>

<body>
  <!-- ==========================================

         START: Sidebar Component

         Highly polished, dark-green navigation

         ========================================== -->

  <div class="sidebar-wrapper" id="sidebar">

    <!-- Brand Logo / Identity -->
    <a href="{{ route('meja.index') }}" class="sidebar-brand">
      <i class="bi bi-asterisk"></i>
      <span> Admin</span>
    </a>

    <!-- Navigation Menu -->
    <div class="flex-grow-1 overflow-y-auto">
      <!-- Group: Menu -->
      <div class="sidebar-menu-section">
        <div class="sidebar-menu-title">Menu</div>
        <ul class="sidebar-menu-list">
          <li class="sidebar-menu-item">
            <a href="{{ route('meja.index') }}" class="sidebar-menu-link" id="menu-overview" title="Overview">
              <i class="bi bi-grid-fill"></i>
              <span>Dashboard</span>
            </a>
          </li>
        </ul>
      </div>



      <!-- Group: Components -->

      <div class="sidebar-menu-section">
        <div class="sidebar-menu-title">Components</div>
        <ul class="sidebar-menu-list">
          <li class="sidebar-menu-item">
            <a href="{{ route('meja.index') }}" class="sidebar-menu-link" id="menu-basictables" title="Basic Tables">
              <i class="bi bi-table"></i>
              <span>Status Meja</span>
            </a>
          </li>

          <li class="sidebar-menu-item">
            <a href="{{ route('meja.create') }}" class="sidebar-menu-link active" id="menu-uiforms" title="Forms and Input">
              <i class="bi bi-input-cursor-text"></i>
              <span>Input Meja Baru</span>
            </a>
          </li>

        </ul>
      </div>
    </div>

    <!-- Sidebar Profile Card (Dynamic Footer) -->

    <div class="sidebar-profile">
      <img src="{{ asset('assets/images/avatar.png') }}" alt="Administrator" class="sidebar-profile-img"
        >
      <div class="sidebar-profile-info">
        <div class="sidebar-profile-name">Administrator</div>
        <div class="sidebar-profile-email">admin@email.com</div>
      </div>
    </div>
  </div>

  <!-- ==========================================

         END: Sidebar Component

         ========================================== -->





  <!-- ==========================================

         START: Main Content Area

         ========================================== -->
  <div class="main-wrapper">
    <!-- START: Top Navbar Component -->

    <header class="navbar-custom">
      <div class="navbar-left">

        <!-- Desktop sidebar toggle -->
        <button class="btn-desktop-toggle d-none d-xl-flex align-items-center justify-content-center me-3"
          id="desktop-sidebar-toggle" aria-label="Minimize Sidebar">
          <i class="bi bi-chevron-bar-left"></i>
        </button>

        <!-- Mobile sidebar toggle -->
        <button class="sidebar-toggle-btn me-2" id="sidebar-toggle" aria-label="Toggle Navigation">
          <i class="bi bi-list"></i>
        </button>



      <!-- Mid navbar: search pill -->
      <div class="navbar-search-wrapper">
        <input type="text" class="navbar-search-input" placeholder="Search anything in Spark..." id="main-search">
        <button class="navbar-search-btn" aria-label="Search">
          <i class="bi bi-search"></i>
        </button>
      </div>



      <!-- Right actions -->
      <div class="navbar-actions">
        <!-- Fullscreen Toggle -->
        <button class="navbar-action-btn me-1" aria-label="Toggle Fullscreen" id="btn-fullscreen">
          <i class="bi bi-arrows-fullscreen"></i>
        </button>
        <div class="dropdown">
          <button class="navbar-action-btn dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false" id="btn-notifications" data-bs-auto-close="outside">
            <i class="bi bi-bell"></i>
            <span class="navbar-action-badge"></span>
          </button>
          <div class="dropdown-menu dropdown-menu-end dropdown-menu-notification p-0" aria-labelledby="btn-notifications">
            <div class="notification-header">
              <h6 class="notification-title">Notifications</h6>
              <button class="btn-clear-all" type="button">Mark all read</button>
            </div>

            <div class="notification-list">
              <a href="#" class="notification-item">
                <div class="notification-icon bg-success text-white">
                  <i class="bi bi-wallet2"></i>
                </div>

                <div class="notification-content">
                  <p class="notification-text">New sale received: <strong>$150.00</strong></p>
                  <span class="notification-time">2 mins ago</span>
                </div>
                <span class="notification-unread-dot"></span>
              </a>

              <a href="#" class="notification-item">
                <div class="notification-icon bg-primary text-white">
                  <i class="bi bi-person-plus-fill"></i>
                </div>
                <div class="notification-content">
                  <p class="notification-text">New user registered: <strong>John Doe</strong></p>
                  <span class="notification-time">1 hour ago</span>
                </div>
                <span class="notification-unread-dot"></span>
              </a>
            </div>
            <a href="#" class="notification-footer">View All Notifications</a>
          </div>
        </div>



        <!-- Profile Dropdown -->

        <div class="dropdown ms-2">
          <button class="navbar-profile-btn dropdown-toggle" type="button" data-bs-toggle="dropdown"
            aria-expanded="false" id="profile-dropdown">
            <img src="{{ asset('assets/images/avatar.png') }}" alt="Profile Image" class="navbar-profile-img">
            <span class="navbar-profile-name d-none d-md-inline">Administrator</span>
            <i class="bi bi-chevron-down navbar-profile-caret"></i>
          </button>

          <ul class="dropdown-menu dropdown-menu-end dropdown-menu-profile" aria-labelledby="profile-dropdown">
            <li class="dropdown-header">Welcome !</li>
            <li><a class="dropdown-item" href="#"><i class="bi bi-person"></i> My Account</a></li>
            <li><a class="dropdown-item" href="#"><i class="bi bi-gear"></i> Settings</a></li>
            <li>

              <hr class="dropdown-divider">
            </li>
            <li><a class="dropdown-item text-danger" href="page-login.html"><i class="bi bi-box-arrow-right"></i>
                Logout</a></li>
          </ul>
        </div>
      </div>
    </header>

    <!-- END: Top Navbar Component -->



    <!-- START: Page Header Banner -->

    <div class="page-header">
      <div>
        <h1 class="page-title">Input Meja Baru</h1>
        <p class="page-subtitle">Buat meja baru untuk restoran mu</p>
      </div>

        <nav aria-label="breadcrumb">
        <ol class="breadcrumb mb-0">
          <li class="breadcrumb-item"><a href="{{ route('meja.index') }}" class="text-decoration-none text-muted-green">Home</a></li>
          <li class="breadcrumb-item text-muted-green">Components</li>
          <li class="breadcrumb-item active text-main" aria-current="page">Create Table</li>
        </ol>
        </nav>
    </div>

    <!-- END: Page Header Banner -->



    <!-- START: Form Component Row Grid Layout -->

    <form method="POST" class="row g-4 mb-4" action="{{ route('meja.store') }}">
      @csrf
      <input type="hidden" name="status" value="Available">
      @if ($errors->any())
      <div class="col-12"><div class="alert alert-danger"><ul class="mb-0">
      @foreach ($errors->all() as $error) <li>{{ $error }}</li> @endforeach
      </ul></div></div>
      @endif

      <!-- Column 1: Basic controls -->
      <div class="col-12 col-lg-6">
        <div class="card border-light shadow-sm p-4 h-100">
          <h5 class="card-title mb-4">Create Table</h5>

          <!-- Text input -->
          <div class="mb-3">
            <label for="nomor" class="form-label-custom">Nomor Meja</label>
            <input type="number"  min="1" step="1" class="form-control-custom" name="nomor" id="nomor" value="{{ old('nomor') }}" required placeholder="No. Meja -">
          </div>

          <!-- Email input -->
          <div class="mb-3">
            <label for="kapasitas" class="form-label-custom">Kapasitas Meja</label>
            <select class="btn-quick-action dropdown-toggle" name="kapasitas" id="kapasitas" required >
                <option value="">Pilih kapasitas</option>
                <option value="2" {{ old('kapasitas') == '2' ? 'selected' : '' }}>2 Orang</option>
                <option value="4" {{ old('kapasitas') == '4' ? 'selected' : '' }}>4 Orang</option>
                <option value="8" {{ old('kapasitas') == '8' ? 'selected' : '' }}>8 Orang</option>
            </select>
          </div>



          <!-- Password input -->

          <div class="mb-3">
            <label for="zonasi" class="form-label-custom">Zonasi</label>
            <select class="btn-quick-action dropdown-toggle" name="zonasi" id="zonasi" required>
                <option value="">Pilih Zonasi</option>
                <option value="Indoor" {{ old('zonasi') == 'Indoor' ? 'selected' : '' }}>Indoor</option>
                <option value="Outdoor" {{ old('zonasi') == 'Outdoor' ? 'selected' : '' }}>Outdoor</option>
                <option value="VIP" {{ old('zonasi') == 'VIP' ? 'selected' : '' }}>VIP</option>
            </select>
          </div>

          <!-- Create Button -->
          <div class="d-flex flex-wrap gap-2 mb-4 justify-content-end">
            <button type="submit"  class="btn-custom btn-custom-primary"> Create </button>
          </div>

        </div>
      </div>
    </form>
  </div>
  </div><!-- /.main-wrapper -->

  <!-- ==========================================

         END: Main Content Area

         ========================================== -->



  <!-- Local Third-Party Libraries Script dependencies -->
  <script src="{{ asset('assets/libs/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
  <script src="{{ asset('assets/libs/apexcharts/apexcharts.min.js') }}"></script>
  <script src="{{ asset('assets/libs/flatpickr/flatpickr.min.js') }}"></script>



  <!-- Local dashboard interactions controller -->
  <script src="{{ asset('assets/js/dashboard.js') }}"></script>
</body>
</html>
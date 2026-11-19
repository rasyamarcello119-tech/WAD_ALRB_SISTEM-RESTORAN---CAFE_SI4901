<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>STATUS MEJA</title>
  <!-- SEO Optimization -->
  <meta name="description" content="Basic Table - Spark Admin Premium Bootstrap 5 Admin Dashboard Template">
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
            <a href="{{ route('meja.index') }}" class="sidebar-menu-link active" id="menu-basictables" title="Basic Tables">
              <i class="bi bi-table"></i>
              <span>Status Meja</span>
            </a>
          </li>
          <li class="sidebar-menu-item">
            <a href="{{ route('meja.create') }}" class="sidebar-menu-link" id="menu-uiforms" title="Forms and Input">
              <i class="bi bi-input-cursor-text"></i>
              <span>Input meja baru</span>
            </a>
          </li>
        </ul>
      </div>
    </div>
    <!-- Sidebar Profile Card (Dynamic Footer) -->
    <div class="sidebar-profile">
      <img src="{{ asset('assets/images/avatar.png') }}" alt="Administrator" class="sidebar-profile-img">
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
        <!-- Desktop sidebar toggle (visible on large screens only) -->
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
          <button class="navbar-action-btn dropdown-toggle" type="button" data-bs-toggle="dropdown"
            aria-expanded="false" id="btn-notifications" data-bs-auto-close="outside">
            <i class="bi bi-bell"></i>
            <span class="navbar-action-badge"></span>
          </button>
          <div class="dropdown-menu dropdown-menu-end dropdown-menu-notification p-0"
            aria-labelledby="btn-notifications">
            <div class="notification-header">
              <h6 class="notification-title">Notifications</h6>
              <button class="btn-clear-all" type="button">Mark all read</button>
            </div>
            <div class="notification-list">
              <a href="#" class="notification-footer">View All Notifications</a>
            </div>
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
            <li><a class="dropdown-item" href="#"><i class="bi bi-lock"></i> Lock Screen</a></li>
            <li>
              <hr class="dropdown-divider">
            </li>
            <li><a class="dropdown-item text-danger" href="#"><i class="bi bi-box-arrow-right"></i>
                Logout</a></li>
          </ul>
        </div>
      </div>
    </header>
    <!-- END: Top Navbar Component -->
    <!-- START: Page Header Banner -->
    <div class="page-header">
      <div>
        <h1 class="page-title">Status Meja</h1>
        <p class="page-subtitle">List meja</p>
      </div>
      <nav aria-label="breadcrumb">
        <ol class="breadcrumb mb-0">
          <li class="breadcrumb-item"><a href="{{ route('meja.index') }}" class="text-decoration-none text-muted-green">Home</a></li>
          <li class="breadcrumb-item text-muted-green">Components</li>
          <li class="breadcrumb-item active text-main" aria-current="page">Status Meja</li>
        </ol>
      </nav>
    </div>
    <!-- END: Page Header Banner -->
    <!-- START: Basic Table Card Container -->
    <div class="table-card-custom">
      <!-- Header Controls -->
      <div class="table-header-control">
        <!-- Search bar -->
        <div class="table-search-box">
          <i class="bi bi-search table-search-icon"></i>
          <input type="text" class="table-search-input" placeholder="Cari meja...">
        </div>
        <!-- Action buttons / Filter options -->
        <div class="table-filter-group">
          <div class="dropdown">
            <button class="btn-table-action dropdown-toggle" type="button" id="dropdownFilterStatus"
              data-bs-toggle="dropdown" aria-expanded="false">
              <i class="bi bi-funnel"></i> Status Filter
            </button>
            <ul class="dropdown-menu" aria-labelledby="dropdownFilterStatus">
              <li><a class="dropdown-item" href="#">All Statuses</a></li>
              <li><a class="dropdown-item" href="#">Available</a></li>
              <li><a class="dropdown-item" href="#">Booked</a></li>
              <li><a class="dropdown-item" href="#">Occupied</a></li>
            </ul>
          </div>
          <button class="btn-table-action" type="button">
            <i class="bi bi-file-earmark-arrow-down"></i> Export
          </button>
        </div>
      </div>
      <!-- Responsive Table Wrapper -->
      <div class="table-responsive">
        <table class="table-custom">
          <thead>
            <tr>
              <th>Nomor Meja</th>
              <th>Kapasitas</th>
              <th>Zonasi</th>
              <th>Status</th>
              <th class="text-center">Actions</th>
            </tr>
          </thead>
          <tbody>
            @forelse ($meja as $row)
              <tr>
                <td class="table-id">{{ $row->nomor }}</td>
                <td class="table-capacity">{{ $row->kapasitas }}</td>
                <td>{{ $row->zonasi }}</td>
                <td>
                  <span class="badge-table {{ strtolower($row->status) }}">
                    {{ $row->status }}
                  </span>
                </td>
                <td>
                  <div class="d-flex justify-content-center gap-1">
                    <a href="{{ route('meja.edit', $row->id) }}" class="table-btn-action" title="Edit row">
                      <i class="bi bi-pencil"></i>
                    </a>
                    <form action="{{ route('meja.destroy', $row->id) }}" method="POST" class="d-inline"
                          onsubmit="return confirm('Apakah Anda yakin ingin menghapus meja nomor {{ $row->nomor }}?');">
                      @csrf
                      @method('DELETE')
                      <button type="submit" class="table-btn-action delete" title="Delete row" style="border:0; cursor:pointer;">
                        <i class="bi bi-trash"></i>
                      </button>
                    </form>
                  </div>
                </td>
              </tr>
            @empty
              <tr><td colspan="5" class="text-center">Belum ada data meja.</td></tr>
            @endforelse
          </tbody>
        </table>
      </div>
    </div>
    <!-- END: Basic Table Card Container -->
  </div>
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

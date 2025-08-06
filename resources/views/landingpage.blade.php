<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <meta name="Landing Page Nustech" content="width=device-width, initial-scale=1" />
  <title>Landing Page Nustech</title>
  <link rel="icon" type="image/png" href="assets/img/logonustech.png">

  <!-- Tailwind CSS -->
  <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" />
  <link href="https://fonts.googleapis.com/css2?family=Roboto+Slab:wght@400;600;700&display=swap" rel="stylesheet">

  <style>
    body {
      font-family: 'Quicksand', sans-serif;
      color: black;
      background-color: blue;
      margin: 0;
      padding: 0;
    }
    html, body {
      margin: 0;
      padding: 0;
      overflow: hidden;
      height: 100%;
      width: 100%;
    }
    #bgVideo {
      position: fixed;
      top: 0;
      left: 0;
      min-width: 100vw;
      min-height: 100vh;
      width: 100%;
      height: 100%;
      object-fit: cover;
      z-index: -1;
    }
    .gradient-text {
      background: linear-gradient(to right, rgb(209, 215, 231), rgb(134, 173, 229));
      -webkit-background-clip: text;
      -webkit-text-fill-color: transparent;
    }
    /* Navbar dropdown full background */
    .navbar-dropdown-bg {
      position: absolute;
      left: 0;
      top: 100%;
      width: 100vw;
      min-height: 220px;
      background: rgba(255,255,255,0.97);
      box-shadow: 0 8px 24px rgba(0,0,0,0.08);
      border-bottom: 1px solid #eee;
      display: none;
      z-index: 50;
      transition: all 0.2s;
    }
    .group:hover .navbar-dropdown-bg {
      display: flex;
    }
    .navbar-dropdown-content {
      width: 100vw; /* Full lebar layar */
      padding: 32px 48px; /* Jarak kiri-kanan */
      display: flex;
      gap: 48px;
      justify-content: flex-start;
      align-items: flex-start;
    }

    .navbar-dropdown-section {
      min-width: 180px;
    }
    .navbar-dropdown-section a {
      display: block;
      padding: 8px 0;
      color: #222;
      border-radius: 6px;
      transition: background 0.2s;
      text-decoration: none;
    }
    .navbar-dropdown-section a:hover {
      background: #fef3c7;
      color: #d97706;
    }
    .navbar-link {
      padding: 0.5rem 1rem;
      color: #222;
      font-weight: 500;
      transition: color 0.2s;
      text-decoration: none;
    }
    .navbar-link:hover {
      color: #d97706;
    }
    @media (max-width: 900px) {
      .navbar-dropdown-content {
        flex-direction: column;
        gap: 16px;
        padding: 24px 8px;
      }
      .navbar-dropdown-section {
        min-width: 120px;
      }
    }
  </style>
</head>
<body class="relative min-h-screen flex flex-col justify-center items-center px-4 text-gray-100 text-center">

  <!-- Background Video -->
  <video autoplay muted loop playsinline id="bgVideo">
    <source src="assets/video/videobackgroundweb.mp4" type="video/mp4" />
  </video>

  <div style="top: 40%; left: 13%;" class="absolute z-10 animate-slide-in-left text-black">
    <h1 class="text-4xl md:text-6xl font-bold gradient-text">
      WELCOME
    </h1>
  </div>

  <!-- Navbar -->
  <nav class="w-full bg-transparent py-4 fixed top-0 left-0 z-30 text-black">
    <ul class="w-full flex justify-start items-center space-x-0 pl-6 text-sm md:text-base font-medium relative text-black">

      <!-- Data Site -->
      <li class="relative group">
        <a href="#" class="navbar-link">Data Site</a>
        <div class="navbar-dropdown-bg">
          <div class="navbar-dropdown-content">
            <div class="navbar-dropdown-section">
              <a href="{{ url('tables') }}">Data Site</a>
              <a href="{{ route('datapass.index') }}">Manajemen Password</a>
              <a href="{{ route('laporanPM') }}">PM</a>
              <a href="{{ route('pmliberta') }}">PM Liberta 2025</a>
            </div>
          </div>
        </div>
      </li>

      <!-- Tiket -->
      <li class="relative group">
        <a href="#" class="navbar-link">Tiket</a>
        <div class="navbar-dropdown-bg">
          <div class="navbar-dropdown-content">
            <div class="navbar-dropdown-section">
              <a href="{{ route('tiket') }}" target="_blank">Open Tiket</a>
              <a href="{{ route('close.tiket') }}" target="_blank">Close Tiket</a>
              <a href="{{ route('dashboard') }}" target="_blank">Details</a>
            </div>
          </div>
        </div>
      </li>

      <!-- Log Perangkat -->
      <li class="relative group">
        <a href="#" class="navbar-link">Log Perangkat</a>
        <div class="navbar-dropdown-bg">
          <div class="navbar-dropdown-content">
            <div class="navbar-dropdown-section">
              <div class="font-bold mb-2 text-gray-800">Log Perangkat</div>
              <a href="{{ route('log_perangkat') }}" target="_blank">Pergantian Perangkat</a>
              <a href="{{ route('sparetracker') }}" target="_blank">Log Pergantian</a>
              <a href="{{ route('logtracker') }}" target="_blank">Spare Tracker</a>
            </div>
          </div>
        </div>
      </li>

      <!-- SLA -->
      <li class="relative group">
        <a href="#" class="navbar-link">SLA</a>
        <div class="navbar-dropdown-bg">
          <div class="navbar-dropdown-content">
            <div class="navbar-dropdown-section">
              <a href="{{ url('rekap-bmn') }}">BMN</a>
              <a href="{{ url('rekap-sl') }}">SL</a>
            </div>
          </div>
        </div>
      </li>

      <!-- Project -->
      <li>
        <a href="{{ route('newproject') }}" class="navbar-link" target="_blank">New Project</a>
      </li>

      <!-- To Do -->
      <li>
        <a href="{{ route('todolist.index') }}" class="navbar-link" target="_blank">To Do List</a>
      </li>

      <!-- Download -->
      <li>
        <a href="{{ route('file.index') }}" target="_blank" class="navbar-link">Download</a>
      </li>

      <!-- Optional Superadmin -->
      @auth
        @if (Auth::user()->role === 'superadmin')
          <li>
            <a href="{{ url('users') }}" class="navbar-link">Users</a>
          </li>
        @endif
      @endauth

    </ul>
  </nav>

  <!-- Footer -->
  <footer class="w-full absolute bottom-0 left-0 py-4 text-sm text-center fade-in" style="color: white; animation-delay: 0.5s;">
    &copy; <script>document.write(new Date().getFullYear())</script> Nustech Indonesia. All rights reserved.
  </footer>

  <script>
    function openInNamedTab(url, tabName) {
      window.open(url, tabName);
    }
  </script>

</body>
</html>

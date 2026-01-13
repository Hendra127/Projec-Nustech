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
      }
      
    html, body {
      margin: 0;
      padding: 0;
      overflow: hidden; /* cegah scroll */
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

    @keyframes fadeIn {
      from { opacity: 0; transform: translateY(20px); }
      to { opacity: 1; transform: translateY(0); }
    }

    .fade-in {
      animation: fadeIn 5s ease-out both;
    }

    @keyframes slideInLeft {
      from { opacity: 0; transform: translateX(-60px);}
      to   { opacity: 1; transform: translateX(0);}
    }

    @keyframes slideInRight {
      from { opacity: 0; transform: translateX(60px);}
      to   { opacity: 1; transform: translateX(0);}
    }

    .animate-slide-in-left {
      animation: slideInLeft 5s cubic-bezier(.4,2,.6,1) both;
    }

    .animate-slide-in-right {
      animation: slideInRight 3s cubic-bezier(.4,2,.6,1) both;
    }

    .group:hover .group-hover\:block {
      display: block;
    }

    body {
      background-color: blueviolet;
      margin: 0;
      padding: 0;
    }
    .gradient-text {
      background: linear-gradient(to right, rgb(209, 215, 231), rgb(134, 173, 229));
      -webkit-background-clip: text;
      -webkit-text-fill-color: transparent;
    }
  </style>
</head>

<body class="relative min-h-screen flex flex-col justify-center items-center px-4 text-gray-100 text-center">

  <!-- ✅ Background Video -->
      <video autoplay muted loop playsinline id="bgVideo">
      <source src="assets/video/videobackgroundweb.mp4" type="video/mp4" />
    </video>

    <div style="top: 40%; left: 13%;" class="absolute z-10 animate-slide-in-left text-white">
      <h1 class="text-4xl md:text-6xl font-bold gradient-text">
        WELCOME
      </h1>
    </div>
 <!-- NAVBAR -->
<nav id="mainNav" class="w-full fixed top-0 left-0 z-30 py-4 bg-transparent transition-all duration-300">
  <div
  class="max-w-5xl mx-auto px-8
         flex items-center justify-center space-x-6
         rounded-full py-3
         bg-gradient-to-r from-white/10 via-white/5 to-white/10
         backdrop-blur-xl">

      <button id="mobile-menu-button" class="md:hidden text-white focus:outline-none">
        <svg class="w-6 h-6" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
          <path stroke-linecap="round" stroke-linejoin="round" d="M4 6h16M4 12h16M4 18h16"/>
        </svg>
      </button>

      <!-- Menu Mobile -->
      <ul class="hidden md:flex items-center space-x-4 font-medium text-white">

        <!-- Data Site Dropdown -->
        <li class="relative group">
          <a href="#" class="px-4 py-2 transition hover:text-orange-500">Data Site</a>
          <div class="absolute top-full left-1/2 transform -translate-x-1/2 mt-2 w-52 bg-white/90 backdrop-blur-md rounded-xl shadow-lg opacity-0 scale-95 transition-all duration-300 group-hover:opacity-100 group-hover:scale-100 z-50">
            <a href="{{ url('tables') }}" class="dropdown-item">Data Site</a>
            <a href="{{ route('datapass.index') }}" class="dropdown-item">Manajemen Password</a>
            <a href="{{ route('laporanPM') }}" class="dropdown-item">PM</a>
            <a href="{{ route('pmliberta') }}" class="dropdown-item">PM Liberta 2025</a>
          </div>
        </li>

        <!-- Tiket Dropdown -->
        <li class="relative group">
          <a href="#" class="px-4 py-2 transition hover:text-orange-500">Tiket</a>
          <div class="absolute top-full left-1/2 transform -translate-x-1/2 mt-2 w-52 bg-white/90 backdrop-blur-md rounded-xl shadow-lg opacity-0 scale-95 transition-all duration-300 group-hover:opacity-100 group-hover:scale-100 z-50">
            <a href="{{ route('tiket') }}" class="dropdown-item" target="_blank">Open Tiket</a>
            <a href="{{ route('close.tiket') }}" class="dropdown-item" target="_blank">Close Tiket</a>
            <a href="{{ route('dashboard') }}" class="dropdown-item" target="_blank">Details</a>
          </div>
        </li>

        <!-- Log Perangkat Dropdown -->
        <li class="relative group">
          <a href="#" class="px-4 py-2 transition hover:text-orange-500">Log Perangkat</a>
          <div class="absolute top-full left-1/2 transform -translate-x-1/2 mt-2 w-52 bg-white/90 backdrop-blur-md rounded-xl shadow-lg opacity-0 scale-95 transition-all duration-300 group-hover:opacity-100 group-hover:scale-100 z-50">
            <a href="{{ route('log_perangkat') }}" class="dropdown-item" target="_blank">Pergantian Perangkat</a>
            <a href="{{ route('sparetracker') }}" class="dropdown-item" target="_blank">Log Pergantian</a>
            <a href="{{ route('logtracker') }}" class="dropdown-item" target="_blank">Spare Tracker</a>
          </div>
        </li>

        @php $role = Auth::check() ? Auth::user()->role : null; @endphp
        @if (in_array($role, ['admin', 'superadmin']))
        <!-- SLA Dropdown -->
        <li class="relative group">
          <a href="#" class="px-4 py-2 transition hover:text-orange-500">SLA</a>
          <div class="absolute top-full left-1/2 transform -translate-x-1/2 mt-2 w-52 bg-white/90 backdrop-blur-md rounded-xl shadow-lg opacity-0 scale-95 transition-all duration-300 group-hover:opacity-100 group-hover:scale-100 z-50">
            <a href="{{ url('rekap-bmn') }}" class="dropdown-item">BMN</a>
            <a href="{{ url('rekap-sl') }}" class="dropdown-item">SL</a>
          </div>
        </li>
        <li><a href="{{ route('jadwal.piket') }}" class="px-4 py-2 transition hover:text-orange-500" target="_blank">Jadwal Piket</a></li>
        @endif

        <!-- Project -->
        <li><a href="#" class="px-4 py-2 transition hover:text-orange-500" target="_blank">New Project</a></li>
        <li><a href="{{ route('todolist.index') }}" class="px-4 py-2 transition hover:text-orange-500" target="_blank">To Do List</a></li>
        <li><a href="{{ route('file.index') }}" class="px-4 py-2 transition hover:text-orange-500" target="_blank">Download</a></li>

        @auth
        @if (Auth::user()->role === 'superadmin')
        <li><a href="{{ url('users') }}" class="px-4 py-2 transition hover:text-orange-500">Users</a></li>
        @endif
        @endauth
      </ul>

    </div>
   <!-- Mobile Menu -->
  <div id="mobile-menu" class="md:hidden hidden bg-white text-black w-full absolute top-full left-0 shadow-lg">
    <ul class="flex flex-col space-y-2 p-4">

      <!-- Data Site Mobile -->
      <li>
        <button class="w-full text-left flex justify-between items-center px-4 py-2 font-medium" onclick="toggleDropdown('mobile-data')">
          Data Site <span>▸</span>
        </button>
        <ul id="mobile-data" class="hidden flex-col pl-4 space-y-1">
          <li><a href="{{ url('tables') }}" class="block px-4 py-2 hover:text-orange-500">Data Site</a></li>
          <li><a href="{{ route('datapass.index') }}" class="block px-4 py-2 hover:text-orange-500">Manajemen Password</a></li>
          <li><a href="{{ route('laporanPM') }}" class="block px-4 py-2 hover:text-orange-500">PM</a></li>
          <li><a href="{{ route('pmliberta') }}" class="block px-4 py-2 hover:text-orange-500">PM Liberta 2025</a></li>
        </ul>
      </li>

      <!-- Tiket Mobile -->
      <li>
        <button class="w-full text-left flex justify-between items-center px-4 py-2 font-medium" onclick="toggleDropdown('mobile-tiket')">
          Tiket <span>▸</span>
        </button>
        <ul id="mobile-tiket" class="hidden flex-col pl-4 space-y-1">
          <li><a href="{{ route('tiket') }}" class="block px-4 py-2 hover:text-orange-500">Open Tiket</a></li>
          <li><a href="{{ route('close.tiket') }}" class="block px-4 py-2 hover:text-orange-500">Close Tiket</a></li>
          <li><a href="{{ route('dashboard') }}" class="block px-4 py-2 hover:text-orange-500">Details</a></li>
        </ul>
      </li>

      <!-- Log Perangkat Mobile -->
      <li>
        <button class="w-full text-left flex justify-between items-center px-4 py-2 font-medium" onclick="toggleDropdown('mobile-log')">
          Log Perangkat <span>▸</span>
        </button>
        <ul id="mobile-log" class="hidden flex-col pl-4 space-y-1">
          <li><a href="{{ route('log_perangkat') }}" class="block px-4 py-2 hover:text-orange-500">Pergantian Perangkat</a></li>
          <li><a href="{{ route('sparetracker') }}" class="block px-4 py-2 hover:text-orange-500">Log Pergantian</a></li>
          <li><a href="{{ route('logtracker') }}" class="block px-4 py-2 hover:text-orange-500">Spare Tracker</a></li>
        </ul>
      </li>

      @if (in_array($role, ['admin', 'superadmin']))
      <li>
        <button class="w-full text-left flex justify-between items-center px-4 py-2 font-medium" onclick="toggleDropdown('mobile-sla')">
          SLA <span>▸</span>
        </button>
        <ul id="mobile-sla" class="hidden flex-col pl-4 space-y-1">
          <li><a href="{{ url('rekap-bmn') }}" class="block px-4 py-2 hover:text-orange-500">BMN</a></li>
          <li><a href="{{ url('rekap-sl') }}" class="block px-4 py-2 hover:text-orange-500">SL</a></li>
        </ul>
      </li>
      <li><a href="{{ route('jadwal.piket') }}" class="px-4 py-2 hover:text-orange-500">Jadwal Piket</a></li>
      @endif

      <!-- Project Mobile -->
      <li><a href="#" class="px-4 py-2 hover:text-orange-500">New Project</a></li>
      <li><a href="{{ route('todolist.index') }}" class="px-4 py-2 hover:text-orange-500">To Do List</a></li>
      <li><a href="{{ route('file.index') }}" class="px-4 py-2 hover:text-orange-500">Download</a></li>

      @auth
      @if (Auth::user()->role === 'superadmin')
      <li><a href="{{ url('users') }}" class="px-4 py-2 hover:text-orange-500">Users</a></li>
      @endif
      @endauth
    </ul>
  </div>
</nav>

<!-- NAVBAR & DROPDOWN STYLE -->
<style>
  #mainNav > div {
    box-shadow: 
      inset 0 1px 0 rgba(255,255,255,0.25),
      0 8px 30px rgba(0,0,0,0.25);
  }

  /* Dropdown Animasi */
  .group-hover\:dropdown-show {
    opacity: 1 !important;
    transform: translateY(0) scale(1) !important;
  }

  .group > div {
    opacity: 0;
    transform: translateY(10px) scale(0.95);
    transition: all 0.3s ease;
  }

  /* Dropdown Item */
  .dropdown-item {
    display: block;
    padding: 12px 16px;
    font-size: 14px;
    position: relative;
    transition: all 0.25s ease;
  }

  /* Hover Efek */
  .dropdown-item:hover {
    background: linear-gradient(90deg, #e0f2fe, #f0f9ff);
    color: #0284c7;
    padding-left: 24px;
  }

  /* Garis kiri animasi */
  .dropdown-item::before {
    content: "";
    position: absolute;
    left: 0;
    top: 50%;
    width: 0;
    height: 60%;
    background: #0ea5e9;
    transform: translateY(-50%);
    transition: width 0.25s ease;
  }

  .dropdown-item:hover::before {
    width: 4px;
  }

  /* Navbar Scroll Effect */
  nav.scrolled {
    background-color: rgba(255,255,255,0.95);
    backdrop-filter: blur(14px);
    box-shadow: 0 12px 30px rgba(0,0,0,0.12);
    transition: all 0.35s ease;
  }

  /* Link Hover Underline */
  ul li a {
    position: relative;
  }

  ul li a::after {
    content: '';
    position: absolute;
    bottom: -4px;
    left: 0;
    width: 0;
    height: 2px;
    background: #0ea5e9;
    transition: width 0.3s ease;
  }

  ul li a:hover::after {
    width: 100%;
  }
</style>
<script>
  const nav = document.getElementById('mainNav');
  window.addEventListener('scroll', () => {
    nav.classList.toggle('scrolled', window.scrollY > 40);
  });
</script>

<script>
  // Toggle mobile menu
  const mobileBtn = document.getElementById('mobile-menu-button');
  const mobileMenu = document.getElementById('mobile-menu');

  mobileBtn.addEventListener('click', () => {
    mobileMenu.classList.toggle('hidden');
  });

  // Toggle submenus di mobile
  function toggleDropdown(id) {
    const el = document.getElementById(id);
    el.classList.toggle('hidden');
  }
</script>

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

<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Company Profile - CV. Nustech</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" crossorigin="anonymous" referrerpolicy="no-referrer" />
  <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css2?family=Alfa+Slab+One&display=swap" rel="stylesheet">
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css2?family=Quicksand:wght@400;500;600;700&display=swap" rel="stylesheet">
  <style>
    @keyframes fadeUp {
      from { opacity: 0; transform: translateY(10px); }
      to { opacity: 1; transform: translateY(0); }
    }

    .animate-fade {
      animation: fadeUp 0.6s ease forwards;
    }

    .delay-200 { animation-delay: .2s; }
    .delay-400 { animation-delay: .4s; }
  </style>
  <style>
    body {
      font-family: 'Quicksand', sans-serif;
      font-color: black;
    }
     html {
      scroll-behavior: smooth;
    }
    .navbar {
      background-color: transparent;
      transition: background-color 0.3s ease;
    }
    .navbar.scrolled {
      background-color: #000000cc;
    }
    .footer-animate {
      opacity: 0;
      transform: translateX(-50px);
    }
    .footer-animate.visible {
      opacity: 1;
      transform: translateX(0);
      transition: all 5s ease-out;
    }
    @keyframes slideInLeft {
      0% { transform: translateX(-100%); opacity: 0; }
      100% { transform: translateX(0); opacity: 1; }
    }
    .animate-slide-in { animation: slideInLeft 4s ease forwards; }
    .fade-in-left, .fade-in-right {
      opacity: 0;
      transform: translateX(80px);
      transition: all 0.8s ease-out;
    }
    .fade-in-left.visible { transform: translateX(0); opacity: 1; }
    .fade-in-right { transform: translateX(-80px); }
    .fade-in-right.visible { transform: translateX(0); opacity: 1; }
    .fade-in-up {
      opacity: 0;
      transform: translateY(80px);
      transition: all 0.8s ease-out;
    }
    .fade-in-up.visible {
      opacity: 1;
      transform: translateY(0);
    }
    .lightbox {
      display: none;
      position: fixed;
      z-index: 50;
      padding-top: 60px;
      left: 0;
      top: 0;
      width: 100%;
      height: 100%;
      overflow: auto;
      background-color: rgba(0,0,0,0.9);
    }
    .lightbox img {
      margin: auto;
      display: block;
      max-width: 90%;
      max-height: 80vh;
      animation: zoom 0.3s ease;
    }
    @keyframes zoom {
      from { transform: scale(0.8); }
      to { transform: scale(1); }
    }
    .lightbox:target { display: block; }
    .close-lightbox {
      position: absolute;
      top: 30px;
      right: 50px;
      color: #fff;
      font-size: 40px;
      font-weight: bold;
      text-decoration: none;
      z-index: 100;
    }
    .close-lightbox:hover { color: #ccc; }
</style>
 <style>
    /* Sembunyikan scrollbar */
    #galleryContainer {
      scrollbar-width: none; /* Firefox */
      -ms-overflow-style: none; /* IE/Edge */
    }
    #galleryContainer::-webkit-scrollbar {
      display: none; /* Chrome/Safari/Opera */
    }
</style>
<style>
  /* Untuk mendukung hover menu dropdown di Tailwind v2.2 */
  .group:hover .group-hover\:flex {
    display: flex !important;
  }
</style>
<style>
  @keyframes float {
    0%, 100% {
      transform: translateY(0px);
    }
    50% {
      transform: translateY(-20px);
    }
  }

  .animate-float {
    animation: float 6s ease-in-out infinite;
  }

  .animate-float-slow {
    animation: float 8s ease-in-out infinite;
  }

  .animate-float-slower {
    animation: float 12s ease-in-out infinite;
  }

  @keyframes fadeInUp {
    0% {
      opacity: 0;
      transform: translateY(30px);
    }
    100% {
      opacity: 1;
      transform: translateY(0);
    }
  }

  .animate-fade-in-up {
    animation: fadeInUp 1.2s ease-out both;
  }

  #navbar a {
    font-size: 12px; /* atau 1rem, atau sesuaikan */
  }
  @tailwind base;
  @tailwind components;
  @tailwind utilities;

  @keyframes slideRight {
    0% {
      transform: translateY(50%);
      opacity: 0;
    }
    100% {
      transform: translateY(0);
      opacity: 1;
    }
  }

  .animate-slideRight {
    animation: slideRight 3s ease-out forwards;
  }
</style>
<style>
  @keyframes fade-in-up {
    0% {
      opacity: 0;
      transform: translateY(40px);
    }
    100% {
      opacity: 1;
      transform: translateY(0);
    }
  }
</style>
<style>
  @keyframes fade-in-up {
  0% {
    opacity: 0;
    transform: translateY(30px);
  }
  100% {
    opacity: 1;
    transform: translateY(0);
  }
}
.animate-fade-in-up {
  animation: fade-in-up 1s ease-out;
}

</style>
<style>
  @keyframes slideInLeft {
    from {
      transform: translateX(-50%);
      opacity: 0;
    }
    to {
      transform: translateX(0);
      opacity: 1;
    }
  }

  .animate-slide-in {
    animation: slideInLeft 2.6s ease-out;
    }
    .layanan-item ul li {
    opacity: 0;
    transform: translateX(-40px);
    animation: fadeInLeft 2.5s forwards;
  }
  .layanan-item ul li:nth-child(1) { animation-delay: 2.2s; }
  .layanan-item ul li:nth-child(2) { animation-delay: 3.4s; }
  .layanan-item ul li:nth-child(3) { animation-delay: 4.6s; }
  .layanan-item ul li:nth-child(4) { animation-delay: 5.8s; }

  @keyframes fadeInLeft {
    to {
      opacity: 1;
      transform: translateX(0);
    }
  }
</style>
<style>
  .modal-animate {
    opacity: 0;
    transform: translateY(30px);
    animation: fadeInUp 0.5s ease forwards;
  }

  @keyframes fadeInUp {
    to {
      opacity: 1;
      transform: translateY(0);
    }
  }
    @media (max-width: 768px) {
    #layananContent {
      padding-left: 0.5rem;
      padding-right: 0.5rem;
    }
  }
</style>
</head>
<body class="text-gray-900">
<!-- NAVBAR -->
<nav
  id="navbar"
  class="fixed top-0 left-0 right-0 z-50 w-full bg-transparent"
  style="font-family:-apple-system,BlinkMacSystemFont,'Segoe UI',Roboto,Helvetica,Arial,sans-serif;">

  <!-- WRAPPER CENTER -->
  <div class="flex justify-center px-4 sm:px-6 lg:px-8">
    
    <!-- NAV CONTAINER (BACKGROUND DI SINI) -->
    <div
      id="navCapsule"
      class="mt-4 bg-white/90 backdrop-blur
            shadow-lg rounded-full
            px-6 transition-all duration-300">

      <div class="flex items-center h-14 space-x-6 text-sm font-medium">

        <!-- Hamburger (Mobile) -->
        <div class="md:hidden">
          <button id="menu-toggle" class="focus:outline-none">
            <svg
              id="hamburgerIcon"
              class="w-6 h-6 text-sky-500"
              fill="none" stroke="currentColor" stroke-width="2"
              viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round"
                d="M4 6h16M4 12h16M4 18h16"/>
            </svg>
          </button>
        </div>

        <!-- MENU DESKTOP -->
        <div class="hidden md:flex items-center space-x-6">

          <a href="#beranda" class="nav-link">Beranda</a>
          <a href="#tentang" class="nav-link">Tentang Kami</a>
          <a href="#visimisi" class="nav-link">Visi Misi</a>

          <!-- Dropdown Layanan -->
          <div id="layananDropdown" class="relative">
            <button
              id="layananToggle"
              class="nav-link focus:outline-none flex items-center gap-1">
              Layanan
              <svg class="w-4 h-4 transition-transform duration-300" id="layananArrow"
                fill="none" stroke="currentColor" stroke-width="2"
                viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round"
                  d="M19 9l-7 7-7-7"/>
              </svg>
            </button>

            <div
              id="layananMenu"
              class="absolute left-1/2 -translate-x-1/2 mt-4 hidden
                    flex-col bg-white text-black
                    shadow-2xl rounded-2xl min-w-[260px] z-50
                    dropdown-animate origin-top">

              <button onclick="showLayanan('networking')" class="dropdown-item">
              Networking
              </button>
              <button onclick="showLayanan('aplikasi')" class="dropdown-item">
              Aplikasi
              </button>
              <button onclick="showLayanan('reklame')" class="dropdown-item">
              Reklame
              </button>
              <button onclick="showLayanan('kelistrikan')" class="dropdown-item">
              Kelistrikan
              </button>
              <button onclick="showLayanan('ac')" class="dropdown-item">
              Sistem Pendingin
              </button>
              <button onclick="showLayanan('komputer')" class="dropdown-item">
              Komputer & Printer
              </button>
              <button onclick="showLayanan('elektronik')" class="dropdown-item">
              Elektronik
              </button>
              <button onclick="showLayanan('kantor')" class="dropdown-item">
              Alat Kantor
              </button>
            </div>
          </div>
          <a href="#gallery" class="nav-link">Galeri</a>
        </div>

      </div>
    </div>
  </div>

  <!-- MOBILE MENU -->
  <div
    id="mobile-menu"
    class="md:hidden hidden mx-4 mt-4
           bg-white rounded-xl shadow-lg
           text-black font-medium
           space-y-2 px-4 pt-4 pb-6">
    <a href="#beranda">Beranda</a>
    <a href="#tentang">Tentang Kami</a>
    <a href="#visimisi">Visi Misi</a>
    <a href="#gallery">Galeri</a>
  </div>

</nav>
<!-- DROPDOWN ANIMATION STYLE --> 
<style>
/* === Dropdown Animation === */
.dropdown-animate {
  opacity: 0;
  transform: translateY(10px) scale(0.96);
  transition: all 0.25s ease;
}

.dropdown-show {
  opacity: 1;
  transform: translateY(0) scale(1);
}

/* === Dropdown item === */
.dropdown-item {
  padding: 12px 18px;
  text-align: left;
  font-size: 14px;
  transition: all 0.25s ease;
  position: relative;
}

.dropdown-item:not(:last-child) {
  border-bottom: 1px solid #f1f5f9;
}

/* Hover efek ala corporate */
.dropdown-item:hover {
  background: linear-gradient(90deg, #e0f2fe, #f0f9ff);
  color: #0284c7;
  padding-left: 24px;
}

/* Garis animasi kiri */
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

/* Panah ikut muter */
#layananArrow.rotate {
  transform: rotate(180deg);
}
</style>

<!-- STYLES NAVBAR -->
<style>
/* Navbar transition */
.navbar-transition {
  transition: all 0.35s ease;
}

/* Navbar saat scroll */
#navCapsule.scrolled {
  background-color: rgba(255,255,255,0.95);
  backdrop-filter: blur(14px);
  box-shadow: 0 12px 30px rgba(0,0,0,0.12);
}

/* Link */
.nav-link {
  color: #ffffff;
  position: relative;
  transition: color 0.3s ease;
}

/* Link saat scroll */
#navbar.scrolled .nav-link {
  color: #111827;
}

/* Hover underline ala Primacom */
.nav-link::after {
  content: "";
  position: absolute;
  bottom: -6px;
  left: 0;
  width: 0;
  height: 2px;
  background: #0ea5e9;
  transition: width 0.3s ease;
}
.nav-link:hover::after {
  width: 100%;
}

/* Dropdown */
.dropdown-item {
  text-align: left;
  padding: 10px 16px;
  transition: all 0.2s ease;
}
.dropdown-item:hover {
  background: #e0f2fe;
  color: #0284c7;
}

/* Hamburger ikut berubah */
#navbar.scrolled #hamburgerIcon {
  color: #111827;
}
</style>
  <!-- Hero Section -->
<section id="beranda" class="w-full min-h-screen flex items-center justify-center text-black relative overflow-hidden" style="background: grey;">

  <!-- Video Background -->
  <video autoplay muted loop playsinline class="absolute inset-0 w-full h-full object-cover z-0">
    <source src="{{ asset('assets/img/videobackgroundweb.mp4') }}" type="video/mp4">
    Your browser does not support the video tag.
  </video>

  <!-- Overlay Bubble (Jika tetap digunakan) -->
  <div class="absolute inset-0 overflow-hidden z-10">
    <!-- ... animasi bubble tetap di sini jika ada ... -->
  </div>

  <!-- Logo 
  <div class="fixed top-6 left-6 z-50" style="width: 60px; height: 60px;">-
    <a href="{{ route('landingpage') }}">-
      <img src="{{ asset('assets/img/logonustech.png') }}" alt="nustech logo"-
           class="nav-link btn {{ request()->routeIs('landingpage') ? 'btn-primary active' : 'btn-outline-primary' }}">-
    </a>-
  </div>-->

  <!-- Konten utama -->
  <div class="relative z-20 text-center px-4 animate-fade-in-up">
    <h1 class="mb-4 text-4xl md:text-5xl font-bold"
        style="font-family: -apple-system, BlinkMacSystemFont, 'San Francisco', 'Segoe UI', Roboto, Helvetica, Arial, sans-serif; color: #FFFFFF">
      CV. NUSTECH
    </h1>
    <p class="mt-4 text-lg md:text-xl text-white fade-in-up"
       style="font-family: -apple-system, BlinkMacSystemFont, 'San Francisco', 'Segoe UI', Roboto, Helvetica, Arial, sans-serif;">
      Solusi Teknologi Informasi dan Komunikasi
    </p>
  </div>
</section>

<!-- TENTANG KAMI SECTION -->
<section
  id="tentang"
  class="relative w-full min-h-screen flex flex-col lg:flex-row items-center justify-between px-0 py-4 overflow-hidden bg-white">

  <!-- BACKGROUND GRADIENT -->
  <div
    class="absolute inset-0 bg-gradient-to-br
           from-orange-50 via-white to-sky-50">
  </div>

  <!-- SHAPE SVG ORGANIC -->
  <svg
    class="absolute -top-12 -left-16 w-[1000px] opacity-30"
    viewBox="0 0 200 200"
    xmlns="http://www.w3.org/2000/svg">
    <path
      fill="#FDBA74"
      d="M47.3,-61.6C60.6,-54.2,70.5,-40.6,73.3,-26C76,-11.3,71.6,4.4,63.7,17.9C55.9,31.3,44.6,42.5,31.4,50.4C18.2,58.3,3.1,62.9,-12.2,63.5C-27.6,64.1,-43.2,60.6,-55.3,51.4C-67.4,42.2,-75.9,27.3,-77.4,11.4C-78.8,-4.5,-73.3,-21.5,-63.3,-34.8C-53.3,-48.1,-38.8,-57.7,-23.2,-63.8C-7.7,-69.9,8.9,-72.5,24.5,-69.5C40.1,-66.6,54.7,-58.2,47.3,-61.6Z"
      transform="translate(100 100)" />
  </svg>

  <!-- KIRI -->
  <div class="w-full lg:w-1/2 px-10 lg:px-20 z-10">
    <h2 class="text-4xl font-bold mb-6 leading-snug">
      Ini Tentang <span class="text-orange-600">Kami,</span> <span class="text-orange-400">Jagonya</span> <span class="text-gray-900">Teknologi Informasi</span>
    </h2>
    <p class="text-gray-600 mb-4 text-base leading-relaxed">
      CV. NUSTECH adalah perusahaan yang berbasis di Lombok, Nusa Tenggara Barat dan bergerak di bidang pengadaan barang dan jasa, khususnya dalam sektor teknologi informasi, kelistrikan, dan rekayasa teknik (engineering)...
    </p>
    <button onclick="openModal()"
      class="border border-gray-400 text-sm px-5 py-2 rounded-full hover:bg-gray-100 transition-all cursor-pointer">
      Pelajari Selengkapnya
    </button>
  </div>

  <!-- KANAN -->
  <div class="relative w-full lg:w-1/2 px-10 lg:px-20 mt-8 lg:mt-0 z-10">
    <img src="assets/img/tentangkami.png" alt="tentang kami" class="w-full h-auto"/>
  </div>

</section>

<!-- Modal FULLSCREEN dan Bisa Scroll -->
<div id="modalTentang" class="fixed inset-0 bg-black bg-opacity-60 z-50 overflow-y-auto hidden">
  <div class="min-h-screen flex items-start justify-center px-4 py-10">
    <div class="bg-white w-full max-w-6xl rounded-lg p-8 relative text-gray-800 shadow-2xl animate-modal">

      <!-- Tombol Close -->
      <button onclick="closeModal()" class="absolute top-4 right-6 text-3xl font-bold text-gray-600 hover:text-red-500">
        &times;
      </button>

      <!-- ===== ISI MODAL ===== -->

      <!-- Tentang -->
      <div class="mb-16 mt-6">
        <h3 class="text-3xl font-semibold mb-6 text-center">Tentang CV. NUSTECH</h3>
        <div class="text-justify text-[16px] leading-relaxed space-y-4">
          <p>
            CV. NUSTECH adalah perusahaan yang berbasis di Lombok Nusa Tenggara Barat dan bergerak di bidang pengadaan barang dan jasa, khususnya dalam sektor teknologi informasi, kelistrikan, dan rekayasa teknik (engineering).
          </p>
          <p>
            Kami menawarkan kemitraan profesional kepada perusahaan lokal, nasional, maupun instansi pemerintahan, dengan mengedepankan keahlian serta pengalaman kami di bidang terkait.
          </p>
          <p>
            Penyusunan company profile ini bertujuan untuk memberikan gambaran umum mengenai layanan yang kami tawarkan, sekaligus menjadi dasar pertimbangan dalam menjalin kerja sama.
          </p>
          <p>
            Kami memiliki pengalaman dalam pembangunan dan pengelolaan jaringan internet, pengadaan dan perawatan alat-alat elektronik kantor, dan instalasi serta perawatan sistem kelistrikan di berbagai sektor, seperti perkantoran, institusi pendidikan, dan instansi pemerintahan.
          </p>
          <p>
            Kepercayaan yang telah diberikan oleh mitra kerja sebelumnya menjadi bukti komitmen kami dalam memberikan layanan terbaik dan solusi yang handal.
          </p>
          <p>
            Kami mengucapkan terima kasih atas kesempatan yang diberikan untuk memperkenalkan perusahaan kami.
          </p>
          <p>
            Kami sangat berharap dapat menjalin kerja sama yang saling menguntungkan di masa mendatang.
          </p>
          <p><strong>Hormat Kami,<br>CV. NUSTECH</strong></p>
        </div>
      </div>

      <!-- Strategi Perusahaan -->
      <div class="mb-16">
        <h3 class="text-3xl font-semibold mb-6 text-center text-gray-800">Strategi Perusahaan</h3>
        <div class="text-justify text-[16px] leading-relaxed space-y-4">
          <p>
            CV. NUSTECH menerapkan strategi yang fokus pada pertumbuhan berkelanjutan, kepuasan pelanggan dan penguatan daya saing di pasar. Strategi utama kami meliputi:
          </p>
          <ul class="list-none space-y-2">
            <li><span class="text-sky-500">◆</span> <strong>Fokus pada Kualitas Layanan:</strong> Menyediakan layanan yang profesional, tepat waktu, dan sesuai kebutuhan klien.</li>
            <li><span class="text-sky-500">◆</span> <strong>Pemanfaatan Teknologi:</strong> Menggunakan sistem dan peralatan terbaru untuk mendukung efisiensi dan hasil kerja maksimal.</li>
            <li><span class="text-sky-500">◆</span> <strong>Kemitraan yang Kuat:</strong> Menjalin kerja sama dengan instansi pemerintah, swasta, dan mitra usaha secara berkelanjutan dan saling menguntungkan.</li>
            <li><span class="text-sky-500">◆</span> <strong>Pengembangan SDM:</strong> Meningkatkan kompetensi karyawan melalui pelatihan rutin dan pembinaan profesional.</li>
            <li><span class="text-sky-500">◆</span> <strong>Komitmen terhadap Kepuasan Pelanggan:</strong> Memberikan layanan purna jual dan dukungan teknis sebagai bentuk tanggung jawab perusahaan.</li>
          </ul>
        </div>
      </div>

      <!-- Kebijakan Perusahaan -->
      <div class="mb-10">
        <h3 class="text-3xl font-semibold mb-6 text-center text-sky-600">Kebijakan Perusahaan</h3>
        <div class="text-justify text-[16px] leading-relaxed space-y-4">
          <p>
            CV. NUSTECH berkomitmen untuk menjalankan usaha secara profesional, transparan, dan berorientasi pada kepuasan pelanggan. Adapun kebijakan utama kami meliputi:
          </p>
          <ul class="list-none space-y-2">
            <li><span class="text-sky-500">◆</span> <strong>Kualitas Layanan:</strong> Menjamin mutu layanan melalui proses kerja yang terstandar dan berorientasi hasil.</li>
            <li><span class="text-sky-500">◆</span> <strong>Integritas dan Profesionalisme:</strong> Menjunjung tinggi etika, kejujuran, dan tanggung jawab dalam setiap kegiatan usaha.</li>
            <li><span class="text-sky-500">◆</span> <strong>Keamanan dan Keselamatan Kerja:</strong> Menerapkan standar keselamatan kerja demi kenyamanan dan perlindungan seluruh karyawan.</li>
            <li><span class="text-sky-500">◆</span> <strong>Pengembangan SDM:</strong> Mendukung peningkatan kompetensi tim sebagai aset utama perusahaan.</li>
            <li><span class="text-sky-500">◆</span> <strong>Keberlanjutan dan Lingkungan:</strong> Berkontribusi positif terhadap lingkungan dan masyarakat melalui praktik bisnis yang bertanggung jawab.</li>
          </ul>
        </div>
      </div>

    </div>
  </div>
</div>

<section id="visimisi" class="w-full bg-white text-gray-900 py-20 font-[quicksand,sans-serif]">
  <!-- Judul -->
  <h2 class="text-4xl font-bold text-center text-black mb-16 animate-fade-in-down px-4 md:px-8"></h2>

  <!-- Grid Utama -->
  <div class="flex flex-col lg:flex-row justify-between items-center gap-12 px-4 md:px-8 xl:px-20">

    <!-- VISI -->
    <div class="w-full lg:w-1/3 animate-slideRight">
      <h3 class="text-2xl text-center mb-4 font-bold text-sky-800">VISI</h3>
      <div class="bg-white bg-opacity-80 p-5 rounded-xl text-justify">
        Menjadi perusahaan penyedia barang dan jasa di bidang teknologi informasi, elektronik, percetakan/reklame, meubel, dan alat-alat kantor yang profesional, memiliki daya saing tinggi, serta terpercaya di tingkat lokal maupun nasional.
      </div>
    </div>

    <!-- Gambar -->
    <div class="w-full lg:w-1/3 flex justify-center animate-fade-in-up">
      <img src="{{ asset('assets/img/untukvisimisi.png') }}" alt="visimisikami"
        class="w-full max-w-[350px] lg:max-w-[420px] object-contain drop-shadow-lg transition-transform duration-500 hover:scale-105">
    </div>

    <!-- MISI -->
    <div class="w-full lg:w-1/3 animate-slideLeft" style="font-family: 'Quicksand', sans-serif;">
      <h3 class="text-2xl font-bold text-center mb-4 text-sky-800">MISI</h3>
      <ul class="space-y-3 font-medium text-sm text-justify">
        <li class="flex items-start gap-2">
          <span class="text-sky-600 mt-1">🔹</span>
          Mengoptimalkan strategi pertumbuhan bisnis secara berkelanjutan dan menguntungkan guna meningkatkan kesejahteraan karyawan serta seluruh pemangku kepentingan.
        </li>
        <li class="flex items-start gap-2">
          <span class="text-sky-600 mt-1">🔹</span>
          Menjalin kerja sama yang saling menguntungkan dengan mitra usaha dan mitra kerja melalui pengelolaan pengadaan barang dan jasa secara sinergis dan efisien.
        </li>
        <li class="flex items-start gap-2">
          <span class="text-sky-600 mt-1">🔹</span>
          Memberikan pelayanan yang maksimal, cepat, dan profesional kepada seluruh klien dan mitra.
        </li>
        <li class="flex items-start gap-2">
          <span class="text-sky-600 mt-1">🔹</span>
          Memberikan nilai tambah yang optimal bagi masyarakat serta berkontribusi positif terhadap pelestarian lingkungan.
        </li>
        <li class="flex items-start gap-2">
          <span class="text-sky-600 mt-1">🔹</span>
          Menjunjung tinggi prinsip transparansi dan integritas dalam setiap proses bisnis sebagai bentuk komitmen terhadap kepercayaan para pemangku kepentingan.
        </li>
      </ul>
    </div>
  </div>
</section>

<section id="layanan" class="w-full bg-white text-gray-900 py-20 font-[quicksand,sans-serif]">
  <!-- Judul -->
  <h2 class="text-4xl font-bold text-sky-500 mb-12 text-end px-4 md:px-8">Layanan Yang Kami Berikan</h2>

  <!-- Container -->
  <div class="flex flex-col lg:flex-row gap-12 px-4 md:px-8 xl:px-20 items-start">

    <!-- Kiri -->
    <div class="w-full lg:w-1/2 space-y-10 text-black text-base">

        <!-- 1. Networking -->
        <div id="networking" class="layanan-item hidden">
          <h3 class="text-2xl font-semibold mb-3">Instalasi & Pemeliharaan Jaringan (Networking)</h3>
          <ul class="list-disc list-inside text-justify space-y-1">
            <li class="cursor-pointer text-black-600 hover:underline" onclick="openJaringanModal()">Instalasi dan maintenance jaringan komputer</li>
            <li class="cursor-pointer text-black-600 hover:underline" onclick="openVsatModal()"> Pemasangan dan Perawatan Jaringan VSAT </li>
            <li class="cursor-pointer text-black-600 hover:underline" onclick="openBasebandModal()">Pemasangan Baseband (BB) Tower</li>
            <li>Instalasi dan pemeliharaan sistem CCTV</li>
          </ul>
          <div class="mt-4">
            <a href="https://wa.me/6281332809923?text=Halo%2C%20saya%20tertarik%20dengan%20layanan%20Instalasi%20dan%20Pemeliharaan%20Jaringan%20(Networking)%20yang%20Anda%20tawarkan.%20Mohon%20info%20lebih%20lanjut."
                target="_blank"
              class="border border-gray-400 text-sm px-5 py-2 rounded-full hover:bg-gray-100 transition-all cursor-pointer">
              Hubungi Kami...
            </a>
          </div>
        </div>

        <!-- 2. Aplikasi -->
        <div id="aplikasi" class="layanan-item hidden">
          <h3 class="text-2xl font-semibold mb-3">Pengembangan Aplikasi & Program Komputer</h3>
          <ul class="list-disc list-inside text-justify space-y-1">
            <li>Pembuatan software/aplikasi sesuai kebutuhan klien</li>
            <li>Jasa pemrograman khusus untuk instansi dan perusahaan</li>
          </ul>
          <div class="mt-4">
            <a href="https://wa.me/6281332809923?text=Halo%2C%20saya%20tertarik%20dengan%20layanan%20Pengembangan%20Aplikasi%20dan%20Program%20Komputer%20yang%20Anda%20tawarkan.%20Mohon%20info%20lebih%20lanjut."
                target="_blank"
              class="border border-gray-400 text-sm px-5 py-2 rounded-full hover:bg-gray-100 transition-all cursor-pointer">
              Hubungi Kami...
            </a>
          </div>
        </div>

        <!-- 3. Reklame -->
        <div id="reklame" class="layanan-item hidden">
          <h3 class="text-2xl font-semibold mb-3">Reklame dan Percetakan</h3>
          <ul class="list-disc list-inside text-justify space-y-1">
            <li>Desain dan produksi media promosi</li>
            <li>Layanan cetak untuk berbagai kebutuhan perusahaan dan instansi</li>
          </ul>
          <div class="mt-4">
            <a href="https://wa.me/6281332809923?text=Halo%2C%20saya%20tertarik%20dengan%20layanan%20Reklame%20dan%20Percetakan%20yang%20Anda%20tawarkan.%20Mohon%20info%20lebih%20lanjut."
                target="_blank"
              class="border border-gray-400 text-sm px-5 py-2 rounded-full hover:bg-gray-100 transition-all cursor-pointer">
              Hubungi Kami...
            </a>
          </div>
        </div>

        <!-- 4. Kelistrikan -->
        <div id="kelistrikan" class="layanan-item hidden">
          <h3 class="text-2xl font-semibold mb-3">Kelistrikan</h3>
          <ul class="list-disc list-inside text-justify space-y-1">
            <li>Perancangan, pemasangan, dan perawatan sistem kelistrikan untuk bangunan kantor dan instansi</li>
          </ul>
          <div class="mt-4">
             <a href="https://wa.me/6281332809923?text=Halo%2C%20saya%20tertarik%20dengan%20layanan%20Kelistrikan%20yang%20Anda%20tawarkan.%20Mohon%20info%20lebih%20lanjut."
                target="_blank"
              class="border border-gray-400 text-sm px-5 py-2 rounded-full hover:bg-gray-100 transition-all cursor-pointer">
              Hubungi Kami...
            </a>
          </div>
        </div>

        <!-- 5. Sistem Pendingin -->
        <div id="ac" class="layanan-item hidden">
          <h3 class="text-2xl font-semibold mb-3">Instalasi & Pemeliharaan Sistem Pendingin (AC)</h3>
          <ul class="list-disc list-inside text-justify space-y-1">
            <li>Pemasangan AC dan sistem pendingin lainnya</li>
            <li>Maintenance dan perbaikan berkala</li>
          </ul>
          <div class="mt-4">
            <a href="https://wa.me/6281332809923?text=Halo%2C%20saya%20tertarik%20dengan%20layanan%20Instalasi%20dan%20Pemeliharaan%20Sistem%20Pendingin%20(AC)%20yang%20Anda%20tawarkan.%20Mohon%20info%20lebih%20lanjut."
                target="_blank"
              class="border border-gray-400 text-sm px-5 py-2 rounded-full hover:bg-gray-100 transition-all cursor-pointer">
              Hubungi Kami...
            </a>
          </div>
        </div>

        <!-- 6. Komputer dan Printer -->
        <div id="komputer" class="layanan-item hidden">
          <h3 class="text-2xl font-semibold mb-3">Pengadaan & Maintenance Perangkat Komputer dan Printer</h3>
          <ul class="list-disc list-inside text-justify space-y-1">
            <li>Pengadaan unit komputer, printer, dan perangkat pendukung</li>
            <li>Layanan perawatan dan perbaikan berkala</li>
          </ul>
          <div class="mt-4">
            <a href="https://wa.me/6281332809923?text=Halo%2C%20saya%20tertarik%20dengan%20layanan%20Pengadaan%20dan%20Maintenance%20Perangkat%20Komputer%20dan%20Printer%20yang%20Anda%20tawarkan.%20Mohon%20info%20lebih%20lanjut."
                target="_blank"
              class="border border-gray-400 text-sm px-5 py-2 rounded-full hover:bg-gray-100 transition-all cursor-pointer">
              Hubungi Kami...
            </a>
          </div>
        </div>

        <!-- 7. Elektronik -->
        <div id="elektronik" class="layanan-item hidden">
          <h3 class="text-2xl font-semibold mb-3">Pengadaan Peralatan Elektronik</h3>
          <ul class="list-disc list-inside text-justify space-y-1">
            <li>Penyediaan berbagai jenis perangkat elektronik sesuai kebutuhan proyek</li>
          </ul>
          <div class="mt-4">
            <a href="https://wa.me/6281332809923?text=Halo%2C%20saya%20tertarik%20dengan%20layanan%20pengadaan%20peralatan%20elektronik%20yang%20Anda%20tawarkan" 
                target="_blank"
              class="border border-gray-400 text-sm px-5 py-2 rounded-full hover:bg-gray-100 transition-all cursor-pointer">
              Hubungi Kami...
            </a>
          </div>
        </div>

        <!-- 8. Alat Kantor -->
        <div id="kantor" class="layanan-item hidden">
          <h3 class="text-2xl font-semibold mb-3">Pengadaan & Perawatan Alat-Alat Kantor</h3>
          <ul class="list-disc list-inside text-justify space-y-1">
            <li>Penyediaan perlengkapan kantor</li>
            <li>Perawatan alat kantor secara rutin</li>
          </ul>
          <div class="mt-4">
            <a href="https://wa.me/6281332809923?text=Halo%2C%20saya%20tertarik%20dengan%20layanan%20pengadaan%20dan%20perawatan%20alat-alat%20kantor%20yang%20Anda%20tawarkan.%20Saya%20ingin%20mendapatkan%20informasi%20lebih%20lanjut%20mengenai%20produk%20dan%20layanan%20yang%20tersedia.
                " target="_blank"
              class="border border-gray-400 text-sm px-5 py-2 rounded-full hover:bg-gray-100 transition-all cursor-pointer">
              Hubungi Kami...
            </a>
          </div>
        </div>

      </div>
    </div>

    <!-- Kanan: Gambar -->
    <div class="w-full px-4 lg:px-8">
      <div class="w-full grid grid-cols-1 lg:grid-cols-2 gap-6 items-center">
        <!-- Gambar -->
        <div class="flex justify-end">
          <img src="{{ asset('assets/img/rosiemaulana.png') }}"
              alt="omrosi"
              class="w-full max-w-sm object-contain drop-shadow-xl">
        </div>
        
        <!-- Card -->
        <div class="bg-gray-200 p-6 rounded-xl shadow-md text-end">
          <details class="group text-left cursor-pointer">
            <summary class="flex justify-between items-center font-semibold text-xl">
              <span>Solusi Teknologi Sekali Sentuh</span>
              <span class="transform group-open:rotate-90 transition-transform duration-300 text-2xl">&gt;</span>
            </summary>
            <div class="mt-3 text-gray-700">
              <p>
                Kelola CCTV, jaringan internet, dan sistem AC dalam satu ekosistem terpadu.
                Instalasi cepat, konfigurasi otomatis, dan dukungan teknisi berpengalaman
                memastikan sistem Anda selalu siap bekerja — di kantor, hotel, hingga kawasan wisata seperti Gili.
              </p>
            </div>
          </details>
          <details class="group text-left cursor-pointer mt-4">
            <summary class="flex justify-between items-center font-semibold text-xl">
              <span> Koneksi Stabil, Instalasi Andal</span>
              <span class="transform group-open:rotate-90 transition-transform duration-300 text-2xl">&gt;</span>
            </summary>
            <div class="mt-3 text-gray-700">
              <p>
                Kami menyediakan solusi jaringan internet yang stabil, cepat, dan konsisten
                melalui instalasi Point-to-Point serta infrastruktur jaringan yang andal,
                ditangani langsung oleh teknisi berpengalaman dan profesional.
                Dirancang untuk mendukung operasional tanpa hambatan, baik di pusat kota
                maupun di wilayah dengan keterbatasan akses.
              </p>
            </div>
          </details>
          <details class="group text-left cursor-pointer mt-4">
            <summary class="flex justify-between items-center font-semibold text-xl">
              <span> Nyaman & Aman Sepanjang Hari</span>
              <span class="transform group-open:rotate-90 transition-transform duration-300 text-2xl">&gt;</span>
            </summary>
            <div class="mt-3 text-gray-700">
              <p>
                Nikmati kenyamanan tanpa henti dengan AC yang optimal dan sistem keamanan 24 jam.
                Tim teknisi kami siap memantau, merawat, dan memastikan semua berjalan lancar —
                sehingga Anda bisa fokus pada bisnis dan aktivitas utama.
              </p>
            </div>
          </details>
        </div>
      </div>
    </div>
  </div>
</section>

<!-- Gallery Section -->
<section id="gallery" class="py-16 px-4 md:px-10 relative">
  <div class="max-w-[90rem] mx-auto px-4 lg:px-8">
    <h2
      class="text-3xl md:text-5xl font-bold mb-10 text-center text-gray-800"
      style="font-family: quicksand, sans-serif;">
      Pengalaman Kerja
    </h2>

    <!-- Wrapper agar overflow disembunyikan -->
    <div id="galleryContainerWrapper" class="overflow-hidden relative">
      <!-- Kontainer gambar dengan animasi scroll -->
      <div id="galleryContainer" class="flex gap-6 animate-scroll">
        <!-- Gambar Asli -->
        <!--<a href="#" class="flex-shrink-0 w-64 snap-start rounded-lg shadow-lg group block">
          <img src="{{ asset('assets/img/ac.jpg') }}" alt="AC" class="w-full h-64 object-cover rounded-lg transition-transform duration-300 group-hover:scale-110">
        </a>-->

        <a href="#" class="flex-shrink-0 w-64 snap-start rounded-lg shadow-lg group block">
          <img src="{{ asset('assets/img/starlink.jpg') }}" alt="Starlink" class="w-full h-64 object-cover rounded-lg transition-transform duration-300 group-hover:scale-110">--
        </a>

        <!--<a href="#" class="flex-shrink-0 w-64 snap-start rounded-lg shadow-lg group block">
          <img src="{{ asset('assets/img/vsat.jpg') }}" alt="VSAT" class="w-full h-64 object-cover rounded-lg transition-transform duration-300 group-hover:scale-110">--
        </a>-->

        <a href="#" class="flex-shrink-0 w-64 snap-start rounded-lg shadow-lg group block">
          <img src="{{ asset('assets/img/vsatatm.jpg') }}" alt="VSAT ATM" class="w-full h-64 object-cover rounded-lg transition-transform duration-300 group-hover:scale-110">
        </a>

        <!--<a href="#" class="flex-shrink-0 w-64 snap-start rounded-lg shadow-lg group block">
          <img src="{{ asset('assets/img/printer.jpg') }}" alt="Printer" class="w-full h-64 object-cover rounded-lg transition-transform duration-300 group-hover:scale-110">--
        </a>-->

        <a href="#" class="flex-shrink-0 w-64 snap-start rounded-lg shadow-lg group block">
          <img src="{{ asset('assets/img/foto2.jpg') }}" alt="Foto 2" class="w-full h-64 object-cover rounded-lg transition-transform duration-300 group-hover:scale-110">
        </a>

        <a href="#" class="flex-shrink-0 w-64 snap-start rounded-lg shadow-lg group block">
          <img src="{{ asset('assets/img/serviceac.jpg') }}" alt="Service AC" class="w-full h-64 object-cover rounded-lg transition-transform duration-300 group-hover:scale-110">
        </a>

        <!--<a href="#" class="flex-shrink-0 w-64 snap-start rounded-lg shadow-lg group block">
          <img src="{{ asset('assets/img/foto3.jpg') }}" alt="Foto 3" class="w-full h-64 object-cover rounded-lg transition-transform duration-300 group-hover:scale-110">--
        </a>-->

        <!-- Duplikasi Gambar untuk loop -->
        <!--<a href="#" class="flex-shrink-0 w-64 snap-start rounded-lg shadow-lg group block">
          <img src="{{ asset('assets/img/ac.jpg') }}" alt="AC" class="w-full h-64 object-cover rounded-lg transition-transform duration-300 group-hover:scale-110">
        </a>-->

        <a href="#" class="flex-shrink-0 w-64 snap-start rounded-lg shadow-lg group block">
          <img src="{{ asset('assets/img/starlink.jpg') }}" alt="Starlink" class="w-full h-64 object-cover rounded-lg transition-transform duration-300 group-hover:scale-110">--
        </a>

        <!--<a href="#" class="flex-shrink-0 w-64 snap-start rounded-lg shadow-lg group block">
          <img src="{{ asset('assets/img/vsat.jpg') }}" alt="VSAT" class="w-full h-64 object-cover rounded-lg transition-transform duration-300 group-hover:scale-110">--
        </a>-->

        <a href="#" class="flex-shrink-0 w-64 snap-start rounded-lg shadow-lg group block">
          <img src="{{ asset('assets/img/vsatatm.jpg') }}" alt="VSAT ATM" class="w-full h-64 object-cover rounded-lg transition-transform duration-300 group-hover:scale-110">
        </a>

        <!--<a href="#" class="flex-shrink-0 w-64 snap-start rounded-lg shadow-lg group block">
          <img src="{{ asset('assets/img/printer.jpg') }}" alt="Printer" class="w-full h-64 object-cover rounded-lg transition-transform duration-300 group-hover:scale-110">--
        </a>-->

        <a href="#" class="flex-shrink-0 w-64 snap-start rounded-lg shadow-lg group block">
          <img src="{{ asset('assets/img/foto2.jpg') }}" alt="Foto 2" class="w-full h-64 object-cover rounded-lg transition-transform duration-300 group-hover:scale-110">
        </a>

        <a href="#" class="flex-shrink-0 w-64 snap-start rounded-lg shadow-lg group block">
          <img src="{{ asset('assets/img/serviceac.jpg') }}" alt="Service AC" class="w-full h-64 object-cover rounded-lg transition-transform duration-300 group-hover:scale-110">
        </a>

        <!--<a href="#" class="flex-shrink-0 w-64 snap-start rounded-lg shadow-lg group block">
          <img src="{{ asset('assets/img/foto3.jpg') }}" alt="Foto 3" class="w-full h-64 object-cover rounded-lg transition-transform duration-300 group-hover:scale-110">--
        </a>-->
      </div>
    </div>
  </div>
</section>

<style>
  @keyframes scrollGallery {
    0% {
      transform: translateX(0);
    }
    100% {
      transform: translateX(-50%);
    }
  }

  .animate-scroll {
    animation: scrollGallery 40s linear infinite;
    width: max-content;
  }

  #galleryContainerWrapper {
    overflow: hidden;
  }
</style>


<!-- Lightbox Popups -->
<div id="img1" class="lightbox">
  <a href="#" class="close-lightbox">&times;</a>
  <img src="images/gallery1.jpg" alt="Gallery 1">
</div>
<div id="img2" class="lightbox">
  <a href="#" class="close-lightbox">&times;</a>
  <img src="images/gallery2.jpg" alt="Gallery 2">
</div>
<div id="img3" class="lightbox">
  <a href="#" class="close-lightbox">&times;</a>
  <img src="images/gallery3.jpg" alt="Gallery 3">
</div>
<div id="img4" class="lightbox">
  <a href="#" class="close-lightbox">&times;</a>
  <img src="images/gallery4.jpg" alt="Gallery 4">
</div>
<div id="img5" class="lightbox">
  <a href="#" class="close-lightbox">&times;</a>
  <img src="images/gallery5.jpg" alt="Gallery 5">
</div>
<div id="img6" class="lightbox">
  <a href="#" class="close-lightbox">&times;</a>
  <img src="images/gallery6.jpg" alt="Gallery 6">
</div>

<!--<img src="{{ asset('assets/img/barubackground.jpg') }}" alt="" class="text-black">-->
<footer class="text-white py-10" style="background: #626f78; font-family: quicksand, sans-serif;">
  <div class="max-w-7xl mx-auto px-6 grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-12 text-center">
    
    <!-- Kontak -->
    <div id="footer-kontak" class="footer-animate">
      <h3 class="text-xl font-bold mb-4">Kontak Kami</h3>
      <ul class="space-y-2 text-sm">
        <li><i class="fa fa-map-marker-alt mr-2 text-sky-400"></i>Jl. Semangka No.2, Mataram - NTB</li>
        <li><i class="fa fa-phone mr-2 text-sky-400"></i>+62 813 3280 9923</li>
        <li><i class="fa fa-envelope mr-2 text-sky-400"></i>info@nustech.co.id</li>
        <li><i class="fa fa-globe mr-2 text-sky-400"></i>nustech.co.id</li>
        <li><i class="fa fa-clock mr-2 text-sky-400"></i>Open 24 Hours</li>
        <li>
          <i class="fab fa-instagram mr-2"></i>
          <a href="https://www.instagram.com/nustech.co.id/" target="_blank" class="hover:underline text-white hover:text-100">
            nustech.co.id
          </a>
        </li>
      </ul>
    </div>

    <!-- Tentang -->
    <div id="footer-nustech" class="footer-animate">
      <h3 class="text-xl font-bold mb-4">CV. NUSTECH</h3>
      <p class="text-sm text-justify md:text-center">
        Penyedia layanan IT, percetakan, reklame, kelistrikan, pendingin, dan pengadaan barang yang profesional dan terpercaya di tingkat lokal maupun nasional.
      </p>
    </div>

    <!-- Lokasi -->
    <div id="footer-lokasi" class="footer-animate">
      <h3 class="text-xl font-bold mb-4">Lokasi Kami</h3>
      <div class="w-full">
        <iframe
          src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3945.26015016994!2d116.0791956745222!3d-8.570965686954882!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2dcdc10022fd3a0d%3A0xfda15d722c655f8b!2sCV.%20NUSTECH!5e0!3m2!1sen!2sus!4v1752163703447!5m2!1sen!2sus" "
          width="100%" height="200" style="border:0;" allowfullscreen="" loading="lazy"
          referrerpolicy="no-referrer-when-downgrade"></iframe>
      </div>
    </div>
  </div>
</footer>
<!-- MODAL WRAPPER -->
<div
  id="basebandModal"
  class="fixed inset-0 z-40 hidden bg-black/60">

  <!-- MODAL BOX -->
<div
  id="basebandModalBox"
  class="bg-white w-full h-full
         transform transition-all duration-300
         opacity-0 scale-95
         overflow-hidden">

  <!-- HEADER (STICKY DI BAWAH NAVBAR) -->
  <div class="sticky top-16 bg-white z-20 border-b">
    <div class="flex justify-center items-center px-6 py-4">
      <h3 class="text-xl font-semibold">
        Pemasangan Jaringan Internet BAKTI BTS
      </h3>
      <button
        onclick="closeBasebandModal()"
        class="absolute right-6 text-3xl leading-none hover:text-red-600 transition">
          &times;
      </button>
    </div>
  </div>

  <!-- BODY -->
  <div
    class="h-[calc(100vh-64px-64px)]
           overflow-y-auto px-6">

    <!-- CONTENT CENTER -->
    <div class="min-h-full flex items-center justify-center">
      <div class="max-w-3xl space-y-6 py-16 text-gray-700">

        <p class="text-lg font-medium text-gray-800 text-center">
          Pernahkah Anda bertanya bagaimana sinyal ponsel dapat bekerja
          cepat, stabil, dan menjangkau hingga ke wilayah terpencil?
        </p>

        <p class="leading-relaxed text-justify">
          Jawabannya terletak pada infrastruktur jaringan yang dirancang
          dan dibangun dengan presisi tinggi. Melalui program
          <strong>Jaringan Internet BAKTI BTS</strong>, kami menghadirkan
          solusi konektivitas yang andal untuk mendukung transformasi
          digital di wilayah tertinggal, terdepan, dan terluar (3T).
        </p>

        <p class="leading-relaxed text-justify">
          <strong>Baseband Tower (BB)</strong> berperan sebagai pusat
          pengolahan sinyal yang mengintegrasikan perangkat radio,
          VSAT, serta sistem transmisi data ke dalam satu ekosistem
          jaringan yang terhubung langsung ke backbone nasional.
        </p>

        <p class="leading-relaxed text-justify">
          Kami tidak sekadar membangun menara—kami membangun
          <strong>jembatan digital</strong> yang menghubungkan masyarakat,
          layanan publik, dan peluang ekonomi. Seluruh proses instalasi
          dilaksanakan oleh tenaga teknis profesional dan berpengalaman,
          dengan mengutamakan standar keselamatan kerja, keandalan sistem,
          serta kualitas layanan jangka panjang.
        </p>

        <!-- TIMELINE -->
        <div class="mt-10 border-l-4 border-sky-600 pl-6 space-y-6 text-left max-h-72 overflow-y-auto pr-4 scroll-smooth">

          <div>
            <span class="font-semibold text-sky-600">Instalasi Perangkat Keras BTS</span>
            <p class="text-gray-600 text-justify leading-relaxed">
              Pemasangan perangkat
              baseband, radio, dan antena sektoral dilakukan secara terstruktur
              untuk memastikan jangkauan sinyal yang luas serta kualitas layanan
              yang optimal di berbagai wilayah prioritas.
            </p>
          </div>

          <div>
            <span class="font-semibold text-sky-600">Optimalisasi Jaringan</span>
            <p class="text-gray-600 text-justify leading-relaxed">
              Memaksimalkan kinerja sistem
              baseband melalui integrasi jaringan VSAT dan IP, sehingga transmisi
              data menjadi lebih cepat, stabil, dan andal.
            </p>
          </div>

          <div>
            <span class="font-semibold text-sky-600">Solusi Cepat & Efisien</span>
            <p class="text-gray-600 text-justify leading-relaxed">
              Tim teknis kami bergerak
              responsif untuk meningkatkan kapasitas BTS dan menyelesaikan proyek
              dengan standar kualitas tertinggi sesuai kebutuhan konektivitas
              yang terus berkembang.
            </p>
          </div>

        </div>
      </div>
    </div>

  </div>

  <!-- FOOTER -->
  <div class="sticky bottom-0 bg-white border-t px-6 py-4 text-center">
    <button
      onclick="closeBasebandModal()"
      class="px-8 py-2 bg-sky-600 text-white rounded-full hover:bg-sky-700 transition">
      Tutup
    </button>
  </div>
</div>
</div>
<div
  id="vsatModal"
  class="fixed inset-0 z-40 hidden bg-black/60">

  <!-- MODAL BOX -->
  <div
    id="vsatModalBox"
    class="bg-white w-full h-full
           transform transition-all duration-300
           opacity-0 scale-95
           overflow-hidden">

    <!-- HEADER -->
    <div class="sticky top-16 bg-white z-20 border-b">
      <div class="flex justify-center items-center px-6 py-4 relative">
        <h3 class="text-xl font-semibold">
          Pemasangan & Perawatan Jaringan VSAT
        </h3>
        <button
          onclick="closeVsatModal()"
          class="absolute right-6 text-3xl leading-none hover:text-red-600 transition">
          &times;
        </button>
      </div>
    </div>

    <!-- BODY -->
    <div
      class="h-[calc(100vh-64px-64px)]
             overflow-y-auto px-6">

      <div class="min-h-full flex items-center justify-center">
        <div class="max-w-3xl space-y-6 py-16 text-gray-700">

          <p class="text-lg font-medium text-gray-800 text-center">
            Bagaimana koneksi internet tetap tersedia di wilayah terpencil
            yang belum terjangkau jaringan fiber maupun seluler?
          </p>

          <p class="leading-relaxed text-justify">
            Jawabannya adalah teknologi
            <strong>Very Small Aperture Terminal (VSAT)</strong>,
            sebuah sistem komunikasi satelit yang memungkinkan akses
            internet tetap stabil di daerah 3T (Tertinggal, Terdepan, Terluar).
          </p>

          <p class="leading-relaxed text-justify">
            Melalui program <strong>Internet BAKTI</strong>, jaringan VSAT
            dimanfaatkan sebagai tulang punggung konektivitas untuk
            sekolah, fasilitas kesehatan, kantor pemerintahan,
            serta layanan publik lainnya.
          </p>

          <p class="leading-relaxed text-justify">
            Instalasi dan perawatan VSAT dilakukan oleh teknisi profesional
            dengan standar keselamatan kerja tinggi, memastikan sistem
            beroperasi optimal, tahan cuaca, dan andal untuk jangka panjang.
          </p>

          <!-- TIMELINE -->
          <div
            class="mt-10 border-l-4 border-sky-600 pl-6 space-y-6
                   text-left max-h-72 overflow-y-auto pr-4 scroll-smooth">

            <div>
              <span class="font-semibold text-sky-600">
                Instalasi Perangkat VSAT
              </span>
              <p class="text-gray-600 text-justify leading-relaxed">
                Pemasangan antena parabola, modem satelit,
                dan perangkat jaringan dilakukan secara presisi
                untuk memastikan pointing satelit yang optimal.
              </p>
            </div>

            <div>
              <span class="font-semibold text-sky-600">
                Integrasi Jaringan
              </span>
              <p class="text-gray-600 text-justify leading-relaxed">
                Sistem VSAT diintegrasikan dengan jaringan lokal
                dan perangkat IP agar distribusi internet
                berjalan stabil dan efisien.
              </p>
            </div>

            <div>
              <span class="font-semibold text-sky-600">
                Pemeliharaan & Monitoring
              </span>
              <p class="text-gray-600 text-justify leading-relaxed">
                Pemantauan berkala dan perawatan rutin dilakukan
                untuk menjaga kualitas koneksi serta meminimalkan
                gangguan operasional.
              </p>
            </div>

            <div class="milestone-wrapper">

              <!-- ITEM -->
              <div class="milestone-item">
                <div class="milestone-year">2024</div>

                <div class="milestone-line">
                  <span class="milestone-dot"></span>
                </div>

                <div class="milestone-content">
                  <img src="/images/vsat-2024.jpg" alt="VSAT 2024">
                  <p>
                    Instalasi VSAT BAKTI di Sulawesi Tengah dan Kalimantan Utara
                    dengan ratusan lokasi untuk mendukung konektivitas wilayah 3T.
                  </p>
                </div>
              </div>

              <!-- ITEM -->
              <div class="milestone-item">
                <div class="milestone-year">2023</div>

                <div class="milestone-line">
                  <span class="milestone-dot"></span>
                </div>

                <div class="milestone-content">
                  <img src="/images/vsat-2023.jpg" alt="VSAT 2023">
                  <p>
                    Ekspansi jaringan VSAT BAKTI di Sulawesi Utara, Sulawesi Tengah,
                    Sulawesi Tenggara, dan Kota Sorong.
                  </p>
                </div>
              </div>

              <!-- ITEM -->
              <div class="milestone-item">
                <div class="milestone-year">2022</div>

                <div class="milestone-line">
                  <span class="milestone-dot"></span>
                </div>

                <div class="milestone-content">
                  <img src="/images/vsat-2022.jpg" alt="VSAT 2022">
                  <p>
                    Instalasi dan maintenance VSAT BAKTI di Maluku, Papua, dan NTB
                    dengan fokus pada stabilitas jaringan.
                  </p>
                </div>
              </div>

            </div>

          </div>
        </div>
      </div>
    </div>

    <!-- FOOTER -->
    <div class="sticky bottom-0 bg-white border-t px-6 py-4 text-center">
      <button
        onclick="closeVsatModal()"
        class="px-8 py-2 bg-sky-600 text-white rounded-full hover:bg-sky-700 transition">
        Tutup
      </button>
    </div>

  </div>
</div>
<!-- MODAL BACKDROP -->
<!-- MODAL JARINGAN KOMPUTER -->
<div
  id="jaringanModal"
  class="fixed inset-0 z-40 hidden bg-black/60">

  <!-- MODAL BOX -->
  <div
    id="jaringanModalBox"
    class="bg-white w-full h-full flex flex-col
           transform transition-all duration-300
           opacity-0 scale-95">

    <!-- HEADER (TIDAK IKUT SCROLL) -->
    <div class="sticky top-16 bg-white z-20 border-b shrink-0">
      <div class="flex justify-center items-center px-6 py-4 relative">
        <h3 class="text-xl font-semibold text-gray-800">
          Instalasi & Maintenance Jaringan Komputer
        </h3>
        <button
          onclick="closeJaringanModal()"
          class="absolute right-6 text-3xl leading-none hover:text-red-600 transition">
          &times;
        </button>
      </div>
    </div>

    <!-- BODY (SCROLL DI SINI) -->
    <div class="flex-1 overflow-y-auto px-6">

      <div class="max-w-4xl mx-auto w-full py-16 space-y-14 text-gray-700">

        <!-- HERO -->
        <div class="text-center space-y-4 animate-fade-in-up">
          <div
            class="inline-flex items-center justify-center w-20 h-20
                   rounded-full bg-sky-100 mx-auto animate-float">
            <svg class="w-10 h-10 text-sky-600"
                 fill="none" stroke="currentColor" stroke-width="2"
                 viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round"
                    d="M4 6h16M4 12h16M4 18h16"/>
            </svg>
          </div>

          <h4 class="text-2xl font-semibold text-gray-800">
            Fondasi Digital yang Andal
          </h4>

          <p class="text-gray-600 max-w-2xl mx-auto">
            Jaringan yang stabil, aman, dan siap berkembang
            tidak terjadi secara kebetulan —
            semuanya dimulai dari instalasi dan perawatan
            yang dirancang dengan tepat.
          </p>
        </div>

        <!-- DESCRIPTION -->
        <div class="space-y-4 leading-relaxed text-justify animate-fade delay-200">
          <p>
            Kami menghadirkan layanan
            <strong>Instalasi dan Maintenance Jaringan Komputer</strong>
            untuk memastikan konektivitas berjalan
            <strong>cepat, stabil, dan minim gangguan</strong>.
          </p>
          <p>
            Seluruh proses dikerjakan oleh tenaga teknis profesional,
            mulai dari perencanaan jaringan, pemasangan perangkat,
            hingga pemeliharaan berkala dengan standar kerja terbaik.
          </p>
        </div>

        <!-- SERVICE CARDS -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

          <div class="p-6 rounded-xl border shadow-sm
                      hover:shadow-lg transition animate-fade delay-300">
            <h5 class="font-semibold text-sky-600 mb-2">
              🔧 Perencanaan & Instalasi
            </h5>
            <p class="text-sm text-gray-600 leading-relaxed">
              Instalasi LAN, WAN, dan WiFi yang disesuaikan dengan
              kebutuhan area kerja, termasuk penarikan kabel UTP/Fiber,
              penataan rack, dan konfigurasi awal sistem.
            </p>
          </div>

          <div class="p-6 rounded-xl border shadow-sm
                      hover:shadow-lg transition animate-fade delay-400">
            <h5 class="font-semibold text-sky-600 mb-2">
              ⚙️ Konfigurasi Perangkat
            </h5>
            <p class="text-sm text-gray-600 leading-relaxed">
              Pengaturan router, switch, access point, firewall,
              VLAN, serta manajemen bandwidth
              agar koneksi stabil dan aman.
            </p>
          </div>

          <div class="p-6 rounded-xl border shadow-sm
                      hover:shadow-lg transition animate-fade delay-500">
            <h5 class="font-semibold text-sky-600 mb-2">
              📊 Maintenance & Monitoring
            </h5>
            <p class="text-sm text-gray-600 leading-relaxed">
              Pemeliharaan rutin, monitoring performa jaringan,
              serta troubleshooting cepat
              untuk meminimalkan downtime.
            </p>
          </div>

          <div class="p-6 rounded-xl border shadow-sm
                      hover:shadow-lg transition animate-fade delay-600">
            <h5 class="font-semibold text-sky-600 mb-2">
              🔐 Keamanan & Pengembangan
            </h5>
            <p class="text-sm text-gray-600 leading-relaxed">
              Peningkatan keamanan jaringan dan kesiapan infrastruktur
              agar mudah dikembangkan
              seiring pertumbuhan bisnis.
            </p>
          </div>

        </div>

        <!-- VALUE STRIP -->
        <div
          class="bg-sky-50 rounded-xl p-8 text-center
                 animate-fade-in-up">
          <h5 class="text-lg font-semibold text-gray-800 mb-2">
            Kenapa Memilih Kami?
          </h5>
          <p class="text-gray-600">
            ✔ Teknisi Berpengalaman & Profesional<br>
            ✔ Respon Cepat & Solusi Efisien<br>
            ✔ Jaringan Rapi, Aman & Scalable<br>
            ✔ Dukungan Jangka Panjang
          </p>
        </div>

      </div>
    </div>

    <!-- FOOTER (TIDAK IKUT SCROLL) -->
    <div class="sticky bottom-0 bg-white border-t px-6 py-4 text-center shrink-0">
      <button
        onclick="closeJaringanModal()"
        class="px-8 py-2 bg-sky-600 text-white rounded-full
               hover:bg-sky-700 transition">
        Tutup
      </button>
    </div>

  </div>
</div>


<style>
  .milestone-wrapper {
    max-width: 1100px;
    margin: 0 auto;
    padding: 80px 20px;
  }

  .milestone-item {
    display: grid;
    grid-template-columns: 120px 40px 1fr;
    gap: 30px;
    align-items: flex-start;
    margin-bottom: 100px;

    opacity: 0;
    transform: translateY(60px);
    transition: all 0.9s ease;
  }

  .milestone-item.show {
    opacity: 1;
    transform: translateY(0);
  }

  /* YEAR */
  .milestone-year {
    font-size: 32px;
    font-weight: 700;
    color: #0ea5e9;
    text-align: right;
  }

  /* LINE */
  .milestone-line {
    position: relative;
    display: flex;
    justify-content: center;
  }

  .milestone-line::before {
    content: "";
    position: absolute;
    top: 0;
    bottom: -100px;
    width: 3px;
    background: #0ea5e9;
  }

  .milestone-dot {
    width: 14px;
    height: 14px;
    background: #0ea5e9;
    border-radius: 50%;
    margin-top: 10px;
    z-index: 2;
  }

  /* CONTENT */
  .milestone-content {
    display: flex;
    gap: 30px;
    align-items: center;

    opacity: 0;
    transform: translateX(60px) scale(0.95);
    transition: all 0.9s ease 0.2s;
  }

  .milestone-item.show .milestone-content {
    opacity: 1;
    transform: translateX(0) scale(1);
  }

  .milestone-content img {
    width: 220px;
    height: 140px;
    object-fit: cover;
    border-radius: 12px;
  }

  .milestone-content p {
    color: #374151;
    line-height: 1.7;
    max-width: 480px;
  }

  /* RESPONSIVE */
  @media (max-width: 768px) {
    .milestone-item {
      grid-template-columns: 1fr;
    }

    .milestone-year {
      text-align: left;
    }

    .milestone-line {
      display: none;
    }

    .milestone-content {
      flex-direction: column;
      align-items: flex-start;
    }
  }
</style>
<!-- Script Milestone -->
<script>
const milestones = document.querySelectorAll('.milestone-item');

const milestoneObserver = new IntersectionObserver(entries => {
  entries.forEach(entry => {
    if (entry.isIntersecting) {
      entry.target.classList.add('show');
    }
  });
}, {
  threshold: 0.25
});

milestones.forEach(item => milestoneObserver.observe(item));
</script>
<!-- Script Modal Jaringan -->
<script>
  function openJaringanModal() {
    const modal = document.getElementById('jaringanModal');
    const box = document.getElementById('jaringanModalBox');

    modal.classList.remove('hidden');

    setTimeout(() => {
      box.classList.remove('opacity-0', 'scale-95');
      box.classList.add('opacity-100', 'scale-100');
    }, 10);

    document.body.classList.add('overflow-hidden');
  }

  function closeJaringanModal() {
    const modal = document.getElementById('jaringanModal');
    const box = document.getElementById('jaringanModalBox');

    box.classList.add('opacity-0', 'scale-95');
    box.classList.remove('opacity-100', 'scale-100');

    setTimeout(() => {
      modal.classList.add('hidden');
      document.body.classList.remove('overflow-hidden');
    }, 300);
  }
</script>
<!-- Script Modal VSAT -->
<script>
function openVsatModal() {
  const modal = document.getElementById('vsatModal');
  const box   = document.getElementById('vsatModalBox');

  modal.classList.remove('hidden');

  setTimeout(() => {
    box.classList.remove('opacity-0', 'scale-95');
    box.classList.add('opacity-100', 'scale-100');
  }, 50);

  document.body.classList.add('overflow-hidden');
}

function closeVsatModal() {
  const modal = document.getElementById('vsatModal');
  const box   = document.getElementById('vsatModalBox');

  box.classList.add('opacity-0', 'scale-95');

  setTimeout(() => {
    modal.classList.add('hidden');
    document.body.classList.remove('overflow-hidden');
  }, 300);
}
</script>

<script>
function openBasebandModal() {
  const modal = document.getElementById('basebandModal');
  const box = document.getElementById('basebandModalBox');

  modal.classList.remove('hidden');

  setTimeout(() => {
    box.classList.remove('opacity-0', 'scale-95');
    box.classList.add('opacity-100', 'scale-100');
  }, 50);

  document.body.classList.add('overflow-hidden');
}

function closeBasebandModal() {
  const modal = document.getElementById('basebandModal');
  const box = document.getElementById('basebandModalBox');

  box.classList.add('opacity-0', 'scale-95');

  setTimeout(() => {
    modal.classList.add('hidden');
    document.body.classList.remove('overflow-hidden');
  }, 300);
}
</script>
<script>
  document.querySelectorAll("details").forEach((targetDetail) => {
    targetDetail.addEventListener("toggle", () => {
      if (targetDetail.open) {
        document.querySelectorAll("details").forEach((detail) => {
          if (detail !== targetDetail && detail.open) {
            detail.removeAttribute("open");
          }
        });
      }
    });
  });
</script>
<script>
  const menuToggle = document.getElementById('menu-toggle');
  const mobileMenu = document.getElementById('mobile-menu');
  const dropdown = document.getElementById('dropdown-layanan');

  menuToggle.addEventListener('click', () => {
    mobileMenu.classList.toggle('hidden');
  });

  function toggleDropdown() {
    dropdown.classList.toggle('hidden');
  }
</script>
<!-- Script Modal -->
<script>
  function openModal() {
    document.getElementById('modalTentang').classList.remove('hidden');
  }

  function closeModal() {
    document.getElementById('modalTentang').classList.add('hidden');
  }
</script>
<!-- Tambahan Animasi -->
<style>
  @keyframes fade-in-up {
    from {
      opacity: 0;
      transform: translateY(20px);
    }
    to {
      opacity: 1;
      transform: translateY(0);
    }
  }

  .animate-fade-in-up {
    animation: fade-in-up 1.2s ease-out both;
  }

  .fade-in-up {
    animation: fade-in-up 0.6s ease-out both;
  }
</style>
<script>
  function showLayanan(id) {
    const items = document.querySelectorAll('.layanan-item');

    items.forEach(item => {
      item.classList.add('hidden');
      item.classList.remove('animate-slide-in');
    });

    const selected = document.getElementById(id);
    if (selected) {
      selected.classList.remove('hidden');
      selected.classList.add('animate-slide-in');
    }

    // Optional: scroll ke bagian section layanan
    document.getElementById('layanan').scrollIntoView({ behavior: 'smooth' });
  }
</script>
  <!-- Tombol Scroll -->
  <script>
    function scrollGallery(direction) {
      const container = document.getElementById('galleryContainer');
      const scrollAmount = 300; // px
      container.scrollBy({
        left: direction * scrollAmount,
        behavior: 'smooth'
      });
    }
  </script>
<script>
  function updateNavbarTextColor() {
    const sections = document.querySelectorAll("section");
    const navLinks = document.querySelectorAll("#menu a");
    const scrollPos = window.scrollY + 80; // tambahkan offset sedikit untuk toleransi

    sections.forEach(section => {
      const rect = section.getBoundingClientRect();
      const top = rect.top + window.scrollY;
      const bottom = top + section.offsetHeight;

      if (scrollPos >= top && scrollPos < bottom) {
        // Ambil class dari section
        const isDark = section.classList.contains("bg-black") || section.classList.contains("text-white");
        
        navLinks.forEach(link => {
          link.classList.remove("text-white", "text-black");
          if (isDark) {
            link.classList.add("text-white");
          } else {
            link.classList.add("text-black");
          }
        });
      }
    });
  }

  window.addEventListener("DOMContentLoaded", updateNavbarTextColor);
  window.addEventListener("scroll", updateNavbarTextColor);
  window.addEventListener("resize", updateNavbarTextColor);
</script>
<script>
  const menuToggle = document.getElementById('menu-toggle');
  const menu = document.getElementById('menu');

  menuToggle.addEventListener('click', () => {
    menu.classList.toggle('hidden');
  });
</script>
  <script>
    window.addEventListener('scroll', function() {
      const navbar = document.getElementById('navbar');
      if (window.scrollY > 50) {
        navbar.classList.add('scrolled');
      } else {
        navbar.classList.remove('scrolled');
      }
    });
  </script>
  <script>
  window.addEventListener("DOMContentLoaded", () => {
    const footerItems = document.querySelectorAll(".footer-animate");

    footerItems.forEach((item, index) => {
      setTimeout(() => {
        item.classList.add("visible");
      }, index * 400); // delay antar item: 400ms
    });
  });
</script>
<script>
  document.addEventListener("DOMContentLoaded", () => {
    const observer = new IntersectionObserver((entries) => {
      entries.forEach((entry) => {
        if (entry.isIntersecting) {
          entry.target.classList.add("visible");
        }
      });
    }, { threshold: 0.2 });

    const paragraphs = document.querySelectorAll("#tentang p");
    paragraphs.forEach((p, i) => {
      if (i % 2 === 0) {
        p.classList.add("fade-in-left");
      } else {
        p.classList.add("fade-in-right");
      }
      observer.observe(p);
    });
  });
</script>
<script>
  document.addEventListener("DOMContentLoaded", () => {
    const observer = new IntersectionObserver((entries) => {
      entries.forEach((entry) => {
        if (entry.isIntersecting) {
          entry.target.classList.add("visible");
        }
      });
    }, { threshold: 0.2 });

    // Tentang Kami
    const paragraphs = document.querySelectorAll("#tentang p");
    paragraphs.forEach((p, i) => {
      if (i % 2 === 0) {
        p.classList.add("fade-in-left");
      } else {
        p.classList.add("fade-in-right");
      }
      observer.observe(p);
    });

    // VISI box (fade-in-up optional kalau mau)
    const visiBox = document.querySelector("#visimisi .bg-sky-500");
    if (visiBox) {
      visiBox.classList.add("fade-in-up");// atau fade-in-up
      observer.observe(visiBox);
    }

    // Misi list (selang-seling)
    const misiItems = document.querySelectorAll("#visimisi ul li");
    misiItems.forEach((li, i) => {
      if (i % 2 === 0) {
        li.classList.add("fade-in-left");
      } else {
        li.classList.add("fade-in-right");
      }
      observer.observe(li);
    });
  });
</script>
<script>
document.addEventListener("DOMContentLoaded", () => {
  const observer = new IntersectionObserver((entries) => {
    entries.forEach((entry) => {
      if (entry.isIntersecting) {
        entry.target.classList.add("visible");
      }else {
  entry.target.classList.remove("visible"); // supaya animasi bisa reset
}
    });
  }, { threshold: 0.15 });

  // Tangkap semua layanan (grid item dalam section #layanan)
  const layananItems = document.querySelectorAll("#layanan .grid > div");

  layananItems.forEach((item, index) => {
    const animationClass = index % 2 === 0 ? "fade-in-left" : "fade-in-right";
    item.classList.add(animationClass);
    observer.observe(item);
  });
});
</script>
<script>
document.addEventListener("DOMContentLoaded", () => {
  const observer = new IntersectionObserver(entries => {
    entries.forEach(entry => {
      if (entry.isIntersecting) {
        entry.target.classList.add('visible');
      }else {
  entry.target.classList.remove("visible"); // supaya animasi bisa reset
}
    });
  }, { threshold: 0.1 });

  const strategiItems = document.querySelectorAll("#strategi ul li");
  const kebijakanItems = document.querySelectorAll("#kebijakan ul li");

  [...strategiItems].forEach((item, i) => {
    const anim = i % 2 === 0 ? "fade-in-left" : "fade-in-right";
    item.classList.add(anim);
    observer.observe(item);
  });

  [...kebijakanItems].forEach((item, i) => {
    const anim = i % 2 === 0 ? "fade-in-left" : "fade-in-right";
    item.classList.add(anim);
    observer.observe(item);
  });
});
</script>
<script>
document.addEventListener("DOMContentLoaded", () => {
  const observer = new IntersectionObserver(entries => {
    entries.forEach(entry => {
      if (entry.isIntersecting) {
        entry.target.classList.add('visible');
      }
      else {
  entry.target.classList.remove("visible"); // supaya animasi bisa reset
}
    });
  }, { threshold: 0.1 });

  const animateStagger = (selector) => {
    const items = document.querySelectorAll(selector);
    items.forEach((item, i) => {
      const animClass = i % 2 === 0 ? "fade-in-left" : "fade-in-right";
      item.classList.add(animClass);
      item.style.transitionDelay = `${i * 0.2}s`;
      observer.observe(item);
    });
  };

  // ✨ Fade-in atas-bawah untuk heading dan paragraf utama
  const headerText = document.querySelectorAll("#kebijakan h2, #kebijakan > p");
  headerText.forEach((el, i) => {
    el.classList.add("fade-in-down");
    el.style.transitionDelay = `${i * 0.2}s`;
    observer.observe(el);
  });

  // ✨ Fade-in selang seling untuk <li>
  animateStagger("#kebijakan ul li");
  animateStagger("#strategi ul li");
});
</script>
<script>
document.addEventListener("DOMContentLoaded", () => {
  const observer = new IntersectionObserver((entries) => {
    entries.forEach(entry => {
      if (entry.isIntersecting) {
        entry.target.classList.add('visible');
      } else {
        entry.target.classList.remove('visible'); // reset animasi jika keluar viewport
      }
    });
  }, { threshold: 0.1 });

  const animateStagger = (selector) => {
    const items = document.querySelectorAll(selector);
    items.forEach((item, i) => {
      const animClass = i % 2 === 0 ? "fade-in-left" : "fade-in-right";
      item.classList.add(animClass);
      item.style.transitionDelay = `${i * 0.1}s`;
      observer.observe(item);
    });
  };

  // Section: TENTANG
  animateStagger("#tentang p");

  // Section: VISI & MISI
  const visiBox = document.querySelector("#visimisi .bg-sky-500");
  if (visiBox) {
    visiBox.classList.add("fade-in-up");
    observer.observe(visiBox);
  }
  animateStagger("#visimisi ul li");

  // Section: LAYANAN
  animateStagger("#layanan .grid > div");

  // Section: STRATEGI & KEBIJAKAN
  animateStagger("#strategi ul li");
  animateStagger("#kebijakan ul li");

  const kebijakanHeader = document.querySelectorAll("#kebijakan h2, #kebijakan > p");
  kebijakanHeader.forEach((el, i) => {
    el.classList.add("fade-in-down");
    el.style.transitionDelay = `${i * 0.2}s`;
    observer.observe(el);
  });

  // Footer animasi
  const footerItems = document.querySelectorAll(".footer-animate");
  footerItems.forEach((item, i) => {
    item.style.transitionDelay = `${i * 0.2}s`;
    item.classList.add("fade-in-left"); // bisa ganti ke slide-in
    observer.observe(item);
  });
});
</script>
<script>
document.addEventListener("DOMContentLoaded", () => {
  const observer = new IntersectionObserver(entries => {
    entries.forEach(entry => {
      if (entry.isIntersecting) {
        entry.target.classList.add('visible');
      } else {
        entry.target.classList.remove('visible'); // reset animasi
      }
    });
  }, { threshold: 0.2 });

  // ➤ Animasi untuk bagian #beranda (Hero Section)
  const berandaElements = document.querySelectorAll("#beranda h1, #beranda p");
  berandaElements.forEach((el, i) => {
    el.classList.add("fade-in-up");
    el.style.transitionDelay = `${i * 0.2}s`;
    observer.observe(el);
  });
});
</script>
<script>
/* Navbar scroll effect */
const navbar = document.getElementById('navbar');

window.addEventListener('scroll', () => {
  if (window.scrollY > 40) {
    navbar.classList.add('scrolled');
  } else {
    navbar.classList.remove('scrolled');
  }
});

/* Dropdown hover */
(function () {
  const wrapper = document.getElementById('layananDropdown');
  const menu = document.getElementById('layananMenu');
  let hideTimeout;

  if (!wrapper || !menu) return;

  const showMenu = () => {
    clearTimeout(hideTimeout);
    menu.classList.remove('hidden');
    menu.classList.add('flex');
  };

  const hideMenu = () => {
    hideTimeout = setTimeout(() => {
      menu.classList.add('hidden');
      menu.classList.remove('flex');
    }, 200);
  };

  wrapper.addEventListener('mouseenter', showMenu);
  wrapper.addEventListener('mouseleave', hideMenu);

  menu.addEventListener('mouseenter', () => clearTimeout(hideTimeout));
  menu.addEventListener('mouseleave', hideMenu);
})();

/* Mobile menu toggle */
document.getElementById('menu-toggle').addEventListener('click', () => {
  document.getElementById('mobile-menu').classList.toggle('hidden');
});
</script>
<!-- Dropdown dengan animasi -->
<script>
(function () {
  const wrapper = document.getElementById('layananDropdown');
  const menu = document.getElementById('layananMenu');
  const arrow = document.getElementById('layananArrow');
  let hideTimeout;

  const showMenu = () => {
    clearTimeout(hideTimeout);
    menu.classList.remove('hidden');
    menu.classList.add('flex');
    requestAnimationFrame(() => {
      menu.classList.add('dropdown-show');
    });
    arrow.classList.add('rotate');
  };

  const hideMenu = () => {
    hideTimeout = setTimeout(() => {
      menu.classList.remove('dropdown-show');
      arrow.classList.remove('rotate');
      setTimeout(() => {
        menu.classList.add('hidden');
        menu.classList.remove('flex');
      }, 200);
    }, 150);
  };

  wrapper.addEventListener('mouseenter', showMenu);
  wrapper.addEventListener('mouseleave', hideMenu);
})();
</script>

<!-- Tombol WhatsApp -->
<a href="https://wa.me/6281332809923?text=Halo%2C%20saya%20tertarik%20dengan%20layanan%20undangan%20digital%20yang%20Anda%20tawarkan.%20Boleh%20saya%20minta%20informasi%20lebih%20lanjut%20terkait%20paket%2C%20fitur%2C%20dan%20cara%20pemesanan%3F%20Terima%20kasih. " target="_blank"
   class="fixed bottom-6 right-6 z-50 bg-green-500 hover:bg-green-600 text-white rounded-full p-4 shadow-lg flex items-center space-x-2 transition-all duration-300">
  <!-- Ikon WhatsApp -->
  <svg class="w-6 h-6 fill-current" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 32 32">
    <path d="M16.001 3C9.374 3 4 8.374 4 15.001c0 2.646.99 5.072 2.615 6.957L4 29l7.28-2.56A11.956 11.956 0 0 0 16 27c6.627 0 12-5.373 12-11.999S22.627 3 16.001 3zm0 22c-1.484 0-2.891-.373-4.125-1.033l-.29-.162-4.336 1.524 1.478-4.214-.186-.3a8.953 8.953 0 0 1-1.542-5.019c0-4.962 4.037-9 9-9 4.961 0 9 4.038 9 9s-4.039 9-9 9zm5.533-6.529c-.306-.154-1.801-.889-2.08-.991-.278-.102-.48-.153-.683.154-.202.306-.784.991-.961 1.193-.177.202-.355.229-.66.076-.305-.152-1.29-.475-2.455-1.516-.906-.807-1.516-1.802-1.693-2.107-.177-.306-.018-.471.135-.623.138-.138.305-.354.457-.531.152-.178.203-.305.305-.509.101-.203.05-.381-.025-.533-.076-.152-.683-1.646-.935-2.25-.245-.59-.494-.51-.683-.52-.178-.01-.381-.012-.584-.012s-.533.076-.813.38c-.278.305-1.066 1.04-1.066 2.531 0 1.491 1.092 2.932 1.244 3.134.152.203 2.149 3.275 5.209 4.592.728.313 1.296.5 1.738.64.73.232 1.394.2 1.919.122.585-.087 1.801-.735 2.057-1.447.253-.71.253-1.319.177-1.447-.076-.127-.278-.202-.584-.355z"/>
  </svg>
  <span class="hidden sm:inline font-semibold">Live Chat</span>
</a>
</body>
</html>
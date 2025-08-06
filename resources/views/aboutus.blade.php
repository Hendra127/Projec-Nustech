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
  #navbar {
    font-family: -apple-system, BlinkMacSystemFont, 'San Francisco', 'Segoe UI', Roboto, Helvetica, Arial, sans-serif;
    font-weight: 400 !important;
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
  <!-- Navbar -->
<!-- NAVBAR -->
<nav id="navbar" class="fixed top-0 right-0 left-0 bg-transparent bg-opacity-90 z-50 w-full "
  style="font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Helvetica, Arial, sans-serif;">
  <div class="px-4 sm:px-6 lg:px-8">
    <div class="flex justify-between items-center h-16">

      <!-- Logo -->
      <div class="text-sky-500 text-xl font-bold">
        <a href="#"></a>
      </div>

      <!-- Hamburger (Mobile) -->
      <div class="md:hidden">
        <button id="menu-toggle" class="text-sky-500 focus:outline-none">
          <svg class="w-6 h-6" fill="none" stroke="currentColor" stroke-width="2"
            viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
            <path stroke-linecap="round" stroke-linejoin="round" d="M4 6h16M4 12h16M4 18h16" />
          </svg>
        </button>
      </div>

      <!-- Menu Desktop -->
      <div class="hidden md:flex items-center space-x-6 text-black font-medium">
        <a href="#beranda" class="hover:text-sky-500">Beranda</a>
        <a href="#tentang" class="hover:text-sky-500">Tentang Kami</a>
        <a href="#visimisi" class="hover:text-sky-500">Visi Misi</a>

        <!-- Dropdown Layanan -->
        <div class="relative group">
          <a class="hover:text-sky-500 cursor-pointer">Layanan</a>
          <div class="absolute left-0 mt-2 hidden group-hover:flex flex-col bg-white text-black shadow-lg rounded-md min-w-[200px] z-50">
            <button onclick="showLayanan('networking')" class="text-left px-4 py-2 hover:bg-sky-100">Networking</button>
            <button onclick="showLayanan('aplikasi')" class="text-left px-4 py-2 hover:bg-sky-100">Aplikasi</button>
            <button onclick="showLayanan('reklame')" class="text-left px-4 py-2 hover:bg-sky-100">Reklame</button>
            <button onclick="showLayanan('kelistrikan')" class="text-left px-4 py-2 hover:bg-sky-100">Kelistrikan</button>
            <button onclick="showLayanan('ac')" class="text-left px-4 py-2 hover:bg-sky-100">Sistem Pendingin</button>
            <button onclick="showLayanan('komputer')" class="text-left px-4 py-2 hover:bg-sky-100">Komputer & Printer</button>
            <button onclick="showLayanan('elektronik')" class="text-left px-4 py-2 hover:bg-sky-100">Elektronik</button>
            <button onclick="showLayanan('kantor')" class="text-left px-4 py-2 hover:bg-sky-100">Alat Kantor</button>
          </div>
        </div>

        <a href="#strategi" class="hover:text-sky-500">Strategi</a>
        <a href="#kebijakan" class="hover:text-sky-500">Kebijakan</a>
        <a href="#gallery" class="hover:text-sky-500">Galeri</a>
      </div>
    </div>
  </div>

  <!-- Menu Mobile -->
  <div id="mobile-menu" class="md:hidden hidden flex-col bg-white text-black font-medium space-y-2 px-4 pt-4 pb-6">
    <a href="#beranda" class="hover:text-sky-500">Beranda</a>
    <a href="#tentang" class="hover:text-sky-500">Tentang Kami</a>
    <a href="#visimisi" class="hover:text-sky-500">Visi Misi</a>

    <!-- Dropdown Layanan Mobile -->
    <div>
      <button onclick="toggleDropdown()" class="w-full text-left hover:text-sky-500">Layanan ▼</button>
      <div id="dropdown-layanan" class="hidden flex-col pl-4 pt-2 space-y-2">
        <button onclick="showLayanan('networking')" class="text-left hover:text-sky-500">Networking</button>
        <button onclick="showLayanan('aplikasi')" class="text-left hover:text-sky-500">Aplikasi</button>
        <button onclick="showLayanan('reklame')" class="text-left hover:text-sky-500">Reklame</button>
        <button onclick="showLayanan('kelistrikan')" class="text-left hover:text-sky-500">Kelistrikan</button>
        <button onclick="showLayanan('ac')" class="text-left hover:text-sky-500">Sistem Pendingin</button>
        <button onclick="showLayanan('komputer')" class="text-left hover:text-sky-500">Komputer & Printer</button>
        <button onclick="showLayanan('elektronik')" class="text-left hover:text-sky-500">Elektronik</button>
        <button onclick="showLayanan('kantor')" class="text-left hover:text-sky-500">Alat Kantor</button>
      </div>
    </div>

    <a href="#strategi" class="hover:text-sky-500">Strategi</a>
    <a href="#kebijakan" class="hover:text-sky-500">Kebijakan</a>
    <a href="#gallery" class="hover:text-sky-500">Galeri</a>
  </div>
</nav>

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

  <!-- Logo -->
  <div class="fixed top-6 left-6 z-50" style="width: 60px; height: 60px;">
    <a href="{{ route('landingpage') }}">
      <img src="{{ asset('assets/img/logonustech.png') }}" alt="nustech logo"
           class="nav-link btn {{ request()->routeIs('landingpage') ? 'btn-primary active' : 'btn-outline-primary' }}">
    </a>
  </div>

  <!-- Konten utama -->
  <div class="relative z-20 text-center px-4 animate-fade-in-up">
    <h1 class="mb-4 text-4xl md:text-5xl font-bold"
        style="font-family: -apple-system, BlinkMacSystemFont, 'San Francisco', 'Segoe UI', Roboto, Helvetica, Arial, sans-serif; color: #B12C00">
      CV. NUSTECH
    </h1>
    <p class="mt-4 text-lg md:text-xl text-black fade-in-up"
       style="font-family: -apple-system, BlinkMacSystemFont, 'San Francisco', 'Segoe UI', Roboto, Helvetica, Arial, sans-serif;">
      Solusi Teknologi Informasi dan Komunikasi
    </p>
  </div>
</section>

<!-- TENTANG KAMI SECTION -->
<section id="tentang" class="w-full min-h-screen flex flex-col lg:flex-row items-center justify-between px-0 py-20 bg-white">
  <!-- Kiri -->
  <div class="w-full lg:w-1/2 px-10 lg:px-20">
    <h2 class="text-4xl font-bold mb-6 leading-snug">
      Ini Tentang <span class="text-orange-600">Kami,</span> <span class="text-orange-400">Jagonya</span> <span class="text-gray-900">Teknologi Informasi</span>
    </h2>
    <p class="text-gray-600 mb-4 text-base leading-relaxed">
      Kami telah menjadi partner puluhan ribu pelanggan untuk mewujudkan apa yang mereka inginkan dengan solusi yang kami berikan dengan pengalaman yang luas dalam berbagai macam bidang...
    </p>
    <button onclick="openModal()"
      class="border border-gray-400 text-sm px-5 py-2 rounded-full hover:bg-gray-100 transition-all cursor-pointer">
      Pelajari Selengkapnya
    </button>
  </div>

  <!-- Kanan -->
  <div class="relative w-full lg:w-1/2 px-10 lg:px-20 mt-8 lg:mt-0 z-10">
    <img src="assets/img/tentangkami.png" alt="tentang kami" class="w-full h-auto -mt-24"/>
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
  <h2 class="text-4xl font-bold text-center text-black mb-16 animate-fade-in-down px-4 md:px-8">Tujuan Kami Untuk Anda</h2>

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
  <h2 class="text-4xl font-bold text-sky-500 mb-12 text-end px-4 md:px-8">Layanan</h2>

  <!-- Container -->
  <div class="flex flex-col lg:flex-row gap-12 px-4 md:px-8 xl:px-20 items-start">

    <!-- Kiri -->
    <div class="w-full lg:w-1/2 space-y-10 text-black text-base">

        <!-- 1. Networking -->
        <div id="networking" class="layanan-item hidden">
          <h3 class="text-2xl font-semibold mb-3">Instalasi & Pemeliharaan Jaringan (Networking)</h3>
          <ul class="list-disc list-inside text-justify space-y-1">
            <li>Instalasi dan maintenance jaringan komputer</li>
            <li>Pemasangan dan perawatan jaringan VSAT</li>
            <li>Pemasangan Baseband (BB) Tower</li>
            <li>Instalasi dan pemeliharaan sistem CCTV</li>
          </ul>
          <div class="mt-4">
            <a href="https://wa.me/6281332809923?text=Halo%2C%20saya%20tertarik%20dengan%20layanan%20Anda" target="_blank"
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
            <a href="https://wa.me/6281332809923?text=Halo%2C%20saya%20tertarik%20dengan%20layanan%20Anda" target="_blank"
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
            <a href="https://wa.me/6281332809923?text=Halo%2C%20saya%20tertarik%20dengan%20layanan%20Anda" target="_blank"
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
            <a href="https://wa.me/6281332809923?text=Halo%2C%20saya%20tertarik%20dengan%20layanan%20Anda" target="_blank"
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
            <a href="https://wa.me/6281332809923?text=Halo%2C%20saya%20tertarik%20dengan%20layanan%20Anda" target="_blank"
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
            <a href="https://wa.me/6281332809923?text=Halo%2C%20saya%20tertarik%20dengan%20layanan%20Anda" target="_blank"
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
            <a href="https://wa.me/6281332809923?text=Halo%2C%20saya%20tertarik%20dengan%20layanan%20Anda" target="_blank"
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
            <a href="https://wa.me/6281332809923?text=Halo%2C%20saya%20tertarik%20dengan%20layanan%20Anda" target="_blank"
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
              <p>Atur sistem CCTV, jaringan internet, dan AC hanya dalam satu langkah bersama kami. Dengan konfigurasi otomatis dan dukungan teknisi profesional, sistem Anda akan selalu optimal di berbagai kondisi — dari kantor pemerintahan hingga resort di Gili.</p>
            </div>
          </details>
          <details class="group text-left cursor-pointer mt-4">
            <summary class="flex justify-between items-center font-semibold text-xl">
              <span> Koneksi Stabil, Instalasi Andal</span>
              <span class="transform group-open:rotate-90 transition-transform duration-300 text-2xl">&gt;</span>
            </summary>
            <div class="mt-3 text-gray-700">
              <p>Kami menghadirkan jaringan internet Point-to-Point dan instalasi CCTV terkini yang siap pakai tanpa ribet. Semuanya didesain untuk bekerja maksimal di segala lokasi — dari pusat kota hingga daerah terpencil.</p>
            </div>
          </details>
          <details class="group text-left cursor-pointer mt-4">
            <summary class="flex justify-between items-center font-semibold text-xl">
              <span> Nyaman & Aman Sepanjang Hari</span>
              <span class="transform group-open:rotate-90 transition-transform duration-300 text-2xl">&gt;</span>
            </summary>
            <div class="mt-3 text-gray-700">
              <p>Dari AC yang selalu dingin hingga CCTV yang aktif 24 jam, semua dirancang untuk memberi Anda kenyamanan dan keamanan penuh. Teknisi kami siap menjaga sistem Anda tetap optimal tanpa gangguan.</p>
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
    <h2 class="text-3xl md:text-5xl font-bold mb-10 text-center text-gray-800" style="font-family: quicksand, sans-serif;">
      Galeri Foto
    </h2>

    <!-- Galeri Gambar -->
    <div id="galleryContainer" class="flex gap-6 overflow-x-auto scroll-smooth snap-x snap-mandatory">
      <!-- Gambar-gambar tetap seperti aslinya -->
      <a href="#" class="flex-shrink-0 w-64 snap-start rounded-lg shadow-lg group block">
        <img src="{{ asset('assets/img/ac.jpg') }}" alt="AC" class="w-full h-64 object-cover rounded-lg transition-transform duration-300 group-hover:scale-110">
      </a>

      <a href="#" class="flex-shrink-0 w-64 snap-start rounded-lg shadow-lg group block">
        <img src="{{ asset('assets/img/starlink.jpg') }}" alt="Starlink" class="w-full h-64 object-cover rounded-lg transition-transform duration-300 group-hover:scale-110">
      </a>

      <a href="#" class="flex-shrink-0 w-64 snap-start rounded-lg shadow-lg group block">
        <img src="{{ asset('assets/img/vsat.jpg') }}" alt="VSAT" class="w-full h-64 object-cover rounded-lg transition-transform duration-300 group-hover:scale-110">
      </a>

      <a href="#" class="flex-shrink-0 w-64 snap-start rounded-lg shadow-lg group block">
        <img src="{{ asset('assets/img/vsatatm.jpg') }}" alt="VSAT ATM" class="w-full h-64 object-cover rounded-lg transition-transform duration-300 group-hover:scale-110">
      </a>

      <a href="#" class="flex-shrink-0 w-64 snap-start rounded-lg shadow-lg group block">
        <img src="{{ asset('assets/img/printer.jpg') }}" alt="Printer" class="w-full h-64 object-cover rounded-lg transition-transform duration-300 group-hover:scale-110">
      </a>

      <a href="#" class="flex-shrink-0 w-64 snap-start rounded-lg shadow-lg group block">
        <img src="{{ asset('assets/img/foto2.jpg') }}" alt="Foto 2" class="w-full h-64 object-cover rounded-lg transition-transform duration-300 group-hover:scale-110">
      </a>

      <a href="#" class="flex-shrink-0 w-64 snap-start rounded-lg shadow-lg group block">
        <img src="{{ asset('assets/img/serviceac.jpg') }}" alt="Service AC" class="w-full h-64 object-cover rounded-lg transition-transform duration-300 group-hover:scale-110">
      </a>

      <a href="#" class="flex-shrink-0 w-64 snap-start rounded-lg shadow-lg group block">
        <img src="{{ asset('assets/img/foto3.jpg') }}" alt="Foto 3" class="w-full h-64 object-cover rounded-lg transition-transform duration-300 group-hover:scale-110">
      </a>
    </div>

    <!-- Tombol Navigasi -->
    <div class="flex justify-end gap-4 mt-4">
      <button onclick="scrollGallery(-1)" class="w-10 h-10 rounded-full bg-gray-200 hover:bg-gray-300 flex items-center justify-center shadow-md">
        &#8592;
      </button>
      <button onclick="scrollGallery(1)" class="w-10 h-10 rounded-full bg-gray-200 hover:bg-gray-300 flex items-center justify-center shadow-md">
        &#8594;
      </button>
    </div>
  </div>
</section>

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
          <a href="https://www.instagram.com/nustech.co.id/" target="_blank" class="hover:underline text-black hover:text-100">
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
<!-- Tombol WhatsApp -->
<a href="https://wa.me/6281332809923?text=Halo%2C%20saya%20tertarik%20dengan%20layanan%20Anda" target="_blank"
   class="fixed bottom-6 right-6 z-50 bg-green-500 hover:bg-green-600 text-white rounded-full p-4 shadow-lg flex items-center space-x-2 transition-all duration-300">
  <!-- Ikon WhatsApp -->
  <svg class="w-6 h-6 fill-current" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 32 32">
    <path d="M16.001 3C9.374 3 4 8.374 4 15.001c0 2.646.99 5.072 2.615 6.957L4 29l7.28-2.56A11.956 11.956 0 0 0 16 27c6.627 0 12-5.373 12-11.999S22.627 3 16.001 3zm0 22c-1.484 0-2.891-.373-4.125-1.033l-.29-.162-4.336 1.524 1.478-4.214-.186-.3a8.953 8.953 0 0 1-1.542-5.019c0-4.962 4.037-9 9-9 4.961 0 9 4.038 9 9s-4.039 9-9 9zm5.533-6.529c-.306-.154-1.801-.889-2.08-.991-.278-.102-.48-.153-.683.154-.202.306-.784.991-.961 1.193-.177.202-.355.229-.66.076-.305-.152-1.29-.475-2.455-1.516-.906-.807-1.516-1.802-1.693-2.107-.177-.306-.018-.471.135-.623.138-.138.305-.354.457-.531.152-.178.203-.305.305-.509.101-.203.05-.381-.025-.533-.076-.152-.683-1.646-.935-2.25-.245-.59-.494-.51-.683-.52-.178-.01-.381-.012-.584-.012s-.533.076-.813.38c-.278.305-1.066 1.04-1.066 2.531 0 1.491 1.092 2.932 1.244 3.134.152.203 2.149 3.275 5.209 4.592.728.313 1.296.5 1.738.64.73.232 1.394.2 1.919.122.585-.087 1.801-.735 2.057-1.447.253-.71.253-1.319.177-1.447-.076-.127-.278-.202-.584-.355z"/>
  </svg>
  <span class="hidden sm:inline font-semibold">Live Chat</span>
</a>
</body>
</html>
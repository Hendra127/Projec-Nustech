<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Landing Page Nustech</title>
  <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet" />
  <style>
    #bgImage {
      position: fixed;
      top: 0;
      left: 0;
      width: 100vw;
      height: 100vh;
      object-fit: cover;
      z-index: -1;
      filter: brightness(0.7);
    }

    /* Animasi Fade-in */
    @keyframes fadeIn {
      from { opacity: 0; transform: translateY(20px); }
      to { opacity: 1; transform: translateY(0); }
    }

    .fade-in {
      animation: fadeIn 1s ease-out both;
    }
  </style>
</head>
<body class="relative min-h-screen flex flex-col justify-center items-center px-4 text-gray-100 text-center">

  <!-- Background Image -->
  <img id="bgImage" src="https://drive.google.com/thumbnail?id=11YNHU05870OEPhEZWCBaBlcWv9p_Lbfq" alt="Background" />

  <!-- Konten -->
  <div class="max-w-3xl px-4 py-8 fade-in">
    <h1 class="text-3xl md:text-5xl font-bold mb-4">
      SELAMAT DATANG DI WEBSITE NUSTECH
    </h1>
    <p class="text-lg md:text-xl">
      Sistem Manajemen Data Site & Tiket Pemeliharaan VSAT BAKTI KOMINFO
    </p>
  </div>

  <footer class="mt-16 text-sm text-gray-300 fade-in" style="animation-delay: 0.5s;">
    &copy; <script>document.write(new Date().getFullYear())</script> Nustech Indonesia. All rights reserved.
  </footer>

</body>
</html>

@extends('layouts.user_type.auth')

@section('content')
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />

<style>
  body {
    background: linear-gradient(to bottom right, rgb(209, 215, 231), rgb(134, 173, 229));
    min-height: 100vh;
  }

  /* Scrollbar untuk timeline open tiket */
  .timeline {
    max-height: 250px;
    overflow-y: auto;
  }

  .map-responsive {
    position: relative;
    padding-bottom: 56.25%;
    padding-top: 30px;
    height: 0;
    overflow: hidden;
  }
  .map-responsive iframe {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    border: 0;
  }
  /* RESPONSIVE FIX: Data Open Tiket & Grafik Line di tablet/HP */
  @media (max-width: 991.98px) {
    .row.mt-4.g-3 > .col-12 {
      max-width: 100% !important;
      flex: 0 0 100% !important;
    }
    .card.h-100.d-flex.flex-column {
      height: auto !important;
    }
    .timeline {
      max-height: 120px !important;
    }
    .chart.flex-grow-1 {
      max-height: 150px !important;
    }
    #chart-line {
      height: 150px !important;
    }
  }
   /* CSS Flex Horizontal untuk Card */
  .scrollable-cards {
    display: flex;
    flex-wrap: nowrap;
    overflow-x: auto;
    gap: 16px;
    padding-bottom: 8px;
  }

  .scrollable-cards .card {
    flex: 0 0 auto;
    width: 250px;
    min-width: 220px;
    border-radius: 15px;
  }

  /* Tambahan opsional untuk tampilan smooth */
  .scrollable-cards::-webkit-scrollbar {
    height: 6px;
  }

  .scrollable-cards::-webkit-scrollbar-thumb {
    background-color: #aaa;
    border-radius: 5px;
  }
</style>
<style>
  .btn-custom {
    font-size: 0.75rem;
    padding: 0.3rem 1rem;           /* <--- ini yang bikin lebih kecil */
    border-radius: 12px;
    transition: all 0.2s ease-in-out;
  }

  .btn-inactive {
    background-color: transparent;
    border: 2px solid #c026d3;
    color: black;
  }

  .btn-active {
    background-color: #22c55e;
    color: black;
    border: 2px solid #22c55e;
  }

  .btn-inactive:hover {
    background-color: #f0f0f0;
  }
</style>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" />
<!-- Tombol Operasional -->
<div class="d-flex justify-content-center align-items-center mb-3" style="position: absolute; top: 10px; left: 50%; transform: translateX(-50%); z-index: 10;">
  <a href="#" data-bs-toggle="modal" data-bs-target="#operasionalModal" style="text-decoration: none; color: #000;">
    <h6 class="mb-0"><strong>Operasional</strong></h6>
  </a>
</div>

<!-- Modal Operasional -->
<div class="modal fade" id="operasionalModal" tabindex="-1" aria-labelledby="operasionalModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content" style="border: none;">
            <div class="modal-header">
                <div class="w-100 text-center mt-2 ">
                    <h5 class="modal-title" id="operasionalModalLabel">Daftar Halaman Operasional</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Tutup"></button>
                </div>
            </div>
            <div class="modal-body">
                <div class="d-flex flex-wrap gap-3 justify-content-start ps-6" style="flex-wrap: wrap;">
                    <div style="min-width: 200px;">
                        <div class="fw-bold mb-1">Data Site</div>
                        <div class="ms-2 mb-2">
                            <a href="{{ url('datapass') }}" class="text-decoration-none">Manajemen Password</a>
                        </div>
                    </div>
                    <div style="min-width: 200px;">
                        <div class="fw-bold mb-1">Tiket</div>
                        <div class="ms-2 mb-2">
                            <a href="{{ url('tiket') }}" class="text-decoration-none d-block">Open Tiket</a>
                            <a href="{{ url('close/tiket') }}" class="text-decoration-none d-block">Close Tiket</a>
                            <a href="{{ url('dashboard') }}" class="text-decoration-none d-block">Detail Tiket</a>
                        </div>
                    </div>
                    <div style="min-width: 200px;">
                        <div class="fw-bold mb-1">Log Perangkat</div>
                        <div class="ms-2 mb-2">
                            <a href="{{ url('log_perangkat') }}" class="text-decoration-none d-block">Log Perangkat</a>
                            <a href="{{ url('sparetracker') }}" class="text-decoration-none d-block">Spare Tracker</a>
                        </div>
                    </div>
                    <div style="min-width: 200px;">
                        <div class="fw-bold mb-1">Download</div>
                        <div class="ms-2 mb-2">
                            <a href="{{ url('download_file') }}" class="text-decoration-none d-block">Download File</a>
                        </div>
                    </div>
                    <div style="min-width: 200px;">
                        <div class="fw-bold mb-1">Rekap SLA</div>
                        <div class="ms-2 mb-2">
                            <a href="{{ url('rekap-bmn') }}" class="text-decoration-none d-block">BMN</a>
                            <a href="{{ url('rekap-sl') }}" class="text-decoration-none d-block">SL</a>
                        </div>
                    </div>
                    <div style="min-width: 200px;">
                        <div class="fw-bold mb-1">To Do List</div>
                        <div class="ms-2 mb-2">
                            <a href="{{ url('my-todolist') }}" class="text-decoration-none d-block">My Todo list</a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer justify-content-end" style="border-top: none;">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" style="position: absolute; top: 10px; right: 10px; filter: invert(1);"></button></div>
        </div>
    </div>
</div>
<main class="main-content position-relative max-height-vh-100 h-100 mt-1 border-radius-lg">
    <div class="content">
        <div class="container-fluid py-4">
            <div class="row justify-content-center">
                <div class="col-lg-12 col-md-12 d-flex justify-content gap-3" style="font-family: 'Quicksand', sans-serif;">
                    <a href="{{ url('tiket') }}"
                        class="btn-custom {{ Request::is('tiket') ? 'btn-active' : 'btn-inactive' }}">
                        Open Tiket
                    </a>
                    <a href="{{ route('close.tiket') }}"
                        class="btn-custom {{ request()->routeIs('close.tiket') ? 'btn-active' : 'btn-inactive' }}">
                        Close Tiket
                    </a>
                    <a href="{{ route('dashboard') }}"
                        class="btn-custom {{ request()->routeIs('dashboard') ? 'btn-active' : 'btn-inactive' }}">
                        Detail Tiket
                    </a>
                </div>
            </div>
        </div>
      <div class="d-flex justify-content-end align-items-center mb-3" style="position: absolute; top: 10px; right: 30px; z-index: 10;">
        <div class="dropdown">
            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false" title="User Menu">
                <i class="fa fa-user-circle fa-2x text-primary"></i>
            </a>
            <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="userDropdown">
                <li>
                    <a class="dropdown-item" href="{{ url('user-profile') }}">
                        <i class="fa fa-user me-2"></i> User Profile
                    </a>
                </li>
                <li>
                    <a class="dropdown-item" href="{{ url('logout') }}">
                        <i class="fa fa-sign-out me-2"></i> Logout
                    </a>
                </li>
            </ul>
        </div>
    </div>

<div class="container-fluid py-4" style="margin-top: -50px;">
  <div class="row">
  <div class="row mt-4 g-3">
    <!-- Data Open Tiket -->
    <div class="col-12 col-lg-6 d-flex flex-column">
      <div class="card h-100 d-flex flex-column">
        <div class="card-header pb-0">
          <h5 class="text-center">Detail Open Tiket</h5>
          <p class="text-sm" style="margin-left: 25px;">
          </p>
        </div>
        <div class="card-body flex-grow-1 d-flex flex-column" style="overflow-y: auto; max-height: 320px;">
          <div class="timeline timeline-one-side" style="margin-left: 60px;">
            @foreach($allTiket as $item)
              <div class="timeline-block mb-3">
                <span class="timeline-step">
                  <i class="ni ni-credit-card text-warning text-gradient"></i>
                </span>
                <div class="timeline-content">
                  <h6 class="text-dark text-sm fw-bold mb-0">
                    <span class="text-secondary">#{{ $item->site_id }}</span> {{ $item->nama_site }}
                  </h6>
                  <p class="text-secondary mt-1 mb-1" style="font-size: 11px; line-height: 1.2;">{{ $item->detail_problem }}</p>
                  <p class="text-secondary text-xs mt-1 mb-0">{{ $item->plan_actions }}</p>
                  <p class="text-secondary text-xs mt-1 mb-0">{{ $item->ce }}</p>                  
                </div>
              </div>
            @endforeach
          </div>
        </div>
        {{-- canvas chart-bars dihapus --}}
      </div>
    </div>

    <!-- Grafik Line: Jumlah Close Tiket per Bulan -->
    <div class="col-12 col-lg-6 d-flex flex-column">
      <div class="card h-100 d-flex flex-column">
        <div class="card-header pb-0 mt-0">
          <h5 class="text-center">Jumlah Close Tiket per Bulan</h5>
        </div>
        <div class="card-body flex-grow-1 d-flex flex-column" style="min-height: 320px;">
          <div class="chart flex-grow-1" style="min-height: 220px;">
            <canvas id="chart-close-tiket" height="180"></canvas>
          </div>
        </div>
      </div>
    </div>
</div>


  <!-- Grafik Bar -->
  <div class="row mt-4 g-3">
     <div class="card h-100 d-flex flex-column">
        <div class="card-header pb-0">
          <h5 class="card-title text-center" style="margin-bottom: 5px; margin-top: 10px">Total Open Tiket Berdasarkan Kabupaten</h5>
          <p class="text-sm">
            Jumlah site yang masih open tiket berdasarkan kabupaten.
          </p>
        </div>
        <div class="card-body p-3 flex-grow-1 d-flex flex-column">
          <div class="chart flex-grow-1">
            <canvas id="siteBarChart" class="chart-canvas" height="120"></canvas>
          </div>
        </div>
      </div>
    </div>
  </div>

  <!-- Maps -->
  <div class="row mt-4">
    <div class="col-12">
      <div class="card h-100">
        <div class="card-body p-3">
          <div class="map-responsive">
            <iframe
              src="https://www.google.com/maps/embed?pb=!1m14!1m12!1m3!1d13212105.007711887!2d116.807041!3d0.655536!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!5e0!3m2!1sen!2sid!4v1625210912345!5m2!1sen!2sid"
              allowfullscreen
              loading="lazy"
              referrerpolicy="no-referrer-when-downgrade"
            ></iframe>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection

@push('dashboard')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script src="https://cdn.jsdelivr.net/npm/chartjs-plugin-datalabels@2"></script>
<script>
      document.addEventListener('DOMContentLoaded', function () {
        const timeseries = @json($timeseries);
        const labels = timeseries.map(i => i.bulan);
        const dataClose = timeseries.map(i => i.total_close);

        var ctx = document.getElementById("chart-close-tiket").getContext("2d");
        var grad = ctx.createLinearGradient(0, 230, 0, 50);
        grad.addColorStop(1, 'rgba(20,23,39,0.2)');
        grad.addColorStop(0.2, 'rgba(72,72,176,0.0)');
        grad.addColorStop(0, 'rgba(20,23,39,0)');

        new Chart(ctx, {
          type: "line",
          data: {
            labels: labels,
            datasets: [{
              label: "Close Tiket",
              data: dataClose,
              borderColor: "#3A416F",
              backgroundColor: grad,
              fill: true,
              tension: 0.4,
              pointRadius: 3
            }]
          },
          options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
              legend: { display: true }
            },
            layout: {
              padding: {
                top: 10,
                bottom: 10,
                left: 10,
                right: 10
              }
            },
            scales: {
              y: {
                beginAtZero: true,
                grid: { borderDash: [5, 5] },
                ticks: { color: '#b2b9bf' }
              },
              x: {
                grid: { display: false },
                ticks: { color: '#b2b9bf' }
              }
            }
          }
        });
      });
    </script>
<script>
  // Daftarkan plugin Datalabels
  Chart.register(ChartDataLabels);

  // Ambil panjang data kabupaten dari Laravel
  const kabupatenLabels = {!! json_encode($openSitesByKabupaten->pluck('kab')) !!};
  const siteTotals = {!! json_encode($openSitesByKabupaten->pluck('total')) !!};

  // Fungsi untuk membuat warna acak
  const getRandomColor = () => {
    const r = Math.floor(Math.random() * 255);
    const g = Math.floor(Math.random() * 255);
    const b = Math.floor(Math.random() * 255);
    return `rgba(${r}, ${g}, ${b}, 0.7)`;
  };

  // Buat array warna berdasarkan jumlah kabupaten
  const backgroundColors = kabupatenLabels.map(() => getRandomColor());
  const borderColors = backgroundColors.map(color => color.replace('0.7', '1'));

  // Inisialisasi chart
  const ctx = document.getElementById('siteBarChart').getContext('2d');
  const siteBarChart = new Chart(ctx, {
    type: 'bar',
    data: {
      labels: kabupatenLabels,
      datasets: [{
        data: siteTotals,
        backgroundColor: backgroundColors,
        borderColor: borderColors,
        borderWidth: 1
      }]
    },
    options: {
      responsive: true,
      plugins: {
        legend: { display: false },
        datalabels: {
          anchor: 'end',
          align: 'top',
          color: '#000',
          font: {
            weight: 'bold',
            size: 12
          },
          formatter: value => value
        }
      },
      scales: {
        y: {
          beginAtZero: true,
          min: 0,
          max: 7,
          ticks: {
            stepSize: 1
          },
          title: {
            display: true,
          }
        },
        x: {
          title: {
            display: true,
          }
        }
      }
    },
    plugins: [ChartDataLabels]
  });
</script>

<script>
  function fetchActiveUsers() {
    fetch('/active-users')
      .then(response => response.json())
      .then(data => {
        document.getElementById('activeUserCount').innerText = data.active_users + '';
      });
  }

  setInterval(fetchActiveUsers, 1000);
  fetchActiveUsers(); // initial load
</script>
<script>
  window.onload = function () {
    const timeseries = @json($timeseries);
    const labels = timeseries.map(i => i.bulan);
    const dataOpen = timeseries.map(i => i.total_open);
    const dataClose = timeseries.map(i => i.total_close);

    var ctxLine = document.getElementById("chart-line").getContext("2d");
    var grad1 = ctxLine.createLinearGradient(0, 230, 0, 50);
    grad1.addColorStop(1, 'rgba(203,12,159,0.2)');
    grad1.addColorStop(0.2, 'rgba(72,72,176,0.0)');
    grad1.addColorStop(0, 'rgba(203,12,159,0)');

    var grad2 = ctxLine.createLinearGradient(0, 230, 0, 50);
    grad2.addColorStop(1, 'rgba(20,23,39,0.2)');
    grad2.addColorStop(0.2, 'rgba(72,72,176,0.0)');
    grad2.addColorStop(0, 'rgba(20,23,39,0)');

    new Chart(ctxLine, {
      type: "line",
      data: {
        labels: labels,
        datasets: [
          {
            label: "Open",
            data: dataOpen,
            borderColor: "#cb0c9f",
            backgroundColor: grad1,
            fill: true,
            tension: 0.4,
            pointRadius: 0
          },
          {
            label: "Close",
            data: dataClose,
            borderColor: "#3A416F",
            backgroundColor: grad2,
            fill: true,
            tension: 0.4,
            pointRadius: 0
          }
        ]
      },
      options: {
        responsive: true,
        maintainAspectRatio: false,
        interaction: {
          mode: 'index',
          intersect: false
        },
        plugins: {
          legend: { display: true }
        },
        scales: {
          y: {
            beginAtZero: true,
            grid: { borderDash: [5, 5] },
            ticks: { color: '#b2b9bf' }
          },
          x: {
            grid: { display: false },
            ticks: { color: '#b2b9bf' }
          }
        }
      }
    });
  }
</script>

<script>
  window.onload = function() {
    // hanya inisialisasi chart-line
    const timeseries = @json($timeseries);
    const labels = timeseries.map(i => i.bulan);
    const dataOpen = timeseries.map(i => i.total_open);
    const dataClose = timeseries.map(i => i.total_close);

    var ctxLine = document.getElementById("chart-line").getContext("2d");
    var grad1 = ctxLine.createLinearGradient(0,230,0,50);
    grad1.addColorStop(1,'rgba(203,12,159,0.2)');
    grad1.addColorStop(0.2,'rgba(72,72,176,0.0)');
    grad1.addColorStop(0,'rgba(203,12,159,0)');

    var grad2 = ctxLine.createLinearGradient(0,230,0,50);
    grad2.addColorStop(1,'rgba(20,23,39,0.2)');
    grad2.addColorStop(0.2,'rgba(72,72,176,0.0)');
    grad2.addColorStop(0,'rgba(20,23,39,0)');

    new Chart(ctxLine,{
      type:"line",
      data:{labels:labels,datasets:[
        {label:"Open",data:dataOpen,borderColor:"#cb0c9f",backgroundColor:grad1,fill:true,tension:0.4,pointRadius:0},
        {label:"Close",data:dataClose,borderColor:"#3A416F",backgroundColor:grad2,fill:true,tension:0.4,pointRadius:0}
      ]},
      options:{responsive:true,maintainAspectRatio:false,
        interaction:{mode:'index',intersect:false},
        plugins:{legend:{display:true}},
        scales:{y:{beginAtZero:true,grid:{borderDash:[5,5]},ticks:{color:'#b2b9bf'}},x:{grid:{display:false},ticks:{color:'#b2b9bf'}}}
      }
    });
  }
</script>
@endpush

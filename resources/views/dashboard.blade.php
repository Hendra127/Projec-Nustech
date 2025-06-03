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
</style>

<div class="container-fluid px-3">
  <div class="row g-3">
    @php
      $cards = [
        ['label'=>'Jumlah Site','value'=>$siteCount,'icon'=>'lokasi.png'],
        ['label'=>'Tiket Open','value'=>$tiketOpenCount,'icon'=>'opentiket.png'],
        ['label'=>'Tiket Close','value'=>$tiketCloseCount,'icon'=>'closetiket.png'],
        ['label'=>'Jumlah Pengguna','value'=>$userCount,'icon'=>'enginer.png'],
      ];
    @endphp
    @foreach($cards as $card)
      <div class="col-12 col-sm-6 col-xl-3">
        <div class="card shadow-sm h-100">
          <div class="card-body p-3 d-flex justify-content-between align-items-center">
            <div>
              <p class="text-sm mb-0 text-capitalize fw-bold">{{ $card['label'] }}</p>
              <h5 class="fw-bolder mb-0">{{ $card['value'] }}</h5>
            </div>
            <img src="../assets/img/{{ $card['icon'] }}" alt="{{ $card['label'] }}" style="height:50px;">
          </div>
        </div>
      </div>
    @endforeach
  </div>

  <div class="row mt-4 g-3">
    <!-- Data Open Tiket -->
    <div class="col-12 col-lg-6 d-flex flex-column">
      <div class="card h-100 d-flex flex-column">
        <div class="card-header pb-0">
          <h6 class="text-center">Data Open Tiket</h6>
          <p class="text-sm">
            <i class="fa fa-arrow-up text-success"></i>
            <span class="fw-bold">Nama Site</span>
          </p>
        </div>
        <div class="card-body overflow-auto flex-grow-1">
          <div class="timeline timeline-one-side">
            @foreach($allTiket as $item)
              <div class="timeline-block mb-3">
                <span class="timeline-step">
                  <i class="ni ni-credit-card text-warning text-gradient"></i>
                </span>
                <div class="timeline-content">
                  <h6 class="text-dark text-sm fw-bold mb-0">
                    <span class="text-secondary">#{{ $item->site_id }}</span> {{ $item->nama_site }}
                  </h6>
                  <p class="text-secondary text-xs mt-1 mb-1">{{ $item->detail_problem }}</p>
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

    <!-- Grafik Line -->
    <div class="col-12 col-lg-6 d-flex flex-column">
      <div class="card h-100 d-flex flex-column">
        <div class="card-header pb-0">
          <h6 class="text-center">Grafik Open dan Close Tiket</h6>
          <p class="text-sm">
            @if ($delta > 0)
              <i class="fa fa-arrow-up text-success"></i>
            @elseif ($delta < 0)
              <i class="fa fa-arrow-down text-danger"></i>
            @else
              -
            @endif
            <span class="fw-bold">{{ $delta }} Site Close</span> Dalam bulan {{ $deltaMonth }}
          </p>
        </div>
        <div class="card-body p-3 flex-grow-1 d-flex flex-column">
          <div class="chart flex-grow-1">
            <canvas id="chart-line" class="chart-canvas" height="300"></canvas>
          </div>
        </div>
      </div>
    </div>
  </div>

  <!-- Grafik Bar -->
  <div class="row mt-4 g-3">
     <div class="card h-100 d-flex flex-column">
        <div class="card-header pb-0">
          <h5 class="card-title text-center" style="margin-bottom: 5px; margin-top: 10px">Jumlah Site</h5>
          <p class="text-sm">
            Total data site yang terdaftar dalam sistem berdasarkan kabupaten.
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
<canvas id="siteBarChart"></canvas>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script src="https://cdn.jsdelivr.net/npm/chartjs-plugin-datalabels@2"></script>

<script>
const barLabels = {!! json_encode($siteByKabupaten->pluck('kab')) !!};
const barData = {!! json_encode($siteByKabupaten->pluck('total')) !!};

const backgroundColors = [
  'rgba(156, 39, 176, 1)',
  'rgba(0, 150, 136, 1)',
  'rgba(33, 150, 243, 1)',
  'rgba(255, 193, 7, 1)',
  'rgba(76, 175, 80, 1)',
  'rgba(244, 67, 54, 1)',
  'rgba(103, 58, 183, 1)',
  'rgba(0, 188, 212, 1)',
  'rgba(255, 87, 34, 1)',
  'rgba(205, 220, 57, 1)',
  'rgba(121, 85, 72, 1)',
  'rgba(63, 81, 181, 1)'
];

const ctx = document.getElementById('siteBarChart').getContext('2d');

Chart.register(ChartDataLabels);

const siteBarChart = new Chart(ctx, {
  type: 'bar',
  data: {
    labels: barLabels,
    datasets: [{
      label: 'Jumlah Site',
      data: barData,
      backgroundColor: backgroundColors,
      borderColor: backgroundColors,
      borderWidth: 1
    }]
  },
  options: {
    responsive: true,
    animation: {
      duration: 7000, // Efek animasi lambat
      easing: 'easeOutQuart' // efek halus
    },
    plugins: {
      legend: { display: false },
      datalabels: {
        anchor: 'end',
        align: 'top',
        color: '#000',
        font: {
          weight: 'bold'
        },
        formatter: value => value
      }
    },
    scales: {
      x: {
        ticks: {
          font: {
            size: 9,
          },
          maxRotation: 20,
          minRotation:20,
          padding: 5,
        },
        grid: {
          display: false
        }
      },
      y: {
        beginAtZero: true,
        ticks: {
          stepSize: 10
        },
        grid: {
          borderDash: [5, 5]
        }
      }
    }
  },
  plugins: [ChartDataLabels]
});
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

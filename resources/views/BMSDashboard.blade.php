<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>BMS Monitoring System</title>
<meta name="viewport" content="width=device-width, initial-scale=1">

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">

<style>
:root{
    --primary:#2563eb;
    --danger:#ef4444;
    --success:#22c55e;
    --warning:#f59e0b;
    --bg:#f1f5f9;
    --dark:#020617;
}

body{
    font-family:'Poppins',sans-serif;
    background:var(--bg);
}

/* ===== HEADER ===== */
.header{
    background:linear-gradient(135deg,#020617,#1e3a8a);
    color:#fff;
    padding:28px 40px;
    border-radius:0 0 28px 28px;
}

/* ===== CARD ===== */
.card-bms{
    background:#fff;
    border-radius:20px;
    box-shadow:0 14px 35px rgba(0,0,0,.12);
    transition:.3s;
}
.card-bms:hover{
    transform:translateY(-6px);
}

/* ===== KPI ===== */
.kpi{
    display:flex;
    align-items:center;
    justify-content:space-between;
}
.kpi-icon{
    width:52px;height:52px;
    border-radius:14px;
    display:flex;
    align-items:center;
    justify-content:center;
    color:#fff;
    font-size:22px;
}
.counter{
    font-size:28px;
    font-weight:700;
}

/* ===== STATUS ===== */
.online{color:var(--success)}
.offline{color:var(--danger)}
.warning{color:var(--warning)}

.badge-alarm{
    background:var(--danger);
    animation:pulse 1.4s infinite;
}
@keyframes pulse{
    0%{box-shadow:0 0 0 0 rgba(239,68,68,.6)}
    70%{box-shadow:0 0 0 12px rgba(239,68,68,0)}
    100%{box-shadow:0 0 0 0 rgba(239,68,68,0)}
}

/* ===== TABLE ===== */
.table thead{
    background:var(--dark);
    color:#fff;
}
.table-hover tbody tr:hover{
    background:#e0f2fe;
}

/* ===== TIMELINE ===== */
.timeline{
    position:relative;
    padding-left:24px;
}
.timeline::before{
    content:'';
    position:absolute;
    left:6px;
    top:0;
    width:3px;
    height:100%;
    background:#c7d2fe;
}
.timeline-item{
    position:relative;
    margin-bottom:18px;
    padding-left:18px;
}
.timeline-item::before{
    content:'';
    position:absolute;
    left:-1px;
    top:6px;
    width:12px;
    height:12px;
    background:var(--primary);
    border-radius:50%;
}

footer{
    text-align:center;
    font-size:13px;
    color:#64748b;
    padding:24px 0;
}
</style>
</head>

<body>

<!-- HEADER -->
<section class="header mb-4">
    <div class="d-flex justify-content-between align-items-center flex-wrap">
        <div>
            <h3 class="fw-bold mb-1">📡 BMS Monitoring System</h3>
            <small class="opacity-75">Real-Time Network & Site Operation Center</small>
        </div>
        <span class="badge bg-success px-4 py-2 mt-3 mt-md-0">
            <i class="bi bi-wifi"></i> SYSTEM ONLINE
        </span>
    </div>
</section>

<div class="container-fluid px-4">

<div class="row g-4">

<!-- ================= LEFT : KPI ================= -->
<div class="col-xl-2 col-lg-3">

    <div class="card-bms p-3 mb-3 kpi">
        <div>
            <small>Total Site</small>
            <div class="counter" data-target="124">0</div>
        </div>
        <div class="kpi-icon bg-primary"><i class="bi bi-geo-alt"></i></div>
    </div>

    <div class="card-bms p-3 mb-3 kpi">
        <div>
            <small>Online</small>
            <div class="counter online" data-target="118">0</div>
        </div>
        <div class="kpi-icon bg-success"><i class="bi bi-check-circle"></i></div>
    </div>

    <div class="card-bms p-3 mb-3 kpi">
        <div>
            <small>Offline</small>
            <div class="counter offline" data-target="6">0</div>
        </div>
        <div class="kpi-icon bg-danger"><i class="bi bi-x-circle"></i></div>
    </div>

    <div class="card-bms p-3 kpi">
        <div>
            <small>Active Alarm</small>
            <div class="counter offline" data-target="3">0</div>
        </div>
        <div class="kpi-icon bg-warning"><i class="bi bi-bell"></i></div>
    </div>

</div>

<!-- ================= CENTER : MONITORING ================= -->
<div class="col-xl-7 col-lg-6">
    <div class="card-bms p-4 h-100">
        <h6 class="fw-bold mb-3">📋 Live Site Monitoring</h6>
        <div class="table-responsive" style="max-height:520px">
            <table class="table table-hover align-middle">
                <thead>
                    <tr>
                        <th>Site ID</th>
                        <th>Site Name</th>
                        <th>Status</th>
                        <th>Latency</th>
                        <th>Last Update</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>SITE-001</td>
                        <td>POS KRAYAN</td>
                        <td class="online fw-semibold">ONLINE</td>
                        <td>620 ms</td>
                        <td>2 menit</td>
                    </tr>
                    <tr>
                        <td>SITE-014</td>
                        <td>POS MALINAU</td>
                        <td class="offline fw-semibold">OFFLINE</td>
                        <td>-</td>
                        <td>15 menit</td>
                    </tr>
                    <tr>
                        <td>SITE-022</td>
                        <td>POS MAHAKAM</td>
                        <td class="warning fw-semibold">DEGRADED</td>
                        <td>1800 ms</td>
                        <td>5 menit</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- ================= RIGHT : ALARM ================= -->
<div class="col-xl-3 col-lg-3">

    <div class="card-bms p-4 mb-4">
        <h6 class="fw-bold mb-3">🚨 Active Alarm</h6>
        <div class="mb-2">
            <span class="badge badge-alarm me-2">CRITICAL</span>
            VSAT DOWN – SITE-014
        </div>
        <div>
            <span class="badge bg-warning text-dark me-2">WARNING</span>
            HIGH LATENCY – SITE-022
        </div>
    </div>

    <div class="card-bms p-4">
        <h6 class="fw-bold mb-3">🕒 Recent Activity</h6>
        <div class="timeline">
            <div class="timeline-item">
                SITE-014 OFFLINE
                <div class="text-muted small">10 menit lalu</div>
            </div>
            <div class="timeline-item">
                SITE-009 RECOVERED
                <div class="text-muted small">25 menit lalu</div>
            </div>
            <div class="timeline-item">
                LATENCY SPIKE SITE-022
                <div class="text-muted small">40 menit lalu</div>
            </div>
        </div>
    </div>

</div>

</div>
</div>

<footer>
    © 2026 BMS Monitoring System • Network Operation Center
</footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
<script>
document.querySelectorAll('.counter[data-target]').forEach(el=>{
    let t=+el.dataset.target,c=0,s=Math.max(1,t/40)
    let i=setInterval(()=>{
        c+=s
        if(c>=t){el.textContent=t;clearInterval(i)}
        else el.textContent=Math.floor(c)
    },20)
})
</script>

</body>
</html>

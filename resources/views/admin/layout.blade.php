<!DOCTYPE html>
<html lang="en" data-theme="dark">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width,initial-scale=1.0">
    <title>@yield('title','Admin') — ROG Store</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Rajdhani:wght@400;500;600;700&family=Orbitron:wght@700;900&display=swap" rel="stylesheet">
    @vite(['resources/css/app.css','resources/js/app.js'])
    <style>
        :root,[data-theme=dark]{--adm-bg:#09090b;--adm-surface:#111113;--adm-surface2:#18181b;--adm-border:#27272a;--adm-text:#e4e4e7;--adm-muted:#71717a;--adm-sidebar:180px}
        [data-theme=light]{--adm-bg:#f4f4f5;--adm-surface:#ffffff;--adm-surface2:#f9f9f9;--adm-border:#e4e4e7;--adm-text:#18181b;--adm-muted:#71717a}
        *{box-sizing:border-box;margin:0;padding:0}
        body{background:var(--adm-bg);color:var(--adm-text);font-family:'Rajdhani',sans-serif;display:flex;min-height:100vh}
        /* Sidebar */
        .adm-sidebar{width:var(--adm-sidebar);flex-shrink:0;background:var(--adm-surface);border-right:1px solid var(--adm-border);display:flex;flex-direction:column;position:sticky;top:0;height:100vh}
        .adm-brand{padding:1.2rem 1rem;border-bottom:1px solid var(--adm-border);display:flex;align-items:center;gap:.6rem}
        .adm-brand-text{font-family:'Orbitron',sans-serif;font-weight:900;font-size:.85rem;color:var(--adm-text);line-height:1}
        .adm-brand-sub{font-size:.6rem;color:#e5001e;letter-spacing:.15em;text-transform:uppercase}
        .adm-nav{flex:1;padding:.8rem .6rem;display:flex;flex-direction:column;gap:.2rem}
        .adm-nav a{display:flex;align-items:center;gap:.6rem;padding:.6rem .8rem;border-radius:6px;color:var(--adm-muted);text-decoration:none;font-size:.83rem;font-weight:600;letter-spacing:.03em;transition:background .15s,color .15s}
        .adm-nav a:hover,.adm-nav a.active{background:rgba(229,0,30,.1);color:#e5001e}
        .adm-nav a svg{flex-shrink:0;opacity:.7}
        .adm-nav a:hover svg,.adm-nav a.active svg{opacity:1}
        .adm-nav-label{font-size:.65rem;color:var(--adm-muted);letter-spacing:.12em;text-transform:uppercase;padding:.6rem .8rem .2rem;margin-top:.4rem}
        .adm-sidebar-footer{padding:.8rem;border-top:1px solid var(--adm-border)}
        .adm-sidebar-footer a{display:flex;align-items:center;gap:.5rem;color:var(--adm-muted);font-size:.8rem;text-decoration:none;padding:.4rem .5rem;border-radius:4px;transition:color .15s}
        .adm-sidebar-footer a:hover{color:#e5001e}
        /* Main */
        .adm-main{flex:1;display:flex;flex-direction:column;min-width:0;overflow:hidden}
        .adm-topbar{background:var(--adm-surface);border-bottom:1px solid var(--adm-border);padding:.75rem 1.5rem;display:flex;align-items:center;justify-content:space-between;position:sticky;top:0;z-index:100}
        .adm-topbar-title{font-family:'Orbitron',sans-serif;font-weight:700;font-size:.95rem;color:var(--adm-text)}
        .adm-topbar-right{display:flex;align-items:center;gap:.8rem}
        .adm-badge{background:#e5001e;color:#fff;font-size:.68rem;font-weight:700;padding:1px 7px;border-radius:10px}
        .adm-content{flex:1;padding:1.5rem;overflow-y:auto}
        /* Cards */
        .adm-card{background:var(--adm-surface);border:1px solid var(--adm-border);border-radius:8px;overflow:hidden}
        .adm-card-header{padding:.9rem 1.2rem;border-bottom:1px solid var(--adm-border);display:flex;align-items:center;justify-content:space-between}
        .adm-card-title{font-weight:700;font-size:.82rem;letter-spacing:.08em;text-transform:uppercase;color:var(--adm-muted)}
        /* Stat cards */
        .adm-stats{display:grid;grid-template-columns:repeat(auto-fill,minmax(200px,1fr));gap:1rem;margin-bottom:1.5rem}
        .adm-stat{background:var(--adm-surface);border:1px solid var(--adm-border);border-radius:8px;padding:1.2rem 1.4rem;position:relative;overflow:hidden;transition:border-color .2s}
        .adm-stat:hover{border-color:#e5001e}
        .adm-stat-label{font-size:.72rem;color:var(--adm-muted);text-transform:uppercase;letter-spacing:.1em;margin-bottom:.5rem;font-weight:600}
        .adm-stat-value{font-family:'Orbitron',sans-serif;font-size:1.7rem;font-weight:900;color:var(--adm-text);line-height:1}
        .adm-stat-sub{font-size:.75rem;margin-top:.4rem;display:flex;align-items:center;gap:.3rem}
        .adm-stat-up{color:#22c55e}.adm-stat-down{color:#ef4444}.adm-stat-neutral{color:var(--adm-muted)}
        .adm-stat-accent{position:absolute;right:.8rem;top:.8rem;width:36px;height:36px;border-radius:8px;display:flex;align-items:center;justify-content:center}
        /* Today highlight */
        .adm-stat--today{border-color:#e5001e;border-top:3px solid #e5001e}
        .adm-stat--today .adm-stat-value{color:#e5001e}
        /* Table */
        .adm-table{width:100%;border-collapse:collapse}
        .adm-table th{background:var(--adm-surface2);color:var(--adm-muted);font-size:.72rem;text-transform:uppercase;letter-spacing:.08em;padding:.7rem 1rem;text-align:left;border-bottom:1px solid var(--adm-border);white-space:nowrap}
        .adm-table td{padding:.75rem 1rem;border-bottom:1px solid var(--adm-border);font-size:.85rem;color:var(--adm-text)}
        .adm-table tr:last-child td{border-bottom:none}
        .adm-table tr:hover td{background:var(--adm-surface2)}
        /* Status badges */
        .adm-status{display:inline-flex;align-items:center;gap:.3rem;padding:2px 10px;border-radius:12px;font-size:.72rem;font-weight:700;text-transform:uppercase;letter-spacing:.06em}
        .adm-status--confirmed,.adm-status--paid{background:rgba(34,197,94,.12);color:#22c55e;border:1px solid rgba(34,197,94,.25)}
        .adm-status--pending{background:rgba(245,158,11,.12);color:#f59e0b;border:1px solid rgba(245,158,11,.25)}
        .adm-status--processing{background:rgba(59,130,246,.12);color:#60a5fa;border:1px solid rgba(59,130,246,.25)}
        .adm-status--shipped{background:rgba(139,92,246,.12);color:#a78bfa;border:1px solid rgba(139,92,246,.25)}
        .adm-status--delivered{background:rgba(16,185,129,.12);color:#10b981;border:1px solid rgba(16,185,129,.25)}
        .adm-status--cancelled{background:rgba(239,68,68,.12);color:#ef4444;border:1px solid rgba(239,68,68,.25)}
        /* Bar chart */
        .adm-chart{display:flex;align-items:flex-end;gap:.4rem;height:80px;padding:0 .2rem}
        .adm-bar-wrap{flex:1;display:flex;flex-direction:column;align-items:center;gap:.3rem}
        .adm-bar{width:100%;background:#e5001e;border-radius:3px 3px 0 0;min-height:3px;transition:height .4s ease}
        .adm-bar-label{font-size:.65rem;color:var(--adm-muted);white-space:nowrap}
        /* Grid layout */
        .adm-grid-2{display:grid;grid-template-columns:1fr 1fr;gap:1rem}
        .adm-grid-3{display:grid;grid-template-columns:2fr 1fr;gap:1rem}
        @media(max-width:900px){.adm-grid-2,.adm-grid-3{grid-template-columns:1fr}.adm-sidebar{display:none}}
        /* Flash */
        .adm-flash{background:rgba(34,197,94,.1);border:1px solid #22c55e;color:#22c55e;padding:.6rem 1rem;border-radius:6px;font-size:.85rem;margin-bottom:1rem}
        /* Today pulse dot */
        .adm-live{display:inline-flex;align-items:center;gap:.4rem;font-size:.72rem;color:#22c55e;font-weight:700}
        .adm-live-dot{width:7px;height:7px;border-radius:50%;background:#22c55e;animation:adm-pulse 1.8s ease-in-out infinite}
        @keyframes adm-pulse{0%,100%{opacity:1}50%{opacity:.35}}
    </style>
</head>
<body>

{{-- Sidebar --}}
<aside class="adm-sidebar">
    <div class="adm-brand">
        <svg width="28" height="28" viewBox="0 0 100 100" fill="none">
            <polygon points="50,5 95,27.5 95,72.5 50,95 5,72.5 5,27.5" fill="#e5001e" opacity=".2"/>
            <polygon points="50,5 95,27.5 95,72.5 50,95 5,72.5 5,27.5" fill="none" stroke="#e5001e" stroke-width="4"/>
            <text x="50" y="63" text-anchor="middle" font-family="Orbitron,sans-serif" font-weight="900" font-size="28" fill="#e5001e">R</text>
        </svg>
        <div>
            <div class="adm-brand-text">ROG Store</div>
            <div class="adm-brand-sub">Admin Panel</div>
        </div>
    </div>
    <nav class="adm-nav">
        <div class="adm-nav-label">Overview</div>
        <a href="{{ route('admin.dashboard') }}" class="{{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
            <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"><rect x="3" y="3" width="7" height="7"/><rect x="14" y="3" width="7" height="7"/><rect x="3" y="14" width="7" height="7"/><rect x="14" y="14" width="7" height="7"/></svg>
            Dashboard
        </a>
        <div class="adm-nav-label">Sales</div>
        <a href="{{ route('admin.orders') }}" class="{{ request()->routeIs('admin.orders*') ? 'active' : '' }}">
            <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"><path d="M9 5H7a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h10a2 2 0 0 0 2-2V7a2 2 0 0 0-2-2h-2"/><rect x="9" y="3" width="6" height="4" rx="2"/><path d="M9 12h6M9 16h4"/></svg>
            All Orders
        </a>
        <a href="{{ route('admin.orders', ['date' => now()->format('Y-m-d')]) }}">
            <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"><rect x="3" y="4" width="18" height="18" rx="2"/><path d="M16 2v4M8 2v4M3 10h18"/></svg>
            Today's Orders
        </a>
        <div class="adm-nav-label">Catalog</div>
        <a href="{{ route('admin.products') }}" class="{{ request()->routeIs('admin.products*') ? 'active' : '' }}">
            <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"><path d="M21 16V8a2 2 0 0 0-1-1.73l-7-4a2 2 0 0 0-2 0l-7 4A2 2 0 0 0 3 8v8a2 2 0 0 0 1 1.73l7 4a2 2 0 0 0 2 0l7-4A2 2 0 0 0 21 16z"/><polyline points="3.27 6.96 12 12.01 20.73 6.96"/><line x1="12" y1="22.08" x2="12" y2="12"/></svg>
            Products
        </a>
    </nav>
    <div class="adm-sidebar-footer">
        <a href="{{ route('home') }}" target="_blank">
            <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"><path d="M18 13v6a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V8a2 2 0 0 1 2-2h6"/><polyline points="15 3 21 3 21 9"/><line x1="10" y1="14" x2="21" y2="3"/></svg>
            View Store
        </a>
    </div>
</aside>

{{-- Main --}}
<div class="adm-main">
    <div class="adm-topbar">
        <div class="adm-topbar-title">@yield('page-title','Dashboard')</div>
        <div class="adm-topbar-right">
            <div class="adm-live"><span class="adm-live-dot"></span>Live</div>
            <span style="font-size:.78rem;color:var(--adm-muted);">{{ now()->format('D, M j Y  H:i') }}</span>
        </div>
    </div>
    <div class="adm-content">
        @if(session('success'))
            <div class="adm-flash">✓ {{ session('success') }}</div>
        @endif
        @yield('content')
    </div>
</div>

</body>
</html>

<!DOCTYPE html>
<html lang="en" data-theme="dark">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width,initial-scale=1.0">
    <title>@yield('title','Command Deck') — ROG Store Admin</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Rajdhani:wght@400;500;600;700;800&family=Orbitron:wght@700;800;900&display=swap" rel="stylesheet">
    @vite(['resources/css/app.css','resources/js/app.js'])
    <style>
        :root,[data-theme=dark] {
            --adm-bg: #06050e;
            --adm-surface: rgba(13, 11, 24, 0.88);
            --adm-surface2: rgba(22, 18, 40, 0.75);
            --adm-border: rgba(147, 51, 234, 0.28);
            --adm-border-hover: rgba(229, 0, 30, 0.6);
            --adm-text: #f1f5f9;
            --adm-muted: #94a3b8;
            --adm-sidebar: 210px;
            --rog-red: #e5001e;
        }
        * { box-sizing:border-box; margin:0; padding:0; }
        body {
            background: var(--adm-bg);
            color: var(--adm-text);
            font-family: 'Rajdhani', sans-serif;
            display: flex;
            min-height: 100vh;
            overflow-x: hidden;
        }

        /* ─── 8D Holographic Animation Keyframes ───────────────────────────── */
        @keyframes orbit3D {
            0%   { transform: rotateZ(0deg) rotateX(60deg) rotateY(0deg); }
            100% { transform: rotateZ(360deg) rotateX(60deg) rotateY(0deg); }
        }
        @keyframes orbit3DReverse {
            0%   { transform: rotateZ(360deg) rotateX(-60deg) rotateY(20deg); }
            100% { transform: rotateZ(0deg) rotateX(-60deg) rotateY(20deg); }
        }
        @keyframes float8D {
            0%, 100% { transform: translateY(0px) rotate(0deg); }
            50%      { transform: translateY(-6px) rotate(2deg); }
        }
        @keyframes pulseGlow8D {
            0%, 100% { filter: drop-shadow(0 0 8px currentColor) drop-shadow(0 0 16px currentColor); opacity: 0.9; }
            50%      { filter: drop-shadow(0 0 16px currentColor) drop-shadow(0 0 32px currentColor); opacity: 1; }
        }
        @keyframes laserScan8D {
            0%   { top: -20%; opacity: 0; }
            30%  { opacity: 0.9; }
            70%  { opacity: 0.9; }
            100% { top: 120%; opacity: 0; }
        }
        @keyframes hudCornerGlow {
            0%, 100% { opacity: 0.6; }
            50%      { opacity: 1; filter: drop-shadow(0 0 4px #e5001e); }
        }

        /* ─── 3D Icon Badges Module ─────────────────────────────────────────── */
        .icon-badge-8d {
            position: relative;
            width: 52px;
            height: 52px;
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            perspective: 600px;
            transform-style: preserve-3d;
            animation: float8D 4s ease-in-out infinite;
            flex-shrink: 0;
            overflow: visible;
        }
        .icon-badge-8d::before {
            content: '';
            position: absolute;
            inset: -4px;
            border-radius: 14px;
            border: 1px dashed rgba(255,255,255,0.25);
            animation: orbit3D 8s linear infinite;
            pointer-events: none;
        }
        .icon-badge-8d::after {
            content: '';
            position: absolute;
            inset: -8px;
            border-radius: 50%;
            border: 1px solid rgba(255,255,255,0.15);
            border-top-color: #e5001e;
            animation: orbit3DReverse 6s linear infinite;
            pointer-events: none;
        }
        .icon-badge-8d-inner {
            position: relative;
            z-index: 2;
            width: 100%;
            height: 100%;
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            backdrop-filter: blur(8px);
            border: 1.5px solid rgba(255,255,255,0.15);
            overflow: hidden;
            box-shadow: inset 0 0 12px rgba(255,255,255,0.1);
        }
        .icon-badge-8d-inner .laser-sweep {
            position: absolute;
            left: 0;
            right: 0;
            height: 2px;
            background: linear-gradient(90deg, transparent, #fff 50%, transparent);
            box-shadow: 0 0 6px #fff;
            animation: laserScan8D 2.5s ease-in-out infinite;
            pointer-events: none;
        }

        /* ─── Sidebar ───────────────────────────────────────────────────────── */
        .adm-sidebar {
            width: var(--adm-sidebar);
            flex-shrink: 0;
            background: var(--adm-surface);
            backdrop-filter: blur(20px);
            border-right: 1px solid var(--adm-border);
            display: flex;
            flex-direction: column;
            position: sticky;
            top: 0;
            height: 100vh;
            z-index: 1000;
        }
        .adm-brand {
            padding: 1.2rem 1.1rem;
            border-bottom: 1px solid var(--adm-border);
            display: flex;
            align-items: center;
            gap: .8rem;
            position: relative;
        }
        .adm-brand-logo-wrap {
            position: relative;
            width: 38px;
            height: 38px;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        .adm-brand-logo-wrap::after {
            content: '';
            position: absolute;
            inset: -2px;
            border: 1px dashed rgba(229,0,30,0.5);
            border-radius: 50%;
            animation: spin 10s linear infinite;
        }
        .adm-brand-text {
            font-family: 'Orbitron', sans-serif;
            font-weight: 900;
            font-size: .92rem;
            color: var(--adm-text);
            line-height: 1.1;
            letter-spacing: .04em;
        }
        .adm-brand-sub {
            font-size: .62rem;
            color: #e5001e;
            letter-spacing: .18em;
            text-transform: uppercase;
            font-weight: 800;
            display: flex;
            align-items: center;
            gap: 4px;
        }
        .adm-nav {
            flex: 1;
            padding: 1rem .8rem;
            display: flex;
            flex-direction: column;
            gap: .35rem;
        }
        .adm-nav a {
            display: flex;
            align-items: center;
            gap: .75rem;
            padding: .65rem .9rem;
            border-radius: 6px;
            color: var(--adm-muted);
            text-decoration: none;
            font-size: .88rem;
            font-weight: 700;
            letter-spacing: .04em;
            transition: all .2s cubic-bezier(0.2, 0.8, 0.2, 1);
            position: relative;
            border: 1px solid transparent;
        }
        .adm-nav a:hover {
            background: rgba(147, 51, 234, 0.12);
            border-color: rgba(147, 51, 234, 0.3);
            color: #fff;
            transform: translateX(3px);
        }
        .adm-nav a.active {
            background: linear-gradient(90deg, rgba(229,0,30,0.18) 0%, rgba(147,51,234,0.08) 100%);
            border-color: rgba(229,0,30,0.5);
            color: #fff;
            box-shadow: 0 4px 15px rgba(229,0,30,0.2), inset 0 0 10px rgba(229,0,30,0.1);
        }
        .adm-nav a.active::before {
            content: '';
            position: absolute;
            left: 0;
            top: 20%;
            bottom: 20%;
            width: 3px;
            background: #e5001e;
            box-shadow: 0 0 8px #e5001e;
            border-radius: 0 2px 2px 0;
        }
        .adm-nav a svg {
            flex-shrink: 0;
            transition: transform .2s, filter .2s;
        }
        .adm-nav a:hover svg, .adm-nav a.active svg {
            transform: scale(1.1);
            filter: drop-shadow(0 0 6px #e5001e);
        }
        .adm-nav-label {
            font-size: .65rem;
            color: var(--adm-muted);
            letter-spacing: .15em;
            text-transform: uppercase;
            padding: .7rem .9rem .2rem;
            margin-top: .4rem;
            font-weight: 800;
        }
        .adm-sidebar-footer {
            padding: .9rem 1rem;
            border-top: 1px solid var(--adm-border);
            background: rgba(0,0,0,0.2);
        }
        .adm-sidebar-footer a {
            display: flex;
            align-items: center;
            gap: .6rem;
            color: var(--adm-muted);
            font-size: .82rem;
            font-weight: 700;
            text-decoration: none;
            padding: .45rem .6rem;
            border-radius: 4px;
            transition: all .2s;
        }
        .adm-sidebar-footer a:hover {
            color: #e5001e;
            background: rgba(229,0,30,0.1);
        }

        /* ─── Main Content ─────────────────────────────────────────────────── */
        .adm-main {
            flex: 1;
            display: flex;
            flex-direction: column;
            min-width: 0;
            overflow: hidden;
            position: relative;
        }
        .adm-topbar {
            background: var(--adm-surface);
            backdrop-filter: blur(20px);
            border-bottom: 1px solid var(--adm-border);
            padding: .85rem 1.8rem;
            display: flex;
            align-items: center;
            justify-content: space-between;
            position: sticky;
            top: 0;
            z-index: 100;
        }
        .adm-topbar-title {
            font-family: 'Orbitron', sans-serif;
            font-weight: 800;
            font-size: 1.05rem;
            color: var(--adm-text);
            letter-spacing: .06em;
            display: flex;
            align-items: center;
            gap: .6rem;
        }
        .adm-topbar-right {
            display: flex;
            align-items: center;
            gap: 1.2rem;
        }
        .adm-badge {
            background: var(--rog-red);
            color: #fff;
            font-size: .68rem;
            font-weight: 800;
            padding: 2px 8px;
            border-radius: 10px;
            box-shadow: 0 0 8px rgba(229,0,30,0.6);
        }
        .adm-content {
            flex: 1;
            padding: 1.8rem;
            overflow-y: auto;
            position: relative;
            z-index: 10;
        }

        /* ─── Cyber HUD Cards ───────────────────────────────────────────────── */
        .adm-card {
            background: var(--adm-surface);
            backdrop-filter: blur(16px);
            border: 1px solid var(--adm-border);
            border-radius: 10px;
            overflow: hidden;
            position: relative;
            box-shadow: 0 8px 30px rgba(0,0,0,0.5), 0 0 15px rgba(147, 51, 234, 0.08);
            transition: border-color .25s, box-shadow .25s, transform .25s;
        }
        .adm-card:hover {
            border-color: rgba(147, 51, 234, 0.55);
            box-shadow: 0 12px 35px rgba(0,0,0,0.65), 0 0 25px rgba(147, 51, 234, 0.18);
        }
        .adm-card-header {
            padding: 1rem 1.4rem;
            border-bottom: 1px solid var(--adm-border);
            display: flex;
            align-items: center;
            justify-content: space-between;
            background: rgba(0,0,0,0.15);
        }
        .adm-card-title {
            font-family: 'Orbitron', sans-serif;
            font-weight: 800;
            font-size: .88rem;
            letter-spacing: .06em;
            text-transform: uppercase;
            color: #fff;
            display: flex;
            align-items: center;
            gap: .5rem;
        }

        /* ─── 3D Stat Cards Grid ────────────────────────────────────────────── */
        .adm-stats {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(210px, 1fr));
            gap: 1.1rem;
            margin-bottom: 1.6rem;
        }
        .adm-stat-8d {
            background: var(--adm-surface);
            backdrop-filter: blur(16px);
            border: 1.5px solid var(--adm-border);
            border-radius: 10px;
            padding: 1.3rem 1.4rem;
            position: relative;
            overflow: hidden;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            min-height: 135px;
            transition: all .25s cubic-bezier(0.2, 0.8, 0.2, 1);
            box-shadow: 0 6px 24px rgba(0,0,0,0.45);
        }
        .adm-stat-8d:hover {
            transform: translateY(-4px);
            border-color: var(--adm-border-hover);
            box-shadow: 0 12px 32px rgba(0,0,0,0.6), 0 0 20px rgba(229,0,30,0.25);
        }
        .adm-stat-8d--today {
            border-color: rgba(229,0,30,0.55);
            background: linear-gradient(145deg, rgba(229,0,30,0.08) 0%, var(--adm-surface) 100%);
            box-shadow: 0 6px 24px rgba(0,0,0,0.45), 0 0 18px rgba(229,0,30,0.15);
        }
        .adm-stat-8d--today .adm-stat-value {
            color: #fff;
            text-shadow: 0 0 15px rgba(229,0,30,0.6);
        }
        .adm-stat-header {
            display: flex;
            align-items: flex-start;
            justify-content: space-between;
            margin-bottom: .6rem;
        }
        .adm-stat-label {
            font-size: .75rem;
            color: var(--adm-muted);
            text-transform: uppercase;
            letter-spacing: .12em;
            font-weight: 800;
        }
        .adm-stat-value {
            font-family: 'Orbitron', sans-serif;
            font-size: 1.8rem;
            font-weight: 900;
            color: var(--adm-text);
            line-height: 1.05;
        }
        .adm-stat-sub {
            font-size: .78rem;
            margin-top: .45rem;
            display: flex;
            align-items: center;
            gap: .35rem;
            font-weight: 700;
        }
        .adm-stat-up { color: #22c55e; }
        .adm-stat-down { color: #ef4444; }
        .adm-stat-neutral { color: var(--adm-muted); }

        /* ─── HUD Corner Brackets ───────────────────────────────────────────── */
        .hud-corner-tl, .hud-corner-br {
            position: absolute;
            width: 8px;
            height: 8px;
            pointer-events: none;
        }
        .hud-corner-tl {
            top: 0; left: 0;
            border-top: 2px solid #e5001e;
            border-left: 2px solid #e5001e;
            animation: hudCornerGlow 3s ease-in-out infinite;
        }
        .hud-corner-br {
            bottom: 0; right: 0;
            border-bottom: 2px solid #a855f7;
            border-right: 2px solid #a855f7;
            animation: hudCornerGlow 3s ease-in-out infinite 1.5s;
        }

        /* ─── Table ─────────────────────────────────────────────────────────── */
        .adm-table { width: 100%; border-collapse: collapse; }
        .adm-table th {
            background: var(--adm-surface2);
            color: #c084fc;
            font-size: .75rem;
            text-transform: uppercase;
            letter-spacing: .1em;
            padding: .8rem 1.1rem;
            text-align: left;
            border-bottom: 1px solid var(--adm-border);
            white-space: nowrap;
            font-weight: 800;
            font-family: 'Orbitron', sans-serif;
        }
        .adm-table td {
            padding: .85rem 1.1rem;
            border-bottom: 1px solid rgba(147, 51, 234, 0.12);
            font-size: .88rem;
            color: var(--adm-text);
        }
        .adm-table tr:last-child td { border-bottom: none; }
        .adm-table tr:hover td { background: rgba(147, 51, 234, 0.08); }

        /* ─── Status Badges ─────────────────────────────────────────────────── */
        .adm-status {
            display: inline-flex;
            align-items: center;
            gap: .35rem;
            padding: 3px 11px;
            border-radius: 12px;
            font-size: .72rem;
            font-weight: 800;
            text-transform: uppercase;
            letter-spacing: .06em;
        }
        .adm-status--confirmed, .adm-status--paid { background: rgba(34,197,94,.15); color: #34d399; border: 1px solid rgba(34,197,94,.4); box-shadow: 0 0 8px rgba(34,197,94,.2); }
        .adm-status--pending { background: rgba(245,158,11,.15); color: #fbbf24; border: 1px solid rgba(245,158,11,.4); box-shadow: 0 0 8px rgba(245,158,11,.2); }
        .adm-status--processing { background: rgba(59,130,246,.15); color: #60a5fa; border: 1px solid rgba(59,130,246,.4); box-shadow: 0 0 8px rgba(59,130,246,.2); }
        .adm-status--shipped { background: rgba(168,85,247,.15); color: #c084fc; border: 1px solid rgba(168,85,247,.4); box-shadow: 0 0 8px rgba(168,85,247,.2); }
        .adm-status--delivered { background: rgba(16,185,129,.15); color: #10b981; border: 1px solid rgba(16,185,129,.4); box-shadow: 0 0 8px rgba(16,185,129,.2); }
        .adm-status--cancelled { background: rgba(239,68,68,.15); color: #f87171; border: 1px solid rgba(239,68,68,.4); box-shadow: 0 0 8px rgba(239,68,68,.2); }

        /* ─── Grid Layouts ──────────────────────────────────────────────────── */
        .adm-grid-2 { display: grid; grid-template-columns: 1fr 1fr; gap: 1.2rem; }
        .adm-grid-3 { display: grid; grid-template-columns: 2fr 1fr; gap: 1.2rem; }
        /* ─── Ultra-Smooth Cyber Scrollbar System ───────────────────────────── */
        html {
            scroll-behavior: smooth;
        }
        * {
            scroll-behavior: smooth;
            scrollbar-width: thin;
            scrollbar-color: rgba(229, 0, 30, 0.7) rgba(14, 11, 28, 0.75);
        }
        ::-webkit-scrollbar {
            width: 6px;
            height: 6px;
        }
        ::-webkit-scrollbar-track {
            background: rgba(10, 8, 20, 0.75);
            border-radius: 4px;
        }
        ::-webkit-scrollbar-thumb {
            background: linear-gradient(180deg, #e5001e 0%, #a855f7 100%);
            border-radius: 4px;
            box-shadow: 0 0 8px rgba(229, 0, 30, 0.4);
            transition: background .2s, box-shadow .2s;
        }
        ::-webkit-scrollbar-thumb:hover {
            background: linear-gradient(180deg, #ff0055 0%, #c084fc 100%);
            box-shadow: 0 0 14px rgba(229, 0, 30, 0.8), 0 0 8px rgba(168, 85, 247, 0.6);
        }
        ::-webkit-scrollbar-corner {
            background: transparent;
        }

        /* ─── Content Scroll Viewport ───────────────────────────────────────── */
        .adm-content {
            flex: 1;
            padding: 1.8rem;
            overflow-y: auto;
            overflow-x: hidden;
            position: relative;
            z-index: 10;
            scroll-behavior: smooth;
            -webkit-overflow-scrolling: touch;
            overscroll-behavior: contain;
        }

        /* ─── Floating Quick Scroll HUD Dock ────────────────────────────────── */
        .adm-scroll-dock {
            position: fixed;
            bottom: 1.6rem;
            right: 1.6rem;
            z-index: 9999;
            display: flex;
            align-items: center;
            gap: .4rem;
            background: rgba(14, 11, 28, 0.85);
            backdrop-filter: blur(16px);
            border: 1.5px solid rgba(147, 51, 234, 0.4);
            border-radius: 30px;
            padding: 4px 6px;
            box-shadow: 0 8px 25px rgba(0,0,0,0.7), 0 0 15px rgba(147, 51, 234, 0.25);
            opacity: 0;
            transform: translateY(10px);
            pointer-events: none;
            transition: all .3s cubic-bezier(0.2, 0.8, 0.2, 1);
        }
        .adm-scroll-dock.visible {
            opacity: 1;
            transform: translateY(0);
            pointer-events: auto;
        }
        .adm-scroll-btn {
            background: rgba(22, 17, 44, 0.8);
            border: 1px solid rgba(229, 0, 30, 0.35);
            color: #fff;
            width: 32px;
            height: 32px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            font-size: .8rem;
            font-family: 'Orbitron', sans-serif;
            font-weight: 900;
            transition: all .2s;
            box-shadow: 0 0 6px rgba(229,0,30,0.2);
        }
        .adm-scroll-btn:hover {
            background: #e5001e;
            border-color: #ff0055;
            box-shadow: 0 0 12px rgba(229,0,30,0.6);
            transform: scale(1.1);
        }
        .adm-scroll-pct {
            font-family: 'Orbitron', sans-serif;
            font-size: .68rem;
            font-weight: 800;
            color: #34d399;
            padding: 0 6px;
            text-shadow: 0 0 6px rgba(34,197,94,0.4);
            letter-spacing: .04em;
            user-select: none;
        }
    </style>
</head>
<body>

{{-- Sidebar --}}
<aside class="adm-sidebar">
    <div class="adm-brand">
        <div class="adm-brand-logo-wrap">
            <svg width="32" height="32" viewBox="0 0 100 100" fill="none">
                <polygon points="50,5 95,27.5 95,72.5 50,95 5,72.5 5,27.5" fill="#e5001e" opacity=".25"/>
                <polygon points="50,5 95,27.5 95,72.5 50,95 5,72.5 5,27.5" fill="none" stroke="#e5001e" stroke-width="4"/>
                <text x="50" y="63" text-anchor="middle" font-family="Orbitron,sans-serif" font-weight="900" font-size="28" fill="#e5001e">R</text>
            </svg>
        </div>
        <div>
            <div class="adm-brand-text">ROG CORE</div>
            <div class="adm-brand-sub"><span>●</span> COMMAND DECK</div>
        </div>
    </div>
    <nav class="adm-nav">
        <div class="adm-nav-label">Telemetrics</div>
        <a href="{{ route('admin.dashboard') }}" class="{{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"><rect x="3" y="3" width="7" height="7"/><rect x="14" y="3" width="7" height="7"/><rect x="3" y="14" width="7" height="7"/><rect x="14" y="14" width="7" height="7"/></svg>
            Dashboard
        </a>
        <div class="adm-nav-label">Dispatch Hub</div>
        <a href="{{ route('admin.orders') }}" class="{{ request()->routeIs('admin.orders*') && !request()->filled('date') ? 'active' : '' }}">
            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"><path d="M9 5H7a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h10a2 2 0 0 0 2-2V7a2 2 0 0 0-2-2h-2"/><rect x="9" y="3" width="6" height="4" rx="2"/><path d="M9 12h6M9 16h4"/></svg>
            All Orders
        </a>
        <a href="{{ route('admin.orders', ['date' => now()->format('Y-m-d')]) }}" class="{{ request()->filled('date') ? 'active' : '' }}">
            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"><rect x="3" y="4" width="18" height="18" rx="2"/><path d="M16 2v4M8 2v4M3 10h18"/></svg>
            Today's Feed
        </a>
        <div class="adm-nav-label">Inventory</div>
        <a href="{{ route('admin.products') }}" class="{{ request()->routeIs('admin.products*') ? 'active' : '' }}">
            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"><path d="M21 16V8a2 2 0 0 0-1-1.73l-7-4a2 2 0 0 0-2 0l-7 4A2 2 0 0 0 3 8v8a2 2 0 0 0 1 1.73l7 4a2 2 0 0 0 2 0l7-4A2 2 0 0 0 21 16z"/><polyline points="3.27 6.96 12 12.01 20.73 6.96"/><line x1="12" y1="22.08" x2="12" y2="12"/></svg>
            Hardware Grid
        </a>
    </nav>
    <div class="adm-sidebar-footer">
        <a href="{{ route('home') }}" target="_blank">
            <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"><path d="M18 13v6a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V8a2 2 0 0 1 2-2h6"/><polyline points="15 3 21 3 21 9"/><line x1="10" y1="14" x2="21" y2="3"/></svg>
            Launch Storefront ↗
        </a>
    </div>
</aside>

{{-- Main Deck --}}
<div class="adm-main">
    <div class="adm-topbar">
        <div class="adm-topbar-title">
            <span style="color:#e5001e;">//</span> @yield('page-title','Command Deck')
        </div>
        <div class="adm-topbar-right">
            <div class="adm-live"><span class="adm-live-dot"></span>LIVE TELEMETRY</div>
            <span style="font-family:'Orbitron',sans-serif; font-size:.78rem; color:#94a3b8; letter-spacing:.05em;">
                {{ now()->format('D, M j Y // H:i:s') }}
            </span>
        </div>
    </div>
    <div class="adm-content" id="admMainContent">
        @if(session('success'))
            <div style="background:rgba(34,197,94,.12);border:1px solid #22c55e;color:#86efac;padding:.75rem 1.2rem;border-radius:6px;font-size:.9rem;font-weight:700;margin-bottom:1.2rem;display:flex;align-items:center;gap:.6rem;box-shadow:0 0 15px rgba(34,197,94,0.2);">
                <span>✓</span> {{ session('success') }}
            </div>
        @endif
        @yield('content')
    </div>
</div>

{{-- ═══ Floating Quick-Scroll HUD Dock ═══════════════════════════════════════ --}}
<div class="adm-scroll-dock" id="admScrollDock">
    <button class="adm-scroll-btn" id="admScrollTop" title="Scroll Smoothly to Top">▲</button>
    <div class="adm-scroll-pct" id="admScrollPct">0%</div>
    <button class="adm-scroll-btn" id="admScrollBottom" title="Scroll Smoothly to Bottom">▼</button>
</div>

<script>
document.addEventListener('DOMContentLoaded', function () {
    const content = document.getElementById('admMainContent') || window;
    const dock = document.getElementById('admScrollDock');
    const pctLabel = document.getElementById('admScrollPct');
    const btnTop = document.getElementById('admScrollTop');
    const btnBottom = document.getElementById('admScrollBottom');

    function updateScroll() {
        const target = (content === window) ? document.documentElement : content;
        const scrollTop = target.scrollTop || window.scrollY || 0;
        const scrollHeight = target.scrollHeight || document.documentElement.scrollHeight;
        const clientHeight = target.clientHeight || window.innerHeight;
        const maxScroll = scrollHeight - clientHeight;

        if (maxScroll > 60) {
            const pct = Math.min(100, Math.max(0, Math.round((scrollTop / maxScroll) * 100)));
            if (pctLabel) pctLabel.textContent = pct + '%';
            if (scrollTop > 80) {
                dock.classList.add('visible');
            } else {
                dock.classList.remove('visible');
            }
        } else {
            dock.classList.remove('visible');
        }
    }

    if (content === window) {
        window.addEventListener('scroll', updateScroll, { passive: true });
    } else {
        content.addEventListener('scroll', updateScroll, { passive: true });
        window.addEventListener('scroll', updateScroll, { passive: true });
    }

    if (btnTop) {
        btnTop.addEventListener('click', function () {
            if (content !== window && content.scrollTo) {
                content.scrollTo({ top: 0, behavior: 'smooth' });
            }
            window.scrollTo({ top: 0, behavior: 'smooth' });
        });
    }

    if (btnBottom) {
        btnBottom.addEventListener('click', function () {
            const scrollTargetHeight = (content !== window) ? content.scrollHeight : document.documentElement.scrollHeight;
            if (content !== window && content.scrollTo) {
                content.scrollTo({ top: scrollTargetHeight, behavior: 'smooth' });
            }
            window.scrollTo({ top: document.documentElement.scrollHeight, behavior: 'smooth' });
        });
    }

    updateScroll();
});
</script>

</body>
</html>


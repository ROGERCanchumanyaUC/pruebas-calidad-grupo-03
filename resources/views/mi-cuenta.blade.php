@extends('layouts.app')

@section('title', 'Mi Cuenta')

@push('styles')
<style>
/* ══════ VARIABLES ══════ */
:root {
    --mcu-navy:  #060f2e;
    --mcu-blue:  #1a3bbd;
    --mcu-sky:   #0ea5e9;
    --mcu-light: #f0f4ff;
    --mcu-slate: #64748b;
    --mcu-text:  #0f172a;
    --mcu-card-border: #e2e8f0;
}

/* ══════ BASE ══════ */
.mcu {
    background: #f0f4ff;
    min-height: calc(100vh - 76px);
    font-family: 'Poppins', sans-serif;
    color: var(--mcu-text);
}

/* ══════ HERO ══════ */
.mcu-hero {
    background: linear-gradient(130deg, #040d1f 0%, #0c1d5c 50%, #0a3280 100%);
    padding: calc(76px + 44px) 0 90px;
    position: relative;
    overflow: hidden;
}
.mcu-hero::before {
    content: '';
    position: absolute; inset: 0;
    background: url("data:image/svg+xml,%3Csvg width='60' height='60' viewBox='0 0 60 60' xmlns='http://www.w3.org/2000/svg'%3E%3Cg fill='none' fill-rule='evenodd'%3E%3Cg fill='%23ffffff' fill-opacity='0.035'%3E%3Ccircle cx='30' cy='30' r='1.5'/%3E%3C/g%3E%3C/g%3E%3C/svg%3E");
}
.mcu-hero-blob {
    position: absolute; border-radius: 50%;
    filter: blur(90px); opacity: .18; pointer-events: none;
}
.mcu-hero-blob-1 { width: 500px; height: 500px; background: #3b82f6; top: -180px; right: -80px; }
.mcu-hero-blob-2 { width: 340px; height: 340px; background: #06b6d4; bottom: -100px; left: 8%; }
.mcu-hero-blob-3 { width: 200px; height: 200px; background: #818cf8; top: 40%; left: 40%; }

.mcu-hero-inner {
    max-width: 1180px; margin: 0 auto; padding: 0 36px;
    position: relative; z-index: 1;
    display: flex; align-items: center; justify-content: space-between;
    gap: 32px; flex-wrap: wrap;
}
.mcu-hero-left { display: flex; align-items: center; gap: 28px; }

/* Avatar ring */
.mcu-avatar-ring {
    position: relative; flex-shrink: 0;
}
.mcu-avatar-ring::before {
    content: '';
    position: absolute; inset: -4px;
    border-radius: 50%;
    background: conic-gradient(from 0deg, #60a5fa, #818cf8, #0ea5e9, #60a5fa);
    animation: mcuSpin 6s linear infinite;
}
@keyframes mcuSpin { to { transform: rotate(360deg); } }
.mcu-avatar {
    position: relative; z-index: 1;
    width: 90px; height: 90px; border-radius: 50%;
    background: linear-gradient(135deg, rgba(255,255,255,.18), rgba(255,255,255,.08));
    border: 2px solid rgba(255,255,255,.55);
    display: flex; align-items: center; justify-content: center;
    font-family: 'Noto Serif', serif;
    font-size: 34px; font-weight: 700; color: #fff;
    box-shadow: 0 8px 32px rgba(0,0,0,.35);
}

/* Hero info */
.mcu-hero-info { color: #fff; }
.mcu-hero-eyebrow {
    display: inline-flex; align-items: center; gap: 6px;
    font-size: 11px; font-weight: 700; letter-spacing: 1.2px;
    text-transform: uppercase; color: #93c5fd;
    background: rgba(147,197,253,.12); border: 1px solid rgba(147,197,253,.25);
    padding: 4px 12px; border-radius: 20px; margin-bottom: 10px;
}
.mcu-hero-name {
    font-family: 'Noto Serif', serif;
    font-size: clamp(24px, 3.2vw, 34px);
    font-weight: 700; line-height: 1.1; margin-bottom: 6px;
}
.mcu-hero-sub  { font-size: 13px; opacity: .65; margin-bottom: 14px; }
.mcu-hero-tags { display: flex; gap: 8px; flex-wrap: wrap; }
.mcu-hero-tag  {
    display: inline-flex; align-items: center; gap: 5px;
    background: rgba(255,255,255,.1);
    border: 1px solid rgba(255,255,255,.2);
    color: rgba(255,255,255,.88);
    font-size: 11px; font-weight: 600;
    padding: 4px 12px; border-radius: 20px;
    backdrop-filter: blur(8px);
}

/* Hero stats */
.mcu-hero-right {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 12px;
}
.mcu-hero-stat {
    background: rgba(255,255,255,.08);
    border: 1px solid rgba(255,255,255,.15);
    border-radius: 16px;
    padding: 16px 20px;
    backdrop-filter: blur(12px);
    display: flex; flex-direction: column; align-items: flex-start; gap: 6px;
    min-width: 110px;
    transition: background .2s;
}
.mcu-hero-stat:hover { background: rgba(255,255,255,.14); }
.mcu-stat-icon {
    width: 32px; height: 32px; border-radius: 9px;
    background: rgba(255,255,255,.12);
    display: flex; align-items: center; justify-content: center;
    color: #93c5fd;
}
.mcu-hero-stat strong {
    display: block;
    font-size: clamp(20px, 2.2vw, 26px);
    font-weight: 800; color: #fff; line-height: 1;
    white-space: nowrap; overflow: hidden; text-overflow: ellipsis;
    max-width: 100%;
}
.mcu-hero-stat span { font-size: 11px; color: rgba(255,255,255,.55); display: block; }

/* ══════ MAIN GRID ══════ */
.mcu-main {
    max-width: 1180px; margin: -48px auto 0;
    padding: 0 36px 80px;
    position: relative; z-index: 2;
    display: grid;
    grid-template-columns: 1fr 304px;
    gap: 24px;
    align-items: start;
}

/* ══════ TABS ══════ */
.mcu-tabs-bar {
    display: flex; gap: 0;
    background: #fff;
    border: 1px solid var(--mcu-card-border);
    border-radius: 16px;
    padding: 6px;
    margin-bottom: 20px;
    box-shadow: 0 4px 20px rgba(10,30,90,.07);
}
.mcu-tab {
    flex: 1; padding: 11px 16px;
    border: none; border-radius: 12px;
    background: transparent; cursor: pointer;
    font-family: inherit; font-size: 13px; font-weight: 600;
    color: #94a3b8; display: flex; align-items: center; justify-content: center;
    gap: 7px; transition: all .22s; position: relative;
}
.mcu-tab:hover { background: #f0f4ff; color: var(--mcu-blue); }
.mcu-tab.active {
    background: linear-gradient(135deg, #1a3bbd, #1e50e2);
    color: #fff;
    box-shadow: 0 4px 18px rgba(26,59,189,.35);
}
.mcu-tab .tab-badge {
    background: rgba(255,255,255,.25); color: inherit;
    font-size: 10px; font-weight: 700;
    padding: 1px 7px; border-radius: 20px; min-width: 20px; text-align: center;
}
.mcu-tab:not(.active) .tab-badge { background: #e8edff; color: var(--mcu-blue); }

.mcu-panel { display: none; }
.mcu-panel.active { display: block; }

/* ══════ COURSE CARDS ══════ */
.mcu-courses-grid {
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(256px, 1fr));
    gap: 20px;
}
.mcu-course-card {
    background: #fff;
    border: 1px solid var(--mcu-card-border);
    border-radius: 18px;
    overflow: hidden;
    box-shadow: 0 2px 16px rgba(10,30,90,.06);
    transition: transform .28s cubic-bezier(.22,1,.36,1), box-shadow .28s;
    display: flex; flex-direction: column;
}
.mcu-course-card:hover { transform: translateY(-5px); box-shadow: 0 16px 40px rgba(10,30,90,.13); }

.mcu-course-img {
    position: relative; height: 148px; overflow: hidden;
    background: linear-gradient(135deg, #1a3bbd, #0ea5e9);
}
.mcu-course-img img { width: 100%; height: 100%; object-fit: cover; transition: transform .45s; }
.mcu-course-card:hover .mcu-course-img img { transform: scale(1.07); }
.mcu-course-img::after {
    content: ''; position: absolute; inset: 0;
    background: linear-gradient(180deg, transparent 35%, rgba(6,9,30,.6));
}
.mcu-course-status-badge {
    position: absolute; top: 10px; right: 10px; z-index: 1;
    font-size: 10px; font-weight: 700; padding: 3px 10px;
    border-radius: 20px; text-transform: uppercase; letter-spacing: .5px;
}
.mcu-course-status-badge.pagado     { background: #dcfce7; color: #15803d; }
.mcu-course-status-badge.activo     { background: #dcfce7; color: #15803d; }
.mcu-course-status-badge.pendiente  { background: #fef3c7; color: #92400e; }
.mcu-course-status-badge.completado { background: #dbeafe; color: #1e40af; }
.mcu-course-status-badge.suspendido { background: #fee2e2; color: #991b1b; }

.mcu-course-body { padding: 16px 18px 18px; display: flex; flex-direction: column; flex: 1; }
.mcu-course-level {
    display: inline-block; font-size: 10px; font-weight: 700;
    padding: 3px 10px; border-radius: 20px; margin-bottom: 8px; letter-spacing: .3px;
}
.mcu-course-level.basico     { background: #dcfce7; color: #15803d; }
.mcu-course-level.intermedio { background: #fef3c7; color: #92400e; }
.mcu-course-level.avanzado   { background: #fee2e2; color: #991b1b; }

.mcu-course-name { font-size: 14px; font-weight: 700; color: var(--mcu-text); line-height: 1.35; margin-bottom: 12px; flex: 1; }

.mcu-progress-wrap { margin-bottom: 14px; }
.mcu-progress-label {
    display: flex; justify-content: space-between;
    font-size: 11px; color: var(--mcu-slate); font-weight: 600; margin-bottom: 5px;
}
.mcu-progress-bar  { height: 5px; background: #e8edff; border-radius: 10px; overflow: hidden; }
.mcu-progress-fill {
    height: 100%; border-radius: 10px;
    background: linear-gradient(90deg, #1a3bbd, #0ea5e9);
    transition: width .6s ease;
}

.mcu-course-footer {
    display: flex; align-items: center; justify-content: space-between;
    padding-top: 12px; border-top: 1px solid #f0f4ff;
}
.mcu-course-price { font-size: 17px; font-weight: 800; color: var(--mcu-text); }
.mcu-course-date  { font-size: 11px; color: #94a3b8; }

/* Empty state */
.mcu-empty {
    grid-column: 1 / -1;
    background: #fff;
    border: 2px dashed #c7d7ff;
    border-radius: 18px;
    padding: 72px 32px;
    text-align: center;
}
.mcu-empty-icon {
    width: 76px; height: 76px; border-radius: 22px;
    background: linear-gradient(135deg, #dbeafe, #e0e7ff);
    color: var(--mcu-blue);
    display: flex; align-items: center; justify-content: center;
    margin: 0 auto 20px;
    box-shadow: 0 8px 24px rgba(26,59,189,.12);
}
.mcu-empty h3 { font-family: 'Noto Serif', serif; font-size: 19px; font-weight: 700; color: var(--mcu-text); margin-bottom: 8px; }
.mcu-empty p  { font-size: 14px; color: var(--mcu-slate); margin-bottom: 26px; max-width: 340px; margin-left: auto; margin-right: auto; }
.mcu-empty-btn {
    display: inline-flex; align-items: center; gap: 7px;
    background: linear-gradient(135deg, #1a3bbd, #1e50e2); color: #fff;
    padding: 12px 26px; border-radius: 11px;
    font-size: 14px; font-weight: 700; text-decoration: none;
    box-shadow: 0 4px 18px rgba(26,59,189,.3);
    transition: box-shadow .2s, transform .2s;
}
.mcu-empty-btn:hover { transform: translateY(-2px); box-shadow: 0 8px 28px rgba(26,59,189,.4); }

/* ══════ SIDEBAR ══════ */
.mcu-sidebar { display: flex; flex-direction: column; gap: 16px; }

.mcu-card {
    background: #fff;
    border: 1px solid var(--mcu-card-border);
    border-radius: 18px;
    box-shadow: 0 2px 16px rgba(10,30,90,.06);
    overflow: hidden;
}
.mcu-card-head {
    padding: 15px 20px;
    background: linear-gradient(90deg, #f0f4ff, #fff);
    border-bottom: 1px solid #e8edff;
    display: flex; align-items: center; gap: 9px;
    font-size: 13.5px; font-weight: 700; color: var(--mcu-text);
}
.mcu-card-head svg { color: var(--mcu-blue); }
.mcu-card-body { padding: 18px 20px; }

/* Profile sidebar */
.mcu-profile-avatar {
    width: 68px; height: 68px; border-radius: 50%;
    background: linear-gradient(135deg, #1a3bbd, #0ea5e9);
    color: #fff; font-size: 24px; font-weight: 800;
    display: flex; align-items: center; justify-content: center;
    margin: 0 auto 12px; font-family: 'Noto Serif', serif;
    box-shadow: 0 6px 20px rgba(26,59,189,.25);
}
.mcu-profile-name  { font-family: 'Noto Serif', serif; font-size: 16px; font-weight: 700; text-align: center; margin-bottom: 3px; }
.mcu-profile-email { font-size: 11.5px; color: var(--mcu-slate); text-align: center; margin-bottom: 16px; word-break: break-word; }

.mcu-profile-row {
    display: flex; align-items: center;
    padding: 8px 0; border-bottom: 1px solid #f0f4ff;
    font-size: 12.5px; gap: 10px;
}
.mcu-profile-row:last-child { border-bottom: none; padding-bottom: 0; }
.mcu-profile-row svg { color: #a5b4fc; flex-shrink: 0; }
.mcu-profile-key   { font-weight: 600; color: #94a3b8; min-width: 68px; flex-shrink: 0; font-size: 11px; text-transform: uppercase; letter-spacing: .4px; }
.mcu-profile-val   { color: var(--mcu-text); font-weight: 500; word-break: break-word; }

/* Quick actions */
.mcu-quick-grid { display: grid; grid-template-columns: 1fr 1fr; gap: 10px; }
.mcu-quick-btn  {
    display: flex; flex-direction: column; align-items: center;
    gap: 8px; padding: 15px 10px; border-radius: 13px;
    background: #f0f4ff; border: 1px solid #dde6ff;
    text-decoration: none; color: #334155;
    font-size: 11.5px; font-weight: 600; text-align: center;
    transition: all .22s;
}
.mcu-quick-btn:hover { background: #dbeafe; border-color: #93c5fd; color: var(--mcu-blue); transform: translateY(-2px); }
.mcu-quick-btn svg { width: 20px; height: 20px; color: var(--mcu-blue); }

/* Achievements */
.mcu-logro {
    display: flex; align-items: center; gap: 12px;
    padding: 11px 0; border-bottom: 1px solid #f0f4ff;
}
.mcu-logro:last-child { border-bottom: none; padding-bottom: 0; }
.mcu-logro-icon {
    width: 40px; height: 40px; border-radius: 12px;
    display: flex; align-items: center; justify-content: center;
    flex-shrink: 0; font-size: 20px;
}
.mcu-logro-title { font-size: 13px; font-weight: 700; color: var(--mcu-text); }
.mcu-logro-desc  { font-size: 11px; color: var(--mcu-slate); }
.mcu-logro-lock  { opacity: .3; filter: grayscale(1); }

/* ══════ PERFIL TAB ══════ */
.mcu-profile-full {
    background: #fff; border: 1px solid var(--mcu-card-border);
    border-radius: 18px; overflow: hidden;
    box-shadow: 0 2px 16px rgba(10,30,90,.06);
}
.mcu-profile-full-head {
    background: linear-gradient(130deg, #040d1f 0%, #0c1d5c 50%, #0a3280 100%);
    padding: 32px 32px 0; display: flex; align-items: flex-end; gap: 20px;
    position: relative; overflow: hidden;
}
.mcu-profile-full-head::after {
    content: '';
    position: absolute; inset: 0;
    background: url("data:image/svg+xml,%3Csvg width='60' height='60' viewBox='0 0 60 60' xmlns='http://www.w3.org/2000/svg'%3E%3Cg fill='none'%3E%3Cg fill='%23ffffff' fill-opacity='0.04'%3E%3Ccircle cx='30' cy='30' r='1.5'/%3E%3C/g%3E%3C/g%3E%3C/svg%3E");
}
.mcu-profile-full-avatar {
    position: relative; z-index: 1;
    width: 84px; height: 84px; border-radius: 50%;
    background: rgba(255,255,255,.18); border: 3px solid rgba(255,255,255,.5);
    color: #fff; font-size: 30px; font-weight: 800;
    display: flex; align-items: center; justify-content: center;
    font-family: 'Noto Serif', serif; margin-bottom: -24px; flex-shrink: 0;
    box-shadow: 0 8px 24px rgba(0,0,0,.3);
}
.mcu-profile-full-name { position: relative; z-index: 1; color: #fff; font-family: 'Noto Serif', serif; font-size: 20px; font-weight: 700; margin-bottom: 28px; }
.mcu-profile-full-body { padding: 40px 32px 32px; }
.mcu-profile-grid { display: grid; grid-template-columns: 1fr 1fr; gap: 20px; }
.mcu-profile-field label {
    display: block; font-size: 10.5px; font-weight: 700; text-transform: uppercase;
    letter-spacing: .7px; color: #94a3b8; margin-bottom: 7px;
}
.mcu-profile-field .value {
    font-size: 14.5px; color: var(--mcu-text); font-weight: 500;
    padding: 10px 14px; background: #f0f4ff;
    border: 1px solid #dde6ff; border-radius: 10px;
}

/* ══════ RESPONSIVE ══════ */
@media (max-width: 900px) {
    .mcu-main    { grid-template-columns: 1fr; }
    .mcu-sidebar { order: -1; display: grid; grid-template-columns: 1fr 1fr; }
    .mcu-hero-inner { flex-direction: column; align-items: flex-start; gap: 20px; }
    .mcu-hero-right { grid-template-columns: repeat(4, 1fr); width: 100%; }
}
@media (max-width: 640px) {
    .mcu-hero    { padding: calc(76px + 28px) 0 72px; }
    .mcu-hero-inner { padding: 0 20px; }
    .mcu-main    { padding: 0 16px 60px; }
    .mcu-sidebar { grid-template-columns: 1fr; }
    .mcu-profile-grid { grid-template-columns: 1fr; }
    .mcu-tabs-bar { flex-direction: column; border-radius: 14px; }
    .mcu-hero-right { grid-template-columns: 1fr 1fr; }
    .mcu-hero-stat { padding: 12px 14px; }
}
</style>
@endpush

@section('content')
@php
$courseImages = [
    'bpm'          => 'https://images.unsplash.com/photo-1486297678162-eb2a19b0a32d?w=480&h=200&fit=crop',
    'iso'          => 'https://images.unsplash.com/photo-1454165804606-c3d57bc86b40?w=480&h=200&fit=crop',
    'microbiolog'  => 'https://images.unsplash.com/photo-1582719471384-894fbb16e074?w=480&h=200&fit=crop',
    'artesanal'        => 'https://images.unsplash.com/photo-1559598467-f8b76c8155d0?w=480&h=200&fit=crop',
    'fermentado'        => 'https://images.unsplash.com/photo-1488477181946-6428a0291777?w=480&h=200&fit=crop',
    'haccp'        => 'https://images.unsplash.com/photo-1607623814075-e51df1bdc82f?w=480&h=200&fit=crop',
    'pasteur'      => 'https://images.unsplash.com/photo-1550583724-b2692b85b150?w=480&h=200&fit=crop',
    'fisicoquim'   => 'https://images.unsplash.com/photo-1576867757603-05b134ebc379?w=480&h=200&fit=crop',
    'inocuidad'    => 'https://images.unsplash.com/photo-1581091226825-a6a2a5aee158?w=480&h=200&fit=crop',
    'default'      => 'https://images.unsplash.com/photo-1550583724-b2692b85b150?w=480&h=200&fit=crop',
];

function getCourseImg($name, $map) {
    $lower = mb_strtolower($name);
    foreach ($map as $key => $url) {
        if (str_contains($lower, $key)) return $url;
    }
    return $map['default'];
}

$progreso = ['pendiente' => 10, 'pagado' => 45, 'completado' => 100];
@endphp

<div class="mcu">

    {{-- ══ HERO ══ --}}
    <div class="mcu-hero">
        <div class="mcu-hero-blob mcu-hero-blob-1"></div>
        <div class="mcu-hero-blob mcu-hero-blob-2"></div>
        <div class="mcu-hero-blob mcu-hero-blob-3"></div>
        <div class="mcu-hero-inner">
            <div class="mcu-hero-left">
                <div class="mcu-avatar-ring">
                    <div class="mcu-avatar">{{ strtoupper(substr($user->name, 0, 1)) }}</div>
                </div>
                <div class="mcu-hero-info">
                    @if (session('status'))
                        <div style="font-size:12px;background:rgba(255,255,255,.15);padding:5px 12px;border-radius:20px;color:#fff;margin-bottom:8px;display:inline-block;">
                            ✓ {{ session('status') }}
                        </div>
                    @endif
                    <div class="mcu-hero-eyebrow">
                        <svg width="10" height="10" fill="currentColor" viewBox="0 0 24 24"><path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z"/></svg>
                        Panel de Aprendizaje
                    </div>
                    <div class="mcu-hero-name">{{ \Illuminate\Support\Str::words($user->name, 3, '') }}</div>
                    <div class="mcu-hero-sub">{{ $user->email }}</div>
                    <div class="mcu-hero-tags">
                        <span class="mcu-hero-tag">
                            <svg width="11" height="11" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"/><circle cx="12" cy="7" r="4"/></svg>
                            Estudiante
                        </span>
                        <span class="mcu-hero-tag">
                            <svg width="11" height="11" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><rect x="3" y="4" width="18" height="18" rx="2"/><line x1="3" y1="10" x2="21" y2="10"/></svg>
                            Miembro desde {{ $user->created_at->format('M Y') }}
                        </span>
                        @if ($user->dni)
                        <span class="mcu-hero-tag">
                            <svg width="11" height="11" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><rect x="1" y="4" width="22" height="16" rx="2"/><line x1="1" y1="10" x2="23" y2="10"/></svg>
                            DNI {{ $user->dni }}
                        </span>
                        @endif
                    </div>
                </div>
            </div>
            <div class="mcu-hero-right">
                <div class="mcu-hero-stat">
                    <div class="mcu-stat-icon">
                        <svg width="15" height="15" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M2 3h6a4 4 0 0 1 4 4v14a3 3 0 0 0-3-3H2z"/><path d="M22 3h-6a4 4 0 0 0-4 4v14a3 3 0 0 1 3-3h7z"/></svg>
                    </div>
                    <strong>{{ $enrollments->count() }}</strong>
                    <span>Inscritos</span>
                </div>
                <div class="mcu-hero-stat">
                    <div class="mcu-stat-icon">
                        <svg width="15" height="15" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><circle cx="9" cy="21" r="1"/><circle cx="20" cy="21" r="1"/><path d="M1 1h4l2.68 13.39a2 2 0 0 0 2 1.61h9.72a2 2 0 0 0 2-1.61L23 6H6"/></svg>
                    </div>
                    <strong>{{ $enrollments->whereIn('status', ['activo', 'completado'])->count() }}</strong>
                    <span>Pagados</span>
                </div>
                <div class="mcu-hero-stat">
                    <div class="mcu-stat-icon">
                        <svg width="15" height="15" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"/><polyline points="22 4 12 14.01 9 11.01"/></svg>
                    </div>
                    <strong>{{ $enrollments->where('status','completado')->count() }}</strong>
                    <span>Completados</span>
                </div>
                <div class="mcu-hero-stat">
                    <div class="mcu-stat-icon">
                        <svg width="15" height="15" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><line x1="12" y1="1" x2="12" y2="23"/><path d="M17 5H9.5a3.5 3.5 0 0 0 0 7h5a3.5 3.5 0 0 1 0 7H6"/></svg>
                    </div>
                    <strong>S/ {{ number_format($enrollments->whereIn('status', ['activo', 'completado'])->sum(fn($e) => $e->course->price ?? 0), 0) }}</strong>
                    <span>Invertido</span>
                </div>
            </div>
        </div>
    </div>

    {{-- ══ MAIN ══ --}}
    <div class="mcu-main">

        {{-- Columna principal --}}
        <div>
            {{-- Tabs --}}
            <div class="mcu-tabs-bar" role="tablist">
                <button class="mcu-tab active" onclick="switchTab('cursos', this)">
                    <svg width="15" height="15" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M2 3h6a4 4 0 0 1 4 4v14a3 3 0 0 0-3-3H2z"/><path d="M22 3h-6a4 4 0 0 0-4 4v14a3 3 0 0 1 3-3h7z"/></svg>
                    Mis Cursos
                    <span class="tab-badge">{{ $enrollments->count() }}</span>
                </button>
                <button class="mcu-tab" onclick="switchTab('perfil', this)">
                    <svg width="15" height="15" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"/><circle cx="12" cy="7" r="4"/></svg>
                    Mi Perfil
                </button>
                <button class="mcu-tab" onclick="switchTab('logros', this)">
                    <svg width="15" height="15" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><circle cx="12" cy="8" r="6"/><path d="M15.477 12.89L17 22l-5-3-5 3 1.523-9.11"/></svg>
                    Logros
                </button>
            </div>

            {{-- Panel: Mis Cursos --}}
            <div id="panel-cursos" class="mcu-panel active">
                @if ($enrollments->isEmpty())
                    <div class="mcu-courses-grid">
                        <div class="mcu-empty">
                            <div class="mcu-empty-icon">
                                <svg width="32" height="32" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24"><path d="M2 3h6a4 4 0 0 1 4 4v14a3 3 0 0 0-3-3H2z"/><path d="M22 3h-6a4 4 0 0 0-4 4v14a3 3 0 0 1 3-3h7z"/></svg>
                            </div>
                            <h3>Aún no tienes cursos inscritos</h3>
                            <p>Explora nuestro catálogo de 9 programas especializados en el sector alimentario peruano.</p>
                            <a href="{{ route('cursos') }}" class="mcu-empty-btn">
                                <svg width="15" height="15" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><polyline points="9 18 15 12 9 6"/></svg>
                                Explorar catálogo
                            </a>
                        </div>
                    </div>
                @else
                    <div class="mcu-courses-grid">
                        @foreach ($enrollments as $e)
                        @php
                            $img  = getCourseImg($e->course->name, $courseImages);
                            $pct  = (int) ($e->progress ?? 0);
                        @endphp
                        <div class="mcu-course-card">
                            <div class="mcu-course-img">
                                <img src="{{ $img }}" alt="{{ $e->course->name }}" loading="lazy">
                                <span class="mcu-course-status-badge {{ $e->status }}">{{ ucfirst($e->status) }}</span>
                            </div>
                            <div class="mcu-course-body">
                                <span class="mcu-course-level {{ strtolower($e->course->level) }}">{{ ucfirst($e->course->level) }}</span>
                                <div class="mcu-course-name">{{ $e->course->name }}</div>
                                <div class="mcu-progress-wrap">
                                    <div class="mcu-progress-label">
                                        <span>Progreso</span>
                                        <span>{{ $pct }}%</span>
                                    </div>
                                    <div class="mcu-progress-bar">
                                        <div class="mcu-progress-fill" style="width:{{ $pct }}%"></div>
                                    </div>
                                </div>
                                <div class="mcu-course-footer" style="margin-bottom: 12px; border-bottom: 1px solid #f1f5f9; padding-bottom: 12px;">
                                    <span class="mcu-course-price">S/ {{ number_format($e->course->price, 0) }}</span>
                                    <span class="mcu-course-date">{{ $e->created_at->format('d/m/Y') }}</span>
                                </div>
                                <div style="margin-top: auto;">
                                    @if(in_array($e->status, ['activo', 'completado']))
                                        <a href="{{ route('mi-cuenta.cursos.show', $e->course->slug) }}" class="mcu-empty-btn" style="display:flex;justify-content:center;font-size:13px;padding:10px 12px;border-radius:9px;text-decoration:none;">
                                            Continuar Aprendiendo
                                        </a>
                                    @elseif($e->status === 'pendiente')
                                        <a href="{{ route('checkout') }}" class="mcu-empty-btn" style="display:flex;justify-content:center;font-size:13px;padding:10px 12px;border-radius:9px;background:linear-gradient(135deg,#b45309,#d97706);box-shadow:0 4px 14px rgba(180,83,9,.3);text-decoration:none;">
                                            Proceder al Pago
                                        </a>
                                    @elseif($e->status === 'suspendido')
                                        <button disabled class="mcu-empty-btn" style="display:flex;justify-content:center;width:100%;font-size:13px;padding:10px 12px;border-radius:9px;background:#94a3b8;cursor:not-allowed;opacity:.8;border:none;">
                                            Acceso Suspendido
                                        </button>
                                    @endif
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>

                    <div style="margin-top:20px;text-align:center;">
                        <a href="{{ route('cursos') }}" style="display:inline-flex;align-items:center;gap:7px;background:#fff;border:1.5px solid #bfdbfe;color:#1e40af;padding:11px 24px;border-radius:10px;font-size:13.5px;font-weight:700;text-decoration:none;">
                            <svg width="14" height="14" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><polyline points="9 18 15 12 9 6"/></svg>
                            Inscribirme en más cursos
                        </a>
                    </div>
                @endif
            </div>

            {{-- Panel: Mi Perfil --}}
            <div id="panel-perfil" class="mcu-panel">
                <div class="mcu-profile-full">
                    <div class="mcu-profile-full-head">
                        <div class="mcu-profile-full-avatar">{{ strtoupper(substr($user->name, 0, 1)) }}</div>
                        <div class="mcu-profile-full-name">{{ $user->name }}</div>
                    </div>
                    <div class="mcu-profile-full-body">
                        <div class="mcu-profile-grid">
                            <div class="mcu-profile-field">
                                <label>Nombre completo</label>
                                <div class="value">{{ $user->name }}</div>
                            </div>
                            <div class="mcu-profile-field">
                                <label>Correo electrónico</label>
                                <div class="value">{{ $user->email }}</div>
                            </div>
                            <div class="mcu-profile-field">
                                <label>DNI / RUC</label>
                                <div class="value">{{ $user->dni ?? 'No registrado' }}</div>
                            </div>
                            <div class="mcu-profile-field">
                                <label>Teléfono</label>
                                <div class="value">{{ $user->phone ?? 'No registrado' }}</div>
                            </div>
                            <div class="mcu-profile-field">
                                <label>Miembro desde</label>
                                <div class="value">{{ $user->created_at->format('d \d\e F \d\e Y') }}</div>
                            </div>
                            <div class="mcu-profile-field">
                                <label>Estado de cuenta</label>
                                <div class="value" style="color:#15803d;">
                                    <svg width="14" height="14" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24" style="vertical-align:middle;margin-right:4px;"><path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"/><polyline points="22 4 12 14.01 9 11.01"/></svg>
                                    Activa
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Panel: Logros --}}
            <div id="panel-logros" class="mcu-panel">
                <div class="mcu-card">
                    <div class="mcu-card-head">
                        <svg width="16" height="16" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><circle cx="12" cy="8" r="6"/><path d="M15.477 12.89L17 22l-5-3-5 3 1.523-9.11"/></svg>
                        Mis logros
                    </div>
                    <div class="mcu-card-body">
                        <div class="mcu-logro {{ $enrollments->count() >= 1 ? '' : 'mcu-logro-lock' }}">
                            <div class="mcu-logro-icon" style="background:#fef3c7;">🎓</div>
                            <div>
                                <div class="mcu-logro-title">Primer Paso</div>
                                <div class="mcu-logro-desc">Inscríbete en tu primer curso</div>
                            </div>
                            @if ($enrollments->count() >= 1)
                                <svg style="margin-left:auto;color:#22c55e" width="18" height="18" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"/><polyline points="22 4 12 14.01 9 11.01"/></svg>
                            @endif
                        </div>
                        <div class="mcu-logro {{ $enrollments->where('status','pagado')->count() >= 1 ? '' : 'mcu-logro-lock' }}">
                            <div class="mcu-logro-icon" style="background:#dcfce7;">💳</div>
                            <div>
                                <div class="mcu-logro-title">Inversión en ti</div>
                                <div class="mcu-logro-desc">Realiza tu primer pago</div>
                            </div>
                            @if ($enrollments->where('status','pagado')->count() >= 1)
                                <svg style="margin-left:auto;color:#22c55e" width="18" height="18" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"/><polyline points="22 4 12 14.01 9 11.01"/></svg>
                            @endif
                        </div>
                        <div class="mcu-logro {{ $enrollments->count() >= 3 ? '' : 'mcu-logro-lock' }}">
                            <div class="mcu-logro-icon" style="background:#dbeafe;">📚</div>
                            <div>
                                <div class="mcu-logro-title">Aprendiz Dedicado</div>
                                <div class="mcu-logro-desc">Inscríbete en 3 o más cursos</div>
                            </div>
                            @if ($enrollments->count() >= 3)
                                <svg style="margin-left:auto;color:#22c55e" width="18" height="18" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"/><polyline points="22 4 12 14.01 9 11.01"/></svg>
                            @endif
                        </div>
                        <div class="mcu-logro {{ $enrollments->where('status','completado')->count() >= 1 ? '' : 'mcu-logro-lock' }}">
                            <div class="mcu-logro-icon" style="background:#f3e8ff;">🏆</div>
                            <div>
                                <div class="mcu-logro-title">Certificado</div>
                                <div class="mcu-logro-desc">Completa tu primer curso</div>
                            </div>
                            @if ($enrollments->where('status','completado')->count() >= 1)
                                <svg style="margin-left:auto;color:#22c55e" width="18" height="18" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"/><polyline points="22 4 12 14.01 9 11.01"/></svg>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- ══ SIDEBAR ══ --}}
        <aside class="mcu-sidebar">

            {{-- Perfil rápido --}}
            <div class="mcu-card">
                <div class="mcu-card-head">
                    <svg width="15" height="15" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"/><circle cx="12" cy="7" r="4"/></svg>
                    Perfil
                </div>
                <div class="mcu-card-body">
                    <div class="mcu-profile-avatar">{{ strtoupper(substr($user->name, 0, 1)) }}</div>
                    <div class="mcu-profile-name">{{ \Illuminate\Support\Str::limit($user->name, 26) }}</div>
                    <div class="mcu-profile-email">{{ $user->email }}</div>
                    <div class="mcu-profile-row">
                        <svg width="13" height="13" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><rect x="1" y="4" width="22" height="16" rx="2"/><line x1="1" y1="10" x2="23" y2="10"/></svg>
                        <span class="mcu-profile-key">DNI</span>
                        <span class="mcu-profile-val">{{ $user->dni ?? '—' }}</span>
                    </div>
                    <div class="mcu-profile-row">
                        <svg width="13" height="13" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07A19.5 19.5 0 0 1 4.69 12a19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 3.6 1.27h3a2 2 0 0 1 2 1.72c.127.96.361 1.903.7 2.81a2 2 0 0 1-.45 2.11L7.91 8.96a16 16 0 0 0 6.13 6.13l.96-.96a2 2 0 0 1 2.11-.45c.907.339 1.85.573 2.81.7A2 2 0 0 1 22 16.92z"/></svg>
                        <span class="mcu-profile-key">Teléfono</span>
                        <span class="mcu-profile-val">{{ $user->phone ?? '—' }}</span>
                    </div>
                    <div class="mcu-profile-row">
                        <svg width="13" height="13" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><rect x="3" y="4" width="18" height="18" rx="2"/><line x1="3" y1="10" x2="21" y2="10"/></svg>
                        <span class="mcu-profile-key">Miembro</span>
                        <span class="mcu-profile-val">{{ $user->created_at->format('d/m/Y') }}</span>
                    </div>
                </div>
            </div>

            {{-- Acciones rápidas --}}
            <div class="mcu-card">
                <div class="mcu-card-head">
                    <svg width="15" height="15" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><circle cx="12" cy="12" r="10"/><line x1="12" y1="8" x2="12" y2="12"/><line x1="12" y1="16" x2="12.01" y2="16"/></svg>
                    Acciones rápidas
                </div>
                <div class="mcu-card-body">
                    <div class="mcu-quick-grid">
                        <a href="{{ route('cursos') }}" class="mcu-quick-btn">
                            <svg fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M2 3h6a4 4 0 0 1 4 4v14a3 3 0 0 0-3-3H2z"/><path d="M22 3h-6a4 4 0 0 0-4 4v14a3 3 0 0 1 3-3h7z"/></svg>
                            Ver cursos
                        </a>
                        <a href="{{ route('checkout') }}" class="mcu-quick-btn">
                            <svg fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><circle cx="9" cy="21" r="1"/><circle cx="20" cy="21" r="1"/><path d="M1 1h4l2.68 13.39a2 2 0 0 0 2 1.61h9.72a2 2 0 0 0 2-1.61L23 6H6"/></svg>
                            Carrito
                        </a>
                        <a href="{{ route('contacto') }}" class="mcu-quick-btn">
                            <svg fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M21 15a2 2 0 0 1-2 2H7l-4 4V5a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2z"/></svg>
                            Soporte
                        </a>
                        <a href="{{ route('nosotros') }}" class="mcu-quick-btn">
                            <svg fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"/></svg>
                            Nosotros
                        </a>
                    </div>
                </div>
            </div>

            {{-- Progreso general --}}
            <div class="mcu-card">
                <div class="mcu-card-head">
                    <svg width="15" height="15" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><polyline points="22 12 18 12 15 21 9 3 6 12 2 12"/></svg>
                    Tu progreso
                </div>
                <div class="mcu-card-body">
                    @php $total = $enrollments->count(); $paid = $enrollments->whereIn('status', ['activo', 'completado'])->count(); $done = $enrollments->where('status','completado')->count(); @endphp
                    @if ($total === 0)
                        <p style="font-size:13px;color:#94a3b8;text-align:center;padding:8px 0;">Sin cursos inscritos aún.</p>
                    @else
                        <div style="margin-bottom:14px;">
                            <div style="display:flex;justify-content:space-between;font-size:11.5px;color:#64748b;font-weight:600;margin-bottom:6px;">
                                <span>Cursos pagados</span><span style="color:#1a3bbd;font-weight:700;">{{ $paid }}/{{ $total }}</span>
                            </div>
                            <div style="height:6px;background:#e8edff;border-radius:10px;overflow:hidden;">
                                <div style="width:{{ $total > 0 ? round($paid/$total*100) : 0 }}%;height:100%;background:linear-gradient(90deg,#1a3bbd,#0ea5e9);border-radius:10px;transition:width .6s;"></div>
                            </div>
                        </div>
                        <div>
                            <div style="display:flex;justify-content:space-between;font-size:11.5px;color:#64748b;font-weight:600;margin-bottom:6px;">
                                <span>Cursos completados</span><span style="color:#15803d;font-weight:700;">{{ $done }}/{{ $total }}</span>
                            </div>
                            <div style="height:6px;background:#e8edff;border-radius:10px;overflow:hidden;">
                                <div style="width:{{ $total > 0 ? round($done/$total*100) : 0 }}%;height:100%;background:linear-gradient(90deg,#22c55e,#86efac);border-radius:10px;transition:width .6s;"></div>
                            </div>
                        </div>
                    @endif
                </div>
            </div>

        </aside>
    </div>
</div>
@endsection

@push('scripts')
<script>
function switchTab(name, btn) {
    document.querySelectorAll('.mcu-tab').forEach(t => t.classList.remove('active'));
    document.querySelectorAll('.mcu-panel').forEach(p => p.classList.remove('active'));
    btn.classList.add('active');
    document.getElementById('panel-' + name).classList.add('active');
}
</script>
@endpush

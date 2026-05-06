@extends('layouts.app')

@section('title', 'Mi Cuenta')

@push('styles')
<style>
.mc-page {
    max-width: 1100px;
    margin: 0 auto;
    padding: 48px 28px 80px;
    font-family: 'Poppins', sans-serif;
}

/* Welcome banner */
.mc-banner {
    background: linear-gradient(135deg, #0f2a5e 0%, #1e40af 55%, #0ea5e9 100%);
    border-radius: 18px;
    padding: 32px 36px;
    color: #fff;
    display: flex;
    align-items: center;
    justify-content: space-between;
    margin-bottom: 32px;
    position: relative;
    overflow: hidden;
}
.mc-banner::before {
    content: '';
    position: absolute;
    top: -50px; right: -50px;
    width: 200px; height: 200px;
    border-radius: 50%;
    background: rgba(255,255,255,.06);
}
.mc-banner h1 { font-size: 22px; font-weight: 800; margin-bottom: 4px; }
.mc-banner p  { font-size: 13.5px; opacity: .8; }
.mc-avatar-lg {
    width: 60px; height: 60px;
    border-radius: 50%;
    background: rgba(255,255,255,.2);
    border: 2px solid rgba(255,255,255,.4);
    display: flex; align-items: center; justify-content: center;
    font-size: 22px; font-weight: 800; color: #fff;
    flex-shrink: 0;
}

/* Stats row */
.mc-stats {
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(180px, 1fr));
    gap: 16px;
    margin-bottom: 32px;
}
.mc-stat {
    background: #fff;
    border: 1px solid #e2e8f0;
    border-radius: 14px;
    padding: 18px 20px;
    display: flex;
    align-items: center;
    gap: 14px;
    box-shadow: 0 2px 10px rgba(0,0,0,.04);
}
.mc-stat-icon {
    width: 42px; height: 42px;
    border-radius: 10px;
    background: #dbeafe;
    display: flex; align-items: center; justify-content: center;
    color: #1e40af; flex-shrink: 0;
}
.mc-stat-val  { font-size: 24px; font-weight: 800; color: #0f172a; line-height: 1; }
.mc-stat-lbl  { font-size: 12px; color: #64748b; margin-top: 3px; }

/* Section title */
.mc-section-title {
    font-size: 17px; font-weight: 700; color: #0f172a;
    margin: 0 0 16px;
    display: flex; align-items: center; gap: 8px;
}

/* Enrollments */
.mc-enroll-grid {
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(280px, 1fr));
    gap: 18px;
    margin-bottom: 36px;
}
.mc-enroll-card {
    background: #fff;
    border: 1px solid #e2e8f0;
    border-radius: 14px;
    padding: 20px;
    box-shadow: 0 2px 10px rgba(0,0,0,.04);
    position: relative;
    overflow: hidden;
}
.mc-enroll-card::before {
    content: '';
    position: absolute;
    top: 0; left: 0; right: 0;
    height: 3px;
    background: linear-gradient(90deg, #2563eb, #0ea5e9);
}
.mc-enroll-name  { font-size: 14.5px; font-weight: 700; color: #0f172a; margin-bottom: 8px; line-height: 1.35; }
.mc-enroll-meta  { display: flex; gap: 8px; flex-wrap: wrap; margin-bottom: 12px; }
.mc-enroll-tag   {
    font-size: 11px; font-weight: 600; padding: 3px 10px;
    border-radius: 20px; background: #dbeafe; color: #1e40af;
}
.mc-enroll-tag.basico     { background: #dcfce7; color: #15803d; }
.mc-enroll-tag.intermedio { background: #fef3c7; color: #92400e; }
.mc-enroll-tag.avanzado   { background: #fee2e2; color: #991b1b; }

.mc-enroll-footer {
    display: flex; align-items: center; justify-content: space-between;
    padding-top: 12px; border-top: 1px solid #f1f5f9;
}
.mc-price { font-size: 18px; font-weight: 800; color: #0f172a; }
.mc-status {
    font-size: 11px; font-weight: 700; padding: 4px 10px; border-radius: 20px;
}
.mc-status.pendiente  { background: #fef3c7; color: #92400e; }
.mc-status.pagado     { background: #dcfce7; color: #15803d; }
.mc-status.completado { background: #dbeafe; color: #1e40af; }

/* Profile card */
.mc-profile {
    background: #fff;
    border: 1px solid #e2e8f0;
    border-radius: 14px;
    padding: 24px;
    box-shadow: 0 2px 10px rgba(0,0,0,.04);
    margin-bottom: 32px;
}
.mc-profile-row {
    display: flex; align-items: center;
    padding: 10px 0; border-bottom: 1px solid #f8fafc;
    font-size: 14px;
}
.mc-profile-row:last-child { border-bottom: none; }
.mc-profile-row label { width: 130px; font-weight: 600; color: #64748b; flex-shrink: 0; }
.mc-profile-row span  { color: #0f172a; }

/* Empty state */
.mc-empty {
    text-align: center; padding: 48px 24px;
    background: #f8fafc; border-radius: 14px;
    border: 1.5px dashed #e2e8f0;
}
.mc-empty p  { color: #64748b; font-size: 14px; margin-bottom: 16px; }

/* CTA button */
.mc-btn {
    display: inline-flex; align-items: center; gap: 6px;
    background: #1e40af; color: #fff;
    padding: 11px 22px; border-radius: 10px;
    font-size: 14px; font-weight: 600;
    text-decoration: none; transition: background .18s;
}
.mc-btn:hover { background: #0f2a5e; }

@media(max-width:640px) {
    .mc-banner { flex-direction: column; align-items: flex-start; gap: 16px; padding: 24px; }
    .mc-page   { padding: 32px 16px 60px; }
}
</style>
@endpush

@section('content')
<div class="mc-page">

    {{-- Banner --}}
    <div class="mc-banner">
        <div>
            @if (session('status'))
                <p style="font-size:13px;opacity:.8;margin-bottom:4px;">{{ session('status') }}</p>
            @endif
            <h1>Hola, {{ \Illuminate\Support\Str::words($user->name, 2, '') }} 👋</h1>
            <p>Bienvenido a tu panel de usuario · JM y JS Alimentos Lácteos</p>
        </div>
        <div class="mc-avatar-lg">{{ strtoupper(substr($user->name, 0, 1)) }}</div>
    </div>

    {{-- Stats --}}
    <div class="mc-stats">
        <div class="mc-stat">
            <div class="mc-stat-icon">
                <svg width="20" height="20" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path d="M2 3h6a4 4 0 0 1 4 4v14a3 3 0 0 0-3-3H2z"/>
                    <path d="M22 3h-6a4 4 0 0 0-4 4v14a3 3 0 0 1 3-3h7z"/>
                </svg>
            </div>
            <div>
                <div class="mc-stat-val">{{ $enrollments->count() }}</div>
                <div class="mc-stat-lbl">Cursos inscritos</div>
            </div>
        </div>
        <div class="mc-stat">
            <div class="mc-stat-icon">
                <svg width="20" height="20" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"/><polyline points="22 4 12 14.01 9 11.01"/>
                </svg>
            </div>
            <div>
                <div class="mc-stat-val">{{ $enrollments->where('status', 'completado')->count() }}</div>
                <div class="mc-stat-lbl">Completados</div>
            </div>
        </div>
        <div class="mc-stat">
            <div class="mc-stat-icon" style="background:#fef3c7;color:#d97706;">
                <svg width="20" height="20" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <circle cx="12" cy="12" r="10"/><polyline points="12 6 12 12 16 14"/>
                </svg>
            </div>
            <div>
                <div class="mc-stat-val">{{ $enrollments->where('status', 'pendiente')->count() }}</div>
                <div class="mc-stat-lbl">Pendientes</div>
            </div>
        </div>
    </div>

    {{-- Mis cursos --}}
    <div class="mc-section-title">
        <svg width="18" height="18" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
            <path d="M2 3h6a4 4 0 0 1 4 4v14a3 3 0 0 0-3-3H2z"/>
            <path d="M22 3h-6a4 4 0 0 0-4 4v14a3 3 0 0 1 3-3h7z"/>
        </svg>
        Mis cursos inscritos
    </div>

    @if ($enrollments->isEmpty())
        <div class="mc-empty">
            <p>Aún no te has inscrito en ningún curso.</p>
            <a href="{{ route('cursos') }}" class="mc-btn">
                <svg width="14" height="14" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><polyline points="9 18 15 12 9 6"/></svg>
                Ver cursos disponibles
            </a>
        </div>
    @else
        <div class="mc-enroll-grid">
            @foreach ($enrollments as $e)
                <div class="mc-enroll-card">
                    <div class="mc-enroll-name">{{ $e->course_name }}</div>
                    <div class="mc-enroll-meta">
                        <span class="mc-enroll-tag {{ strtolower($e->level) }}">{{ ucfirst($e->level) }}</span>
                        <span class="mc-enroll-tag">Inscrito {{ $e->created_at->format('d/m/Y') }}</span>
                    </div>
                    <div class="mc-enroll-footer">
                        <span class="mc-price">S/ {{ number_format($e->price, 0) }}</span>
                        <span class="mc-status {{ $e->status }}">{{ ucfirst($e->status) }}</span>
                    </div>
                </div>
            @endforeach
        </div>
    @endif

    {{-- Perfil --}}
    <div class="mc-section-title" style="margin-top:8px;">
        <svg width="18" height="18" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
            <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"/>
            <circle cx="12" cy="7" r="4"/>
        </svg>
        Mi perfil
    </div>
    <div class="mc-profile">
        <div class="mc-profile-row"><label>Nombre</label><span>{{ $user->name }}</span></div>
        <div class="mc-profile-row"><label>Correo</label><span>{{ $user->email }}</span></div>
        <div class="mc-profile-row"><label>DNI / RUC</label><span>{{ $user->dni ?? '—' }}</span></div>
        <div class="mc-profile-row"><label>Teléfono</label><span>{{ $user->phone ?? '—' }}</span></div>
        <div class="mc-profile-row"><label>Miembro desde</label><span>{{ $user->created_at->format('d \d\e F \d\e Y') }}</span></div>
    </div>

    <a href="{{ route('cursos') }}" class="mc-btn">
        <svg width="14" height="14" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><polyline points="9 18 15 12 9 6"/></svg>
        Explorar más cursos
    </a>

</div>
@endsection

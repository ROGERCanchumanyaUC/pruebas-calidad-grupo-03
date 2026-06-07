@extends('layouts.admin')

@section('title', 'Dashboard')
@section('page-title', 'Dashboard')

@section('content')

{{-- Welcome banner --}}
<div class="welcome-banner">
    <div class="welcome-text">
        <h2>Bienvenido, {{ \Illuminate\Support\Str::words(auth()->user()->name, 2, '') }} 👋</h2>
        <p>Panel de administración · JM y JS Alimentos</p>
    </div>
    <div class="welcome-logo">
        @if (file_exists(public_path('img/logo-jmjs.png')))
            <img src="{{ asset('img/logo-jmjs.png') }}" alt="Logo">
        @else
            <svg width="40" height="40" fill="none" stroke="white" stroke-width="1.5" viewBox="0 0 24 24">
                <path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/>
            </svg>
        @endif
    </div>
</div>

{{-- Stat cards --}}
<div class="stats-grid">
    <div class="stat-card blue">
        <div class="stat-icon blue">
            <svg width="24" height="24" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                <path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"/>
                <circle cx="9" cy="7" r="4"/>
                <path d="M23 21v-2a4 4 0 0 0-3-3.87M16 3.13a4 4 0 0 1 0 7.75"/>
            </svg>
        </div>
        <div class="stat-body">
            <div class="stat-value">{{ $stats['total_users'] }}</div>
            <div class="stat-label">Usuarios totales</div>
            <span class="stat-trend {{ $stats['new_this_month'] > 0 ? 'up' : 'flat' }}">
                @if ($stats['new_this_month'] > 0)
                    ↑ {{ $stats['new_this_month'] }} este mes
                @else
                    Sin nuevos este mes
                @endif
            </span>
        </div>
    </div>

    <div class="stat-card sky">
        <div class="stat-icon sky">
            <svg width="24" height="24" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                <path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/>
            </svg>
        </div>
        <div class="stat-body">
            <div class="stat-value">{{ $stats['admin_users'] }}</div>
            <div class="stat-label">Administradores</div>
            <span class="stat-trend flat">de {{ $stats['total_users'] }} usuarios</span>
        </div>
    </div>

    <div class="stat-card green">
        <div class="stat-icon green">
            <svg width="24" height="24" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                <line x1="12" y1="5" x2="12" y2="19"/><polyline points="19 12 12 19 5 12"/>
            </svg>
        </div>
        <div class="stat-body">
            <div class="stat-value">{{ $stats['new_this_week'] }}</div>
            <div class="stat-label">Nuevos esta semana</div>
            <span class="stat-trend {{ $stats['new_this_week'] > 0 ? 'up' : 'flat' }}">
                últimos 7 días
            </span>
        </div>
    </div>

    <div class="stat-card orange">
        <div class="stat-icon orange">
            <svg width="24" height="24" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                <rect x="3" y="4" width="18" height="18" rx="2"/><line x1="16" y1="2" x2="16" y2="6"/>
                <line x1="8" y1="2" x2="8" y2="6"/><line x1="3" y1="10" x2="21" y2="10"/>
            </svg>
        </div>
        <div class="stat-body">
            <div class="stat-value">{{ $stats['new_this_month'] }}</div>
            <div class="stat-label">Registros este mes</div>
            <span class="stat-trend flat">{{ now()->format('F Y') }}</span>
        </div>
    </div>

    <div class="stat-card sky">
        <div class="stat-icon sky">
            <svg width="24" height="24" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                <path d="M2 3h6a4 4 0 0 1 4 4v14a3 3 0 0 0-3-3H2z"/>
                <path d="M22 3h-6a4 4 0 0 0-4 4v14a3 3 0 0 1 3-3h7z"/>
            </svg>
        </div>
        <div class="stat-body">
            <div class="stat-value">{{ $stats['total_enrollments'] }}</div>
            <div class="stat-label">Inscripciones totales</div>
            <span class="stat-trend flat">en todos los cursos</span>
        </div>
    </div>

    <div class="stat-card blue">
        <div class="stat-icon blue">
            <svg width="24" height="24" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                <path d="M21 15a2 2 0 0 1-2 2H7l-4 4V5a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2z"/>
            </svg>
        </div>
        <div class="stat-body">
            <div class="stat-value">{{ $stats['total_contacts'] }}</div>
            <div class="stat-label">Mensajes recibidos</div>
            @if ($stats['unread_contacts'] > 0)
                <span class="stat-trend up">{{ $stats['unread_contacts'] }} sin leer</span>
            @else
                <span class="stat-trend flat">Todos leídos</span>
            @endif
        </div>
    </div>
</div>

{{-- Content grid --}}
<div class="content-grid">

    {{-- Usuarios recientes --}}
    <div class="card">
        <div class="card-header">
            <div class="card-title">
                <svg width="16" height="16" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"/>
                    <circle cx="9" cy="7" r="4"/>
                    <path d="M23 21v-2a4 4 0 0 0-3-3.87M16 3.13a4 4 0 0 1 0 7.75"/>
                </svg>
                Usuarios recientes
            </div>
            <a href="{{ route('admin.users') }}" class="card-link">
                Ver todos
                <svg width="12" height="12" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                    <polyline points="9 18 15 12 9 6"/>
                </svg>
            </a>
        </div>
        @if ($stats['recent_users']->isEmpty())
            <div class="card-body" style="color:var(--gray-400);font-size:13px;text-align:center;padding:40px">
                No hay usuarios registrados aún.
            </div>
        @else
            <table class="admin-table">
                <thead>
                    <tr>
                        <th>Usuario</th>
                        <th>Rol</th>
                        <th>Registro</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($stats['recent_users'] as $user)
                        <tr>
                            <td>
                                <div class="user-info">
                                    <div class="user-avatar">{{ strtoupper(substr($user->name, 0, 1)) }}</div>
                                    <div>
                                        <div class="user-name">{{ $user->name }}</div>
                                        <div class="user-email">{{ $user->email }}</div>
                                    </div>
                                </div>
                            </td>
                            <td>
                                @if ($user->is_admin)
                                    <span class="badge badge-admin">
                                        <svg width="10" height="10" fill="currentColor" viewBox="0 0 24 24"><path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/></svg>
                                        Admin
                                    </span>
                                @else
                                    <span class="badge badge-user">Usuario</span>
                                @endif
                            </td>
                            <td style="color:var(--gray-400);font-size:12px;">
                                {{ $user->created_at->diffForHumans() }}
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @endif
    </div>

    {{-- Panel derecho --}}
    <div style="display:flex;flex-direction:column;gap:18px;">

        {{-- Actividad reciente --}}
        <div class="card">
            <div class="card-header">
                <div class="card-title">
                    <svg width="16" height="16" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <polyline points="22 12 18 12 15 21 9 3 6 12 2 12"/>
                    </svg>
                    Actividad reciente
                </div>
            </div>
            <div class="card-body">
                <div class="activity-list">
                    @forelse ($stats['recent_users']->take(5) as $user)
                        <div class="activity-item">
                            <div class="activity-dot {{ $loop->index % 3 === 0 ? 'sky' : ($loop->index % 3 === 1 ? 'green' : '') }}"></div>
                            <div>
                                <div class="activity-text">
                                    <strong>{{ \Illuminate\Support\Str::words($user->name, 2, '') }}</strong>
                                    se registró en la plataforma
                                </div>
                                <div class="activity-time">{{ $user->created_at->diffForHumans() }}</div>
                            </div>
                        </div>
                    @empty
                        <p style="color:var(--gray-400);font-size:13px;">Sin actividad reciente.</p>
                    @endforelse
                </div>
            </div>
        </div>

        {{-- Acciones rápidas --}}
        <div class="card">
            <div class="card-header">
                <div class="card-title">
                    <svg width="16" height="16" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <circle cx="12" cy="12" r="10"/><line x1="12" y1="8" x2="12" y2="12"/><line x1="12" y1="16" x2="12.01" y2="16"/>
                    </svg>
                    Acciones rápidas
                </div>
            </div>
            <div class="card-body">
                <div class="quick-actions">
                    <a href="{{ route('admin.users') }}" class="quick-btn">
                        <svg fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"/>
                            <circle cx="9" cy="7" r="4"/>
                        </svg>
                        Usuarios
                    </a>
                    <a href="{{ route('cursos') }}" target="_blank" class="quick-btn">
                        <svg fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path d="M2 3h6a4 4 0 0 1 4 4v14a3 3 0 0 0-3-3H2z"/>
                            <path d="M22 3h-6a4 4 0 0 0-4 4v14a3 3 0 0 1 3-3h7z"/>
                        </svg>
                        Cursos
                    </a>
                    <a href="{{ route('contacto') }}" target="_blank" class="quick-btn">
                        <svg fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path d="M21 15a2 2 0 0 1-2 2H7l-4 4V5a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2z"/>
                        </svg>
                        Contacto
                    </a>
                    <a href="{{ route('inicio') }}" target="_blank" class="quick-btn">
                        <svg fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"/>
                        </svg>
                        Sitio web
                    </a>
                </div>
            </div>
        </div>

    </div>
</div>

{{-- Inscripciones recientes --}}
<div class="card" style="margin-bottom:20px;">
    <div class="card-header">
        <div class="card-title">
            <svg width="16" height="16" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                <path d="M2 3h6a4 4 0 0 1 4 4v14a3 3 0 0 0-3-3H2z"/>
                <path d="M22 3h-6a4 4 0 0 0-4 4v14a3 3 0 0 1 3-3h7z"/>
            </svg>
            Inscripciones recientes
        </div>
    </div>
    @if ($stats['recent_enrollments']->isEmpty())
        <div style="padding:28px;text-align:center;color:var(--gray-400);font-size:13px;">Aún no hay inscripciones.</div>
    @else
        <table class="admin-table">
            <thead>
                <tr>
                    <th>Usuario</th>
                    <th>Curso</th>
                    <th>Nivel</th>
                    <th>Precio</th>
                    <th>Estado</th>
                    <th>Fecha</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($stats['recent_enrollments'] as $e)
                    <tr>
                        <td>
                            <div class="user-info">
                                <div class="user-avatar">{{ strtoupper(substr($e->user->name ?? '?', 0, 1)) }}</div>
                                <div>
                                    <div class="user-name">{{ $e->user->name ?? '—' }}</div>
                                    <div class="user-email">{{ $e->user->email ?? '' }}</div>
                                </div>
                            </div>
                        </td>
                        <td style="font-size:13px;max-width:200px;">{{ $e->course_name }}</td>
                        <td>
                            @php $colors = ['basico'=>'#dcfce7|#15803d','intermedio'=>'#fef3c7|#92400e','avanzado'=>'#fee2e2|#991b1b']; $c = explode('|', $colors[strtolower($e->level)] ?? '#e2e8f0|#475569'); @endphp
                            <span style="background:{{ $c[0] }};color:{{ $c[1] }};padding:3px 10px;border-radius:20px;font-size:11px;font-weight:700;">{{ ucfirst($e->level) }}</span>
                        </td>
                        <td style="font-weight:700;">S/ {{ number_format($e->price, 0) }}</td>
                        <td>
                            @if ($e->status === 'pagado')
                                <span style="background:#dcfce7;color:#15803d;padding:3px 10px;border-radius:20px;font-size:11px;font-weight:700;">Pagado</span>
                            @elseif ($e->status === 'completado')
                                <span style="background:var(--blue-100);color:var(--blue-700);padding:3px 10px;border-radius:20px;font-size:11px;font-weight:700;">Completado</span>
                            @else
                                <span style="background:#fef3c7;color:#92400e;padding:3px 10px;border-radius:20px;font-size:11px;font-weight:700;">Pendiente</span>
                            @endif
                        </td>
                        <td style="font-size:12px;color:var(--gray-400);">{{ $e->created_at->format('d/m/Y') }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif
</div>

{{-- Mensajes de contacto --}}
<div class="card" style="margin-top:0">
    <div class="card-header">
        <div class="card-title">
            <svg width="16" height="16" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                <path d="M21 15a2 2 0 0 1-2 2H7l-4 4V5a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2z"/>
            </svg>
            Mensajes de contacto
            @if ($stats['unread_contacts'] > 0)
                <span style="background:var(--blue-600);color:#fff;font-size:11px;font-weight:700;padding:2px 8px;border-radius:20px;margin-left:6px;">
                    {{ $stats['unread_contacts'] }} nuevos
                </span>
            @endif
        </div>
        <a href="{{ route('admin.contacts') }}" class="card-link">
            Ver todos
            <svg width="12" height="12" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><polyline points="9 18 15 12 9 6"/></svg>
        </a>
    </div>

    @if ($stats['recent_contacts']->isEmpty())
        <div style="padding:32px;text-align:center;color:var(--gray-400);font-size:13px;">
            Aún no hay mensajes recibidos.
        </div>
    @else
        <table class="admin-table">
            <thead>
                <tr>
                    <th>Remitente</th>
                    <th>Tema</th>
                    <th>Curso</th>
                    <th>Mensaje</th>
                    <th>Recibido</th>
                    <th>Estado</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($stats['recent_contacts'] as $contact)
                    <tr style="{{ !$contact->leido ? 'background:#eff6ff;' : '' }}">
                        <td>
                            <div class="user-info">
                                <div class="user-avatar" style="background:linear-gradient(135deg,#2563eb,#0ea5e9)">
                                    {{ strtoupper(substr($contact->nombre, 0, 1)) }}
                                </div>
                                <div>
                                    <div class="user-name">{{ $contact->nombre }}</div>
                                    <div class="user-email">{{ $contact->correo }}</div>
                                </div>
                            </div>
                        </td>
                        <td>
                            <span style="background:var(--blue-100);color:var(--blue-700);padding:3px 10px;border-radius:20px;font-size:12px;font-weight:600;">
                                {{ ucfirst($contact->tema) }}
                            </span>
                        </td>
                        <td style="font-size:12px;color:var(--gray-400);max-width:160px;">
                            {{ $contact->curso ?? '—' }}
                        </td>
                        <td style="font-size:13px;color:var(--gray-600);max-width:220px;white-space:nowrap;overflow:hidden;text-overflow:ellipsis;">
                            {{ $contact->mensaje }}
                        </td>
                        <td style="font-size:12px;color:var(--gray-400);white-space:nowrap;">
                            {{ $contact->created_at->diffForHumans() }}
                        </td>
                        <td>
                            @if (!$contact->leido)
                                <span style="background:#dbeafe;color:#1d4ed8;padding:3px 10px;border-radius:20px;font-size:11px;font-weight:700;">Nuevo</span>
                            @else
                                <span style="background:var(--gray-100);color:var(--gray-400);padding:3px 10px;border-radius:20px;font-size:11px;font-weight:600;">Leído</span>
                            @endif
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif
</div>

@endsection

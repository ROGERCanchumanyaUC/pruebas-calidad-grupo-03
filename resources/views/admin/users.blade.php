@extends('layouts.admin')

@section('page-title', 'Usuarios')

@section('content')

<div class="page-header">
    <h1>Usuarios</h1>
    <p>Listado completo de usuarios registrados en la plataforma</p>
</div>

<div class="card">
    <div class="card-header">
        <svg width="16" height="16" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
            <path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"/>
            <circle cx="9" cy="7" r="4"/>
            <path d="M23 21v-2a4 4 0 0 0-3-3.87M16 3.13a4 4 0 0 1 0 7.75"/>
        </svg>
        Todos los usuarios ({{ $users->total() }})
    </div>
    <div class="card-body">
        @if ($users->isEmpty())
            <p style="padding:20px;color:var(--muted);font-size:13px;">No hay usuarios registrados.</p>
        @else
            <table class="admin-table">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Nombre</th>
                        <th>Email</th>
                        <th>Rol</th>
                        <th>Registrado</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($users as $user)
                        <tr>
                            <td style="color:var(--muted)">{{ $user->id }}</td>
                            <td><strong>{{ $user->name }}</strong></td>
                            <td>{{ $user->email }}</td>
                            <td>
                                @if ($user->is_admin)
                                    <span class="badge badge-admin">Admin</span>
                                @else
                                    <span class="badge badge-user">Usuario</span>
                                @endif
                            </td>
                            <td style="color:var(--muted)">{{ $user->created_at->format('d/m/Y H:i') }}</td>
                            <td>
                                @if ($user->id !== auth()->id())
                                    <form method="POST" action="{{ route('admin.users.toggle', $user) }}"
                                          style="display:inline"
                                          onsubmit="return confirm('¿Cambiar rol de este usuario?')">
                                        @csrf
                                        @method('PATCH')
                                        <button type="submit" style="
                                            font-family:inherit;font-size:12px;cursor:pointer;
                                            background:none;border:1px solid var(--border);
                                            border-radius:6px;padding:4px 10px;color:var(--muted);
                                            transition:all .18s;
                                        ">
                                            {{ $user->is_admin ? 'Quitar admin' : 'Hacer admin' }}
                                        </button>
                                    </form>
                                @else
                                    <span style="font-size:12px;color:var(--muted)">Tú</span>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

            @if ($users->hasPages())
                <div style="padding:14px 16px;border-top:1px solid var(--border)">
                    {{ $users->links() }}
                </div>
            @endif
        @endif
    </div>
</div>

@endsection

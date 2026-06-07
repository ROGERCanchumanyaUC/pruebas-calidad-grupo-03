<?php

namespace Database\Seeders;

use App\Models\Role;
use App\Models\Permission;
use Illuminate\Database\Seeder;

class RoleAndPermissionSeeder extends Seeder
{
    public function run(): void
    {
        // ── Roles ──
        $admin = Role::create([
            'name' => 'admin',
            'display_name' => 'Administrador',
            'description' => 'Acceso total al sistema. Gestiona cursos, usuarios, ventas, configuración y auditoría.',
        ]);

        $instructor = Role::create([
            'name' => 'instructor',
            'display_name' => 'Instructor',
            'description' => 'Gestiona sus cursos, módulos y materiales. No puede acceder a configuración global.',
        ]);

        $soporte = Role::create([
            'name' => 'soporte',
            'display_name' => 'Soporte',
            'description' => 'Ve estudiantes y gestiona incidencias. No puede modificar cursos.',
        ]);

        $estudiante = Role::create([
            'name' => 'estudiante',
            'display_name' => 'Estudiante',
            'description' => 'Accede a los cursos en los que está inscrito.',
        ]);

        // ── Permisos por módulo ──
        $permissions = [
            // Dashboard
            ['name' => 'dashboard.view', 'display_name' => 'Ver Dashboard', 'module' => 'dashboard'],

            // Cursos
            ['name' => 'courses.view', 'display_name' => 'Ver Cursos', 'module' => 'cursos'],
            ['name' => 'courses.create', 'display_name' => 'Crear Cursos', 'module' => 'cursos'],
            ['name' => 'courses.edit', 'display_name' => 'Editar Cursos', 'module' => 'cursos'],
            ['name' => 'courses.delete', 'display_name' => 'Eliminar Cursos', 'module' => 'cursos'],
            ['name' => 'courses.publish', 'display_name' => 'Publicar/Despublicar Cursos', 'module' => 'cursos'],

            // Módulos
            ['name' => 'modules.view', 'display_name' => 'Ver Módulos', 'module' => 'modulos'],
            ['name' => 'modules.create', 'display_name' => 'Crear Módulos', 'module' => 'modulos'],
            ['name' => 'modules.edit', 'display_name' => 'Editar Módulos', 'module' => 'modulos'],
            ['name' => 'modules.delete', 'display_name' => 'Eliminar Módulos', 'module' => 'modulos'],

            // Materiales
            ['name' => 'materials.view', 'display_name' => 'Ver Materiales', 'module' => 'materiales'],
            ['name' => 'materials.create', 'display_name' => 'Crear Materiales', 'module' => 'materiales'],
            ['name' => 'materials.edit', 'display_name' => 'Editar Materiales', 'module' => 'materiales'],
            ['name' => 'materials.delete', 'display_name' => 'Eliminar Materiales', 'module' => 'materiales'],

            // Estudiantes
            ['name' => 'students.view', 'display_name' => 'Ver Estudiantes', 'module' => 'estudiantes'],
            ['name' => 'students.manage', 'display_name' => 'Gestionar Estudiantes', 'module' => 'estudiantes'],

            // Ventas
            ['name' => 'sales.view', 'display_name' => 'Ver Ventas', 'module' => 'ventas'],
            ['name' => 'sales.manage', 'display_name' => 'Gestionar Ventas', 'module' => 'ventas'],

            // Cupones
            ['name' => 'coupons.view', 'display_name' => 'Ver Cupones', 'module' => 'cupones'],
            ['name' => 'coupons.create', 'display_name' => 'Crear Cupones', 'module' => 'cupones'],
            ['name' => 'coupons.edit', 'display_name' => 'Editar Cupones', 'module' => 'cupones'],
            ['name' => 'coupons.delete', 'display_name' => 'Eliminar Cupones', 'module' => 'cupones'],

            // Usuarios y roles
            ['name' => 'users.view', 'display_name' => 'Ver Usuarios', 'module' => 'usuarios'],
            ['name' => 'users.manage', 'display_name' => 'Gestionar Usuarios', 'module' => 'usuarios'],
            ['name' => 'roles.manage', 'display_name' => 'Gestionar Roles', 'module' => 'usuarios'],

            // Configuración
            ['name' => 'settings.view', 'display_name' => 'Ver Configuración', 'module' => 'configuracion'],
            ['name' => 'settings.edit', 'display_name' => 'Editar Configuración', 'module' => 'configuracion'],

            // Auditoría
            ['name' => 'audit.view', 'display_name' => 'Ver Auditoría', 'module' => 'auditoria'],

            // Contactos
            ['name' => 'contacts.view', 'display_name' => 'Ver Contactos', 'module' => 'contactos'],
            ['name' => 'contacts.manage', 'display_name' => 'Gestionar Contactos', 'module' => 'contactos'],
        ];

        $permissionModels = [];
        foreach ($permissions as $perm) {
            $permissionModels[$perm['name']] = Permission::create($perm);
        }

        // ── Asignar permisos a roles ──

        // Admin: todos los permisos
        $admin->permissions()->attach(array_map(fn ($p) => $p->id, $permissionModels));

        // Instructor: cursos, módulos, materiales (propios)
        $instructorPerms = [
            'dashboard.view',
            'courses.view', 'courses.create', 'courses.edit', 'courses.publish',
            'modules.view', 'modules.create', 'modules.edit', 'modules.delete',
            'materials.view', 'materials.create', 'materials.edit', 'materials.delete',
            'students.view',
        ];
        $instructor->permissions()->attach(
            collect($instructorPerms)->map(fn ($name) => $permissionModels[$name]->id)->toArray()
        );

        // Soporte: ver estudiantes y contactos
        $soportePerms = [
            'dashboard.view',
            'students.view', 'students.manage',
            'contacts.view', 'contacts.manage',
        ];
        $soporte->permissions()->attach(
            collect($soportePerms)->map(fn ($name) => $permissionModels[$name]->id)->toArray()
        );
    }
}

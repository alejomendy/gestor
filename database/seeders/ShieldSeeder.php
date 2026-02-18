<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use App\Models\User;

class ShieldSeeder extends Seeder
{
    public function run(): void
    {
        // 1. Crear Permisos básicos para WorkerResource (ejemplo)
        $permissions = [
            'view_any_worker',
            'view_worker',
            'create_worker',
            'update_worker',
            'delete_worker',
            'restore_worker',
            'force_delete_worker',
        ];

        foreach ($permissions as $permission) {
            Permission::findOrCreate($permission, 'web');
        }

        // 2. Crear Roles

        // Admin: Acceso completo
        $admin = Role::findOrCreate('admin', 'web');
        $admin->givePermissionTo(Permission::all());

        // Jefe: Puede editar y crear
        $jefe = Role::findOrCreate('jefe', 'web');
        $jefe->givePermissionTo([
            'view_any_worker',
            'view_worker',
            'create_worker',
            'update_worker',
        ]);

        // Empleado: Solo lectura
        $empleado = Role::findOrCreate('empleado', 'web');
        $empleado->givePermissionTo([
            'view_any_worker',
            'view_worker',
        ]);

    // 3. Permisos de Shield (opcional pero recomendado para el plugin)
    // Shield suele generar permisos con el formato "view_any_App\Filament\Resources\WorkerResource"
    // pero para simplificar usaremos políticas que verifiquen los roles directamente si es necesario.
    }
}

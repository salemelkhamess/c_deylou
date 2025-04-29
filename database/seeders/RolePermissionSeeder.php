<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RolePermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        // Reset cached roles and permissions
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        // Création des permissions pour les Centres
        $permissions = [
            // Centres
            'view centres', 'create centres', 'edit centres', 'delete centres',

            // Événements
            'view events', 'create events', 'edit events', 'delete events',

            // Galeries
            'view galleries', 'upload galleries', 'delete galleries',

            // Vidéos
            'view videos', 'upload videos', 'create youtube videos', 'delete videos'
        ];

        // Création des permissions dans la base de données
        foreach ($permissions as $permission) {
            Permission::create(['name' => $permission]);
        }

        // Création des rôles et attribution des permissions
        // Super Admin - A toutes les permissions
        $superAdmin = Role::create(['name' => 'super admin']);
        $superAdmin->givePermissionTo(Permission::all());

        // Admin - Accès complet à la gestion des centres, événements, galeries et vidéos
        $admin = Role::create(['name' => 'admin']);
        $admin->givePermissionTo([
            'view centres', 'create centres', 'edit centres', 'delete centres',
            'view events', 'create events', 'edit events', 'delete events',
            'view galleries', 'upload galleries', 'delete galleries',
            'view videos', 'upload videos', 'create youtube videos', 'delete videos'
        ]);

        // Manager - Peut gérer les événements, les galeries et les vidéos
        $manager = Role::create(['name' => 'manager']);
        $manager->givePermissionTo([
            'view events', 'create events', 'edit events', 'delete events',
            'view galleries', 'upload galleries', 'delete galleries',
            'view videos', 'upload videos', 'create youtube videos', 'delete videos'
        ]);

        // Viewer - Peut uniquement voir les centres, événements, galeries et vidéos
        $viewer = Role::create(['name' => 'viewer']);
        $viewer->givePermissionTo([
            'view centres',
            'view events',
            'view galleries',
            'view videos'
        ]);
    }
}

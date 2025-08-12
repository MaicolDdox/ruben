<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $rolAdmin   = Role::create(['name' => 'admin']);
        $rolCliente = Role::create(['name' => 'cliente']);

        //permisos
        Permission::create(['name' => 'articles.index']);
        Permission::create(['name' => 'articles.create']);
        Permission::create(['name' => 'articles.edit']);
        Permission::create(['name' => 'articles.delete']);
        Permission::create(['name' => 'articles.hola']);

        //asignar permisos
        $rolAdmin->givePermissionTo([
            'articles.index',
            'articles.create',
            'articles.edit',
            'articles.delete'
        ]);

        $rolCliente->givePermissionTo([
            'articles.index'
        ]);
    }
}

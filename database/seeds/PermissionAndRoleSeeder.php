<?php

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class PermissionAndRoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Reset cached roles and permissions
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        // create permissions
            //Manage users
            Permission::create(['name' => 'create users']);
            Permission::create(['name' => 'edit users']);
            Permission::create(['name' => 'delete users']);

            //Manage Product
            Permission::create(['name'=>'list-product']);
            
        // create roles and assign created permissions
        $role = Role::create(['name' => 'owner'])
            ->givePermissionTo(['create users', 'edit users',  'delete users']);

        $role = Role::create(['name' => 'super-admin']);
        $role->givePermissionTo(Permission::all());
    }
}

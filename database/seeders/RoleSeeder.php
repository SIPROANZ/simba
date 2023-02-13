<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Support\Facades\DB;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //

        DB::table('model_has_roles')->delete();
        DB::table('role_has_permissions')->delete();
        DB::table('permissions')->delete();
        DB::table('roles')->delete();


       $role1 = role::create(['name'=>'Admin']);
       $role2 = role::create(['name'=>'Solicitudes']);
       $role3 = role::create(['name'=>'Compromisos']);
       $role4 = role::create(['name'=>'Causados']);
       $role5 = role::create(['name'=>'Pagados']);
       $role6 = role::create(['name'=>'Ayudas']);
       $role7 = role::create(['name'=>'Precompromisos']);
       $role8 = role::create(['name'=>'Rol1']);
       $role9 = role::create(['name'=>'Rol2']);
       $role10 = role::create(['name'=>'Rol3']);

       Permission::create (['name'=>'admin.home'])->syncRoles([$role1,$role2]);
       Permission::create(['name'=>'admin.requisiciones.index'])->syncRoles([$role1,$role2]);
       Permission::create(['name'=>'admin.requisiciones.create'])->syncRoles([$role1,$role2]);
       Permission::create(['name'=>'admin.requisiciones.edit'])->syncRoles([$role1,$role2]);
       Permission::create(['name'=>'admin.requisiciones.destroy'])->syncRoles([$role1,$role2]);

       Permission::create(['name'=>'admin.tipossgps.index'])->syncRoles([$role1]);
       Permission::create(['name'=>'admin.tipossgps.create'])->syncRoles([$role1]);
       Permission::create(['name'=>'admin.tipossgps.edit'])->syncRoles([$role1]);
       Permission::create(['name'=>'admin.tipossgps.destroy'])->syncRoles([$role1]);
    }
}

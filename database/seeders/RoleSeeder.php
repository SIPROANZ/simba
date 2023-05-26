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
           /*/
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
       $role8 = role::create(['name'=>'Analisis']);
       $role9 = role::create(['name'=>'Compras']);
       $role10 = role::create(['name'=>'Ejecucion']);
       $role11 = role::create(['name'=>'Modificacion']);

       $role12 = role::create(['name'=>'Modificar']); //reversar, modificar, restaurar, actualizar
       $role13 = role::create(['name'=>'Crear']);
       $role14 = role::create(['name'=>'Edicion']);
       $role15 = role::create(['name'=>'Anular']); 

       //Permisos para las vistas
       Permission::create (['name'=>'admin.administrador'])->syncRoles([$role1]);
       Permission::create (['name'=>'admin.solicitudes'])->syncRoles([$role1,$role2]);
       Permission::create (['name'=>'admin.analisis'])->syncRoles([$role1,$role8]);
       Permission::create (['name'=>'admin.compras'])->syncRoles([$role1,$role9]);
       Permission::create (['name'=>'admin.precompromisos'])->syncRoles([$role1,$role7]);
       Permission::create (['name'=>'admin.compromisos'])->syncRoles([$role1,$role3]);
       Permission::create (['name'=>'admin.causados'])->syncRoles([$role1,$role4]);
       Permission::create (['name'=>'admin.pagados'])->syncRoles([$role1,$role5]);
       Permission::create (['name'=>'admin.ejecuciones'])->syncRoles([$role1,$role10]);
       Permission::create (['name'=>'admin.modificaciones'])->syncRoles([$role1,$role11]);
       Permission::create (['name'=>'admin.ayudas'])->syncRoles([$role1,$role6]);

       //Permisos para las acciones
       Permission::create (['name'=>'admin.modificar'])->syncRoles([$role1,$role12]);
       Permission::create (['name'=>'admin.crear'])->syncRoles([$role1,$role13]);
       Permission::create (['name'=>'admin.editar'])->syncRoles([$role1,$role14]);
       Permission::create (['name'=>'admin.anular'])->syncRoles([$role1,$role15]);

       

       $role16 = role::create(['name'=>'Beneficiario']);
       Permission::create (['name'=>'admin.beneficiarios'])->syncRoles([$role1,$role16]);
       */
        /*
       $role1 = role::create(['name'=>'Bancos']);
       $role2 = role::create(['name'=>'AjusteCompromiso']);
       Permission::create (['name'=>'admin.bancos'])->syncRoles([$role1]);
       Permission::create (['name'=>'admin.ajustecompromiso'])->syncRoles([$role2]); */
       /*
       $role1 = role::create(['name'=>'Bos']);
       Permission::create (['name'=>'admin.bos'])->syncRoles([$role1]);
       $role1 = role::create(['name'=>'Poa']);
       $role2 = 'Admin';
       Permission::create (['name'=>'admin.poa'])->syncRoles([$role1, $role2]);
       $role1 = role::create(['name'=>'Institucion']);
       $role2 = 'Admin';
       Permission::create (['name'=>'admin.instituciones'])->syncRoles([$role1, $role2]);*/
       $role1 = role::create(['name'=>'ModificacionPresupuestaria']);
       $role2 = 'Admin';
       Permission::create (['name'=>'admin.modificacionpresupuestaria'])->syncRoles([$role1, $role2]);


      
    }
}

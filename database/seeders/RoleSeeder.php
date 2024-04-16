<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\PermissionRegistrar;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

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
        app()[


            PermissionRegistrar::class
        ]->forgetCachedPermissions();


        $user = User::factory()->create([
            'kab_kota' => 'Kota Surabaya',
            'name' => 'teguh',
            'username' => 'teguh_kpa',
            'password' => bcrypt('kmzwa88saa'),
            'jabatan' => 'kpa'
        ]);
        $user->assignRole('kpa');
//             $rules = Role::create(
//                 [
//                 'name'=>'admin'
//             ]
//         );
//         $rules = Role::create(
//             [
//             'name'=>'sekolah'
//         ]
//     );
//     $rules = Role::create(
//         [
//         'name'=>'kpa'
//     ]
// );
// $rules = Role::create(
//     [
//     'name'=>'asesor'
// ]
// );

    }
}

<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $user = [
            ['kab_kota'=>'Kota Surabaya',
            'name'=>'Prof. Dr. Ir. Syaad Patmanthara, M.Pd',
            'username'=>'081233356051',
            'password'=>bcrypt('bansmjatim'),
            'jabatan'=>'sekre',
            'role'=>'1' ],

            ['kab_kota'=>'Kota Surabaya',
            'name'=>'Drs. R. Mujiraharjo, MM.',
            'username'=>'082230008817',
            'password'=>bcrypt('bansmjatim'),
            'jabatan'=>'sekre',
            'role'=>'1' ],

            ['kab_kota'=>'Kota Surabaya',
            'name'=>'Phonny Aditiawan Mulyana, SE.,MM.',
            'username'=>'083831274666',
            'password'=>bcrypt('bansmjatim'),
            'jabatan'=>'sekre',
            'role'=>'1' ],

            ['kab_kota'=>'Kota Surabaya',
            'name'=>'DR. Ruddy Winarko, M.BA., MM.',
            'username'=>'081330701301',
            'password'=>bcrypt('bansmjatim'),
            'jabatan'=>'sekre',
            'role'=>'2' ],

            ['kab_kota'=>'Kota Surabaya',
            'name'=>'Dr. Harmanto, M.Pd',
            'username'=>'081231479210',
            'password'=>bcrypt('bansmjatim'),
            'jabatan'=>'sekre',
            'role'=>'2' ],

            ['kab_kota'=>'Kota Surabaya',
            'name'=>'Dr. Nursamsu, M.Pd',
            'username'=>'081335652498',
            'password'=>bcrypt('bansmjatim'),
            'jabatan'=>'sekre',
            'role'=>'3' ],

            ['kab_kota'=>'Kota Surabaya',
            'name'=>'Nur Hidayati, M.Pd',
            'username'=>'081330313065',
            'password'=>bcrypt('bansmjatim'),
            'jabatan'=>'sekre',
            'role'=>'3' ],

            ['kab_kota'=>'Kota Surabaya',
            'name'=>'Widhi Candra Hermawan, S.Kom',
            'username'=>'widhi_jatim',
            'password'=>bcrypt('bansmjatim'),
            'jabatan'=>'sekre',
            'role'=>'1' ],

            ['kab_kota'=>'Kota Surabaya',
            'name'=>'Hisah Duwa Nuriana, S.Pd',
            'username'=>'hisah_jatim',
            'password'=>bcrypt('bansmjatim'),
            'jabatan'=>'sekre',
            'role'=>'1' ],

            ['kab_kota'=>'Kota Surabaya',
            'name'=>'Ayu Budiarti',
            'username'=>'ayu_jatim',
            'password'=>bcrypt('bansmjatim'),
            'jabatan'=>'sekre',
            'role'=>'2' ],

            ['kab_kota'=>'Kota Surabaya',
            'name'=>'Rosyida Sufiana, S.Kom',
            'username'=>'rosyi_jatim',
            'password'=>bcrypt('bansmjatim'),
            'jabatan'=>'sekre',
            'role'=>'3' ]
        ];

            foreach($user as $key => $value){
                User::create($value)->assignRole('kpa');
            }


    }
}

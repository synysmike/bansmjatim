<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;
use Spatie\Permission\PermissionRegistrar;

class AdminUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Clear permission cache
        app()[PermissionRegistrar::class]->forgetCachedPermissions();
        
        // Ensure admin role exists
        $adminRole = Role::firstOrCreate([
            'name' => 'admin',
            'guard_name' => 'web'
        ]);
        
        // Check if user already exists (including soft-deleted)
        $existingUser = User::withTrashed()->where('username', 'teguhadmin')->first();
        
        if ($existingUser) {
            // Restore if soft-deleted
            if ($existingUser->trashed()) {
                $existingUser->restore();
            }
            
            // Update existing user
            $existingUser->update([
                'name' => 'Teguh Admin',
                'password' => Hash::make('kmzwa88saa'),
                'jabatan' => 'admin',
                'kab_kota' => 'Kota Surabaya',
            ]);
            
            // Remove all roles and assign admin role
            $existingUser->syncRoles([$adminRole]);
            
            // Refresh to clear cache
            $existingUser->refresh();
            
            $this->command->info('Admin user updated successfully!');
            $this->command->info('User has roles: ' . implode(', ', $existingUser->getRoleNames()->toArray()));
        } else {
            // Create new admin user
            $admin = User::create([
                'username' => 'teguhadmin',
                'name' => 'Teguh Admin',
                'password' => Hash::make('kmzwa88saa'),
                'jabatan' => 'admin',
                'kab_kota' => 'Kota Surabaya',
            ]);
            
            // Assign admin role
            $admin->assignRole($adminRole);
            
            $this->command->info('Admin user created successfully!');
            $this->command->info('User has roles: ' . implode(', ', $admin->getRoleNames()->toArray()));
        }
        
        $this->command->info('Username: teguhadmin');
        $this->command->info('Password: kmzwa88saa');
    }
}

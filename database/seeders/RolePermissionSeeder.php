<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Carbon;

class RolePermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Define permissions
        $permissions = [
            'manage kategori', // Mengelola produk
            'manage produk',    // Mengelola penjualan
            'manage member',    // 
            'manage supplier',
            'manage pengeluaran',
            'manage pembelian',
            'manage penjualan',
            'manage kasir',
            'manage users',
            'manage laporan',
            'manage dashboard',
            'manage pengguna',
            'manage prodak'
        ];

        // Create or find permissions
        foreach ($permissions as $permission) {
            Permission::firstOrCreate(['name' => $permission]);
        }

        // Create admin role and assign all permissions
        $adminRole = Role::firstOrCreate(['name' => 'admin']);
        $adminPermissions = ['manage kategori', 'manage produk', 'manage member', 'manage supplier', 'manage pengeluaran', 'manage pembelian', 'manage penjualan', 'manage users', 'manage pengguna','manage prodak'];
        $adminRole->syncPermissions($adminPermissions);

        // Create kasir role and assign limited permissions
        $kasirRole = Role::firstOrCreate(['name' => 'kasir']);
        $kasirPermissions = ['manage penjualan', 'manage dashboard'];
        $kasirRole->syncPermissions($kasirPermissions);

        $usersRole = Role::firstOrCreate(['name' => 'users']);
        $usersPermissions = [''];
        $usersRole->syncPermissions($usersPermissions);

        // Create a default admin user
        $adminUser = User::firstOrCreate([
            'email' => 'admin@gmail.com'
        ], [
            'name' => 'Admin',
            'password' => Hash::make('1234567890'),
            'email_verified_at' => Carbon::now(),
        ]);
        $adminUser->assignRole($adminRole);


    }
}



<?php
namespace Database\Seeders;
use Illuminate\Database\Seeder;
use App\Models\User;

class AdminUserSeeder extends Seeder {
    public function run(): void {
        $admin = User::firstOrCreate(['email' => 'admin@shefahomes.com'], [
            'name' => 'Super Admin',
            'phone' => '+2348000000000',
            'portal' => 'admin',
            'is_active' => true,
            'is_verified' => true,
            'email_verified_at' => now(),
            'password' => bcrypt('Admin@123'),
        ]);
        $admin->assignRole('super_admin');

        $staff = User::firstOrCreate(['email' => 'staff@shefahomes.com'], [
            'name' => 'Staff Member',
            'phone' => '+2348000000001',
            'portal' => 'admin',
            'is_active' => true,
            'is_verified' => true,
            'email_verified_at' => now(),
            'password' => bcrypt('Staff@123'),
        ]);
        $staff->assignRole('staff');
    }
}

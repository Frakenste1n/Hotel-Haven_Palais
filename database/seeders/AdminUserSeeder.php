<?php

namespace Database\Seeders;

use App\Models\CustomerProfile;
use App\Models\Role;
use App\Models\StaffProfile;
use App\Models\User;
use Illuminate\Database\Seeder;

class AdminUserSeeder extends Seeder
{
    public function run(): void
    {
        $accounts = [
            [
                'name' => 'Super Admin',
                'email' => 'admin@havenpalais.com',
                'phone' => '081234567890',
                'role' => 'super_admin',
                'employee_code' => 'SA-001',
                'department' => 'Management',
                'position' => 'Super Admin',
            ],
            [
                'name' => 'Admin Hotel',
                'email' => 'admin.staff@havenpalais.com',
                'phone' => '081234567891',
                'role' => 'admin',
                'employee_code' => 'AD-001',
                'department' => 'Operations',
                'position' => 'Admin',
            ],
            [
                'name' => 'Resepsionis',
                'email' => 'receptionist@havenpalais.com',
                'phone' => '081234567892',
                'role' => 'receptionist',
                'employee_code' => 'RC-001',
                'department' => 'Front Office',
                'position' => 'Receptionist',
            ],
            [
                'name' => 'Keuangan',
                'email' => 'finance@havenpalais.com',
                'phone' => '081234567893',
                'role' => 'finance',
                'employee_code' => 'FN-001',
                'department' => 'Finance',
                'position' => 'Finance',
            ],
            [
                'name' => 'Housekeeping',
                'email' => 'housekeeping@havenpalais.com',
                'phone' => '081234567894',
                'role' => 'housekeeping',
                'employee_code' => 'HK-001',
                'department' => 'Housekeeping',
                'position' => 'Housekeeping',
            ],
            [
                'name' => 'Ayu Lestari',
                'email' => 'customer@havenpalais.com',
                'phone' => '081234567895',
                'role' => 'customer',
            ],
        ];

        foreach ($accounts as $account) {
            $role = Role::query()->where('slug', $account['role'])->firstOrFail();

            $user = User::updateOrCreate(
                ['email' => $account['email']],
                [
                    'name' => $account['name'],
                    'phone' => $account['phone'],
                    'password' => 'password',
                    'is_active' => true,
                    'email_verified_at' => now(),
                ]
            );

            $user->roles()->sync([$role->id]);

            if ($account['role'] === 'customer') {
                CustomerProfile::updateOrCreate(
                    ['user_id' => $user->id],
                    [
                        'address' => 'Jl. Melati No. 12',
                        'city' => 'Denpasar',
                        'country' => 'Indonesia',
                        'id_type' => 'ktp',
                        'id_number' => '5171012345670001',
                        'date_of_birth' => '1995-04-12',
                        'gender' => 'female',
                    ]
                );

                continue;
            }

            StaffProfile::updateOrCreate(
                ['user_id' => $user->id],
                [
                    'employee_code' => $account['employee_code'],
                    'department' => $account['department'],
                    'position' => $account['position'],
                    'hire_date' => '2024-01-15',
                ]
            );
        }
    }
}

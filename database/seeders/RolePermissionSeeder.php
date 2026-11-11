<?php

namespace Database\Seeders;

use App\Models\Permission;
use App\Models\Role;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class RolePermissionSeeder extends Seeder
{
    public function run(): void
    {
        $modules = [
            'dashboard' => ['view'],
            'website_cms' => ['view', 'create', 'update', 'delete'],
            'banners' => ['view', 'create', 'update', 'delete'],
            'page_contents' => ['view', 'create', 'update', 'delete'],
            'settings' => ['view', 'create', 'update', 'delete'],
            'users' => ['view', 'create', 'update', 'delete'],
            'roles' => ['view', 'create', 'update', 'delete'],
            'permissions' => ['view', 'create', 'update', 'delete'],
            'room_categories' => ['view', 'create', 'update', 'delete'],
            'room_types' => ['view', 'create', 'update', 'delete'],
            'rooms' => ['view', 'create', 'update', 'delete'],
            'room_facilities' => ['view', 'create', 'update', 'delete'],
            'facility_categories' => ['view', 'create', 'update', 'delete'],
            'resort_facilities' => ['view', 'create', 'update', 'delete'],
            'promotions' => ['view', 'create', 'update', 'delete'],
            'packages' => ['view', 'create', 'update', 'delete'],
            'gallery_categories' => ['view', 'create', 'update', 'delete'],
            'galleries' => ['view', 'create', 'update', 'delete'],
            'customers' => ['view', 'create', 'update', 'delete'],
            'guests' => ['view', 'create', 'update', 'delete'],
            'reservations' => ['view', 'create', 'update', 'delete'],
            'front_desk' => ['view', 'check_in', 'check_out'],
            'payment_methods' => ['view', 'create', 'update', 'delete'],
            'payments' => ['view', 'create', 'update', 'verify', 'refund'],
            'housekeeping' => ['view', 'create', 'update', 'delete'],
            'reviews' => ['view', 'moderate', 'delete'],
            'contact_messages' => ['view', 'update', 'delete'],
            'reports' => ['view'],
            'activity_logs' => ['view'],
            'notifications' => ['view', 'create', 'update', 'delete'],
        ];

        $permissionIds = [];

        foreach ($modules as $module => $actions) {
            foreach ($actions as $action) {
                $slug = "{$module}.{$action}";
                $permission = Permission::updateOrCreate(
                    ['slug' => $slug],
                    [
                        'name' => Str::headline($module) . ' ' . Str::headline($action),
                        'module' => $module,
                        'description' => "Permission to {$action} {$module}",
                    ]
                );
                $permissionIds[$slug] = $permission->id;
            }
        }

        $roles = [
            'super_admin' => [
                'name' => 'Super Admin',
                'description' => 'Akses penuh ke seluruh menu dan konfigurasi sistem.',
                'permissions' => array_keys($permissionIds),
            ],
            'admin' => [
                'name' => 'Admin',
                'description' => 'Mengelola CMS, kamar, fasilitas, promo, galeri, pelanggan, reservasi, ulasan, pesan, dan laporan.',
                'permissions' => array_values(array_filter(array_keys($permissionIds), function (string $slug) {
                    return ! str_starts_with($slug, 'roles.')
                        && ! str_starts_with($slug, 'permissions.');
                })),
            ],
            'receptionist' => [
                'name' => 'Receptionist',
                'description' => 'Mengelola tamu, reservasi, serta proses check-in dan check-out.',
                'permissions' => [
                    'dashboard.view',
                    'customers.view',
                    'guests.view',
                    'guests.create',
                    'guests.update',
                    'reservations.view',
                    'reservations.create',
                    'reservations.update',
                    'front_desk.view',
                    'front_desk.check_in',
                    'front_desk.check_out',
                    'rooms.view',
                    'room_types.view',
                    'payments.view',
                    'notifications.view',
                ],
            ],
            'finance' => [
                'name' => 'Finance',
                'description' => 'Mengelola pembayaran, verifikasi, refund, invoice, dan laporan keuangan.',
                'permissions' => [
                    'dashboard.view',
                    'reservations.view',
                    'payment_methods.view',
                    'payment_methods.create',
                    'payment_methods.update',
                    'payments.view',
                    'payments.create',
                    'payments.update',
                    'payments.verify',
                    'payments.refund',
                    'reports.view',
                    'notifications.view',
                ],
            ],
            'housekeeping' => [
                'name' => 'Housekeeping',
                'description' => 'Mengelola status kebersihan dan tugas kesiapan kamar.',
                'permissions' => [
                    'dashboard.view',
                    'rooms.view',
                    'rooms.update',
                    'housekeeping.view',
                    'housekeeping.create',
                    'housekeeping.update',
                    'notifications.view',
                ],
            ],
            'customer' => [
                'name' => 'Customer',
                'description' => 'Akses pelanggan untuk profil, reservasi, pembayaran, dan ulasan milik sendiri.',
                'permissions' => [],
            ],
        ];

        foreach ($roles as $slug => $data) {
            $role = Role::updateOrCreate(
                ['slug' => $slug],
                [
                    'name' => $data['name'],
                    'description' => $data['description'],
                    'is_active' => true,
                ]
            );

            $ids = collect($data['permissions'])
                ->map(fn (string $permissionSlug) => $permissionIds[$permissionSlug] ?? null)
                ->filter()
                ->values()
                ->all();

            $role->permissions()->sync($ids);
        }
    }
}

<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, SoftDeletes;

    /**
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'phone',
        'password',
        'is_active',
    ];

    /**
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
        'is_active' => 'boolean',
    ];

    public function roles(): BelongsToMany
    {
        return $this->belongsToMany(Role::class, 'user_roles')->withTimestamps();
    }

    public function customerProfile(): HasOne
    {
        return $this->hasOne(CustomerProfile::class);
    }

    public function staffProfile(): HasOne
    {
        return $this->hasOne(StaffProfile::class);
    }

    public function guests(): HasMany
    {
        return $this->hasMany(Guest::class);
    }

    public function reservations(): HasMany
    {
        return $this->hasMany(Reservation::class);
    }

    public function reviews(): HasMany
    {
        return $this->hasMany(Review::class);
    }

    public function assignedHousekeepingTasks(): HasMany
    {
        return $this->hasMany(HousekeepingTask::class, 'assigned_to');
    }

    public function activityLogs(): HasMany
    {
        return $this->hasMany(ActivityLog::class);
    }

    public const STAFF_ROLES = [
        'super_admin',
        'admin',
        'receptionist',
        'finance',
        'housekeeping',
    ];

    public function hasRole(string $slug): bool
    {
        return $this->roles()->where('slug', $slug)->exists();
    }

    public function isStaff(): bool
    {
        return $this->roles()->whereIn('slug', self::STAFF_ROLES)->exists();
    }

    public function hasPermission(string $slug): bool
    {
        return $this->allows($slug);
    }

    public function allows(string ...$permissions): bool
    {
        if ($permissions === []) {
            return false;
        }

        if ($this->isSuperAdmin()) {
            return true;
        }

        foreach ($permissions as $permission) {
            if (in_array($permission, $this->permissionSlugs(), true)) {
                return true;
            }
        }

        return false;
    }

    public function staffHome(): string
    {
        $routes = [
            'dashboard.view' => 'backend.dashboard',
            'reservations.view' => 'backend.booking-management.index',
            'payments.view' => 'backend.payment-management.index',
            'payment_methods.view' => 'backend.payment-management.index',
            'housekeeping.view' => 'backend.housekeeping.index',
            'rooms.view' => 'backend.room-management.index',
            'reports.view' => 'backend.reports-analytics.index',
            'users.view' => 'backend.staff-access.index',
        ];

        foreach ($routes as $permission => $route) {
            if ($this->allows($permission)) {
                return route($route);
            }
        }

        return route('backend.notifications-settings.index');
    }

    private ?bool $superAdmin = null;

    /** @var array<int, string>|null */
    private ?array $permissionSlugCache = null;

    private function isSuperAdmin(): bool
    {
        return $this->superAdmin ??= $this->roles()->where('slug', 'super_admin')->exists();
    }

    /** @return array<int, string> */
    private function permissionSlugs(): array
    {
        return $this->permissionSlugCache ??= $this->roles()
            ->with('permissions:id,slug')
            ->get()
            ->flatMap(fn (Role $role) => $role->permissions->pluck('slug'))
            ->unique()
            ->values()
            ->all();
    }
}

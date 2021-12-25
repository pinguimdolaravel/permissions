<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Cache;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function permissions(): BelongsToMany
    {
        return $this->belongsToMany(Permission::class);
    }

    public function posts(): HasMany
    {
        return $this->hasMany(Post::class);
    }

    public function givePermissionTo(string $permission): void
    {
        $p = Permission::getPermission($permission);

        $this->permissions()->attach($p);

        Cache::forget('permissions::of::user::'.$this->id);
    }

    public function removePermissionTo(string $permission): void
    {
        $p = Permission::getPermission($permission);

        $this->permissions()->detach($p);

        Cache::forget('permissions::of::user::'.$this->id);
    }

    public function hasPermissionTo(string $permission): bool
    {
        /** @var Collection $permissionsOfUser */
        $permissionsOfUser = Cache::rememberForever('permissions::of::user::'.$this->id, function () {
            return $this->permissions()->get();
        });

        return $permissionsOfUser->where('permission', $permission)->isNotEmpty();
    }
}

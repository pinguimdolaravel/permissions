<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cache;

class Permission extends Model
{
    use HasFactory;

    protected $guarded = [];

    public static function getPermission(string $permission): Permission
    {
        $p = self::getAllFromCache()->where('permission', $permission)->first();

        if(!$p) {
            $p = Permission::query()->create(['permission' => $permission]);
        }

        return $p;
    }

    public static function getAllFromCache(): Collection
    {
        /** @var Collection $permissions */
        $permissions = Cache::rememberForever('permissions', function () {
            return self::all();
        });

        return $permissions;
    }

    public static function existsOnCache(string $permission): bool
    {
        return self::getAllFromCache()->where('permission', $permission)->isNotEmpty();
    }
}

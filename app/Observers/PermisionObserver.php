<?php

namespace App\Observers;

use App\Models\Permission;
use Illuminate\Support\Facades\Cache;

class PermisionObserver
{
    /**
     * Handle the Permission "created" event.
     *
     * @param \App\Models\Permission $permission
     * @return void
     */
    public function created(Permission $permission)
    {
        Cache::forget('permissions');
        Cache::rememberForever('permissions', fn () => Permission::all());
    }

    /**
     * Handle the Permission "updated" event.
     *
     * @param \App\Models\Permission $permission
     * @return void
     */
    public function updated(Permission $permission)
    {
        //
    }

    /**
     * Handle the Permission "deleted" event.
     *
     * @param \App\Models\Permission $permission
     * @return void
     */
    public function deleted(Permission $permission)
    {
        //
    }

    /**
     * Handle the Permission "restored" event.
     *
     * @param \App\Models\Permission $permission
     * @return void
     */
    public function restored(Permission $permission)
    {
        //
    }

    /**
     * Handle the Permission "force deleted" event.
     *
     * @param \App\Models\Permission $permission
     * @return void
     */
    public function forceDeleted(Permission $permission)
    {
        //
    }
}

<?php

namespace App\Http\Middleware;

use Illuminate\Http\Request;
use Inertia\Middleware;

class HandleInertiaRequests extends Middleware
{
    /**
     * The root template that's loaded on the first page visit.
     *
     * @see https://inertiajs.com/server-side-setup#root-template
     *
     * @var string
     */
    protected $rootView = 'app';

    /**
     * Determines the current asset version.
     *
     * @see https://inertiajs.com/asset-versioning
     */
    public function version(Request $request): ?string
    {
        return parent::version($request);
    }

    /**
     * Define the props that are shared by default.
     *
     * @see https://inertiajs.com/shared-data
     *
     * @return array<string, mixed>
     */
    public function share(Request $request): array
{
    $user = $request->user();

    $activeAssignment = $request->attributes->get('active_assignment');

    if (! $activeAssignment && $user && $request->session()->has('active_assignment_id')) {
        $activeAssignment = $user->strukturRoles()
            ->with(['role.permissions', 'strukturOrganisasi'])
            ->where('is_active', true)
            ->find($request->session()->get('active_assignment_id'));
    } else {
        $activeAssignment?->loadMissing(['role.permissions', 'strukturOrganisasi']);
    }

    return [
        ...parent::share($request),

        'name' => config('app.name'),

        'auth' => [
            'user' => $user ? [
                'id' => $user->id,
                'name' => $user->name,
                'username' => $user->username,
                'email' => $user->email,
                'is_active' => $user->is_active,
            ] : null,
            'active_assignment' => $activeAssignment,
            'permissions' => $activeAssignment?->role?->permissions
                ? $activeAssignment->role->permissions->pluck('nama_permission')->toArray()
                : [],
            'has_multiple_assignments' => $user
                ? $user->strukturRoles()->where('is_active', true)->count() > 1
                : false,
        ],

        'sidebarOpen' => ! $request->hasCookie('sidebar_state')
            || $request->cookie('sidebar_state') === 'true',
    ];
}
}

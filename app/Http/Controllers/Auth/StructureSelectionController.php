<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Response;

class StructureSelectionController extends Controller
{
    public function index(Request $request): Response|\Illuminate\Http\RedirectResponse
    {
        \Log::info('StructureSelectionController@index diakses', [
            'method' => $request->method(),
            'full_url' => $request->fullUrl(),
            'user_id' => $request->user()?->id,
            'session_assignment_id' => $request->session()->get('active_assignment_id'),
            'referer' => $request->header('referer'),
            'x_inertia' => $request->header('X-Inertia'),
            'is_ajax' => $request->ajax(),
        ]);

        $user = $request->user();

        // Jika user sudah memiliki peran aktif di session dan tidak sedang meminta ganti peran (?ganti=1),
        // langsung arahkan ke dashboard
        if ($request->session()->has('active_assignment_id') && !$request->has('ganti')) {
            $activeId = $request->session()->get('active_assignment_id');

            $isValid = $user->strukturRoles()
                ->where('is_active', true)
                ->where('id', $activeId)
                ->exists();

            if ($isValid) {
                return redirect()->route('dashboard');
            }

            $request->session()->forget('active_assignment_id');
        }

        $assignments = $user
            ->strukturRoles()
            ->where('is_active', true)
            ->with('role')
            ->get();

        if ($assignments->isEmpty()) {
            abort(403, 'Tidak ada penugasan organisasi aktif.');
        }

        return Inertia::render('auth/SelectStructure', [
            'assignments' => $assignments,
        ]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'assignment_id' => ['required', 'integer'],
        ]);

        $assignment = $request->user()
            ->strukturRoles()
            ->where('is_active', true)
            ->findOrFail($validated['assignment_id']);

        $request->session()->put(
            'active_assignment_id',
            $assignment->id
        );
        $request->session()->forget('url.intended');
        $request->session()->save();
        \Log::info('StructureSelectionController@store berhasil', session()->all());

        return redirect()->route('dashboard');
    }
}

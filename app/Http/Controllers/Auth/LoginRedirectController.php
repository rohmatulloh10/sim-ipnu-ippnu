<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class LoginRedirectController extends Controller
{
    public function index(Request $request)
    {
        $user = $request->user();

        // 1. CEK SESSION TERLEBIH DAHULU
        // Jika user sudah memilih struktur/role aktif, langsung arahkan ke dashboard
        if ($request->session()->has('active_assignment_id')) {
            $activeId = $request->session()->get('active_assignment_id');

            $isValid = $user->strukturRoles()
                ->where('is_active', true)
                ->where('id', $activeId)
                ->exists();

            if ($isValid) {
                return redirect()->route('dashboard');
            }

            // Hapus jika ternyata di database sudah tidak aktif
            $request->session()->forget('active_assignment_id');
        }

        // 2. Jika belum ada di session, baru hitung jumlah penugasan aktif
        $assignments = $user->strukturRoles()
            ->where('is_active', true)
            ->get();

        \Log::info('LoginRedirectController dijalankan', [
            'user_id' => $user->id,
            'total_assignments' => $assignments->count(),
        ]);

        if ($assignments->isEmpty()) {
            auth()->logout();

            $request->session()->invalidate();
            $request->session()->regenerateToken();

            return redirect()->route('login')->withErrors([
                'username' => 'Anda belum memiliki penugasan organisasi aktif.',
            ]);
        }

        if ($assignments->count() === 1) {
            $assignment = $assignments->first();

            $request->session()->put('active_assignment_id', $assignment->id);
            $request->session()->save();

            return redirect()->route('dashboard');
        }

        return redirect()->route('struktur.select');
    }
}

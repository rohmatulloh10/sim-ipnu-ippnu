<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Symfony\Component\HttpFoundation\Response;

class EnsureActiveStructure
{
    public function handle(Request $request, Closure $next): Response
    {
        $user = $request->user();

        if (!$user) {
            return redirect()->route('login');
        }

        $assignmentId = $request->session()->get('active_assignment_id');

        Log::info('EnsureActiveStructure diperiksa', [
            'user_id' => $user->id,
            'session_assignment_id' => $assignmentId,
            'session_id' => $request->session()->getId(),
        ]);

        if (!$assignmentId) {
            return redirect()->route('struktur.select');
        }

        $assignment = $user->strukturRoles()
            ->with('role')
            ->where('is_active', true)
            ->where('id', $assignmentId)
            ->first();

        Log::info('Hasil pemeriksaan assignment', [
            'assignment_found' => (bool) $assignment,
            'assignment_id' => $assignment?->id,
        ]);

if (!$assignmentId) {
    return redirect()->route('struktur.select')
        ->header('Cache-Control', 'no-store, no-cache, must-revalidate');
}

        // $request->attributes->set('active_assignment', $assignment);
        

        // return $next($request);
        $request->attributes->set('active_assignment', $assignment);

$response = $next($request);

Log::info('RESPONS SETELAH MIDDLEWARE', [
    'status' => $response->getStatusCode(),
    'redirect' => $response->headers->get('Location'),
    'url' => $request->fullUrl(),
]);

return $response;
    }
}
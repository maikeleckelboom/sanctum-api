<?php

namespace App\Http\Controllers;

use Illuminate\Auth\AuthenticationException;
use Illuminate\Contracts\Auth\StatefulGuard;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;
use Jenssegers\Agent\Agent;

class SessionsController extends Controller
{
    public function index(Request $request): JsonResponse
    {
        if (config('session.driver') !== 'database') {
            return response()->json();
        }

        return $this->render(collect(DB::table(config('session.table', 'sessions'))
            ->where('user_id', $request->user()->getAuthIdentifier())
            ->orderBy('last_activity', 'desc')
            ->get())->map(
            function ($session) use ($request) {
                $agent = tap(new Agent, fn($agent) => $agent->setUserAgent($session->user_agent));
                return [
                    'id' => $session->id,
                    'ip' => $session->ip_address,
                    'agent' => [
                        'device' => $agent->isMobile() ? 'Mobile' : ($agent->isTablet() ? 'Tablet' : 'Desktop'),
                        'platform' => $agent->platform(),
                        'browser' => $agent->browser(),
                        'version' => $agent->version($agent->browser()),
                    ],
                    'lastActivity' => $session->last_activity,
                    'isCurrentDevice' => $session->id === $request->session()->getId(),
                ];
            }
        )->toArray());
    }

    /**
     * @throws AuthenticationException
     * @throws ValidationException
     */
    public function destroy(Request $request, StatefulGuard $guard): JsonResponse
    {
        if (!Hash::check($request->password, $request->user()->password)) {
            throw ValidationException::withMessages(
                [
                    'password' => [__('This password does not match our records.')],
                ]
            )->errorBag('logoutOtherBrowserSessions');
        }

        $guard->logoutOtherDevices($request->password);

        $this->deleteOtherSessionRecords($request);

        return response()->json();
    }

    protected function deleteOtherSessionRecords(Request $request)
    {
        if (config('session.driver') !== 'database') {
            return;
        }

        DB::table(config('session.table', 'sessions'))
            ->where('user_id', $request->user()->getAuthIdentifier())
            ->where('id', '!=', $request->session()->getId())
            ->delete();
    }
}

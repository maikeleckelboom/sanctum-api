<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class VerificationController extends Controller
{
    /**
     * Mark the authenticated user's email address as verified.
     *
     * @param EmailVerificationRequest $request
     * @return JsonResponse
     */
    public function __invoke(Request $request): JsonResponse
    {
        if ($request->user()->hasVerifiedEmail()) {
            return $this->error("email-has-already-been-verified");
        }

        if ($request->user()->markEmailAsVerified()) {
            $request->user()->sendEmailVerifiedNotification();
            return $this->render([], "email-successfully-verified");
        }

        return $this->error('email-verification-has-failed');
    }

}

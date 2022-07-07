<?php

namespace App\Providers;

use App\Models\User;
use Carbon\Carbon;
use Illuminate\Auth\Notifications\ResetPassword;
use Illuminate\Auth\Notifications\VerifyEmail;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\URL;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        // 'App\Models\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        ResetPassword::createUrlUsing(function (User $user, string $token) {
            return env('SPA_URL') . '/reset-password?token=' . $token;
        });

        VerifyEmail::createUrlUsing(function ($notifiable) {
            $params = [
                "expires" => Carbon::now()
                    ->addMinutes(60)
                    ->getTimestamp(),
                "id" => $notifiable->getKey(),
                "hash" => sha1($notifiable->getEmailForVerification()),
            ];
            ksort($params);
            $url = URL::route("verification.verify", $params, true);
            $key = config("app.key");
            $signature = hash_hmac("sha256", $url, $key);
            return env("SPA_URL")
                . "/email/verify/" . $params["id"] . "/" . $params["hash"]
                . "?expires=" . $params["expires"] . "&signature=" . $signature;
        });
    }
}

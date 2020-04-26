<?php

namespace App\Providers;

use Auth;
use A17\Twill\Repositories\UserRepository;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Event;

use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array
     */
    protected $listen = [
        // 'App\Events\Event' => [
        //     'App\Listeners\EventListener',
        // ],
    ];

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
        parent::boot();

        Event::listen('Aacotroneo\Saml2\Events\Saml2LoginEvent', function ($event) {
            $messageId = $event->getSaml2Auth()->getLastMessageId();
            // your own code preventing reuse of a $messageId to stop replay attacks
            $user = $event->getSaml2User();
            $userData = [
                // 'id' => $user->getUserId(),
                'email' => Arr::first($user->getAttribute('email')),
                'name' => Arr::first($user->getAttribute('email')),
                'role' => 'VIEW_ONLY',
            ];

            $aicUser = app(UserRepository::class)->firstOrCreate(['email' => $userData['email']], $userData);
            Auth::login($aicUser);
        });

        Event::listen('Aacotroneo\Saml2\Events\Saml2LogoutEvent', function ($event) {
            Auth::logout();
            Session::save();
        });
    }
}

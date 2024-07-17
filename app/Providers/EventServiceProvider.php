<?php

namespace App\Providers;

use App\Listeners\SendWelcomeEmail;
use App\Events\Post\PostCreatedEvent;
use Illuminate\Support\Facades\Event;
use Illuminate\Auth\Events\Registered;
use App\Subscribers\Post\PostSubscriber;
use App\Subscribers\User\UserSubscriber;
use App\Subscribers\Comment\CommentSubscriber;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array
     */
    protected $listen = [
        Registered::class => [
            SendEmailVerificationNotification::class,
        ],
    ];

    protected $subscribe = [
        UserSubscriber::class,
        PostSubscriber::class,
        CommentSubscriber::class,
    ];
    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}

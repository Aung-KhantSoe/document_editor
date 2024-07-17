<?php
    
namespace App\Subscribers\User;

use App\Events\User\UserCreatedEvent;
use App\Listeners\SendWelcomeEmail;
use Illuminate\Events\Dispatcher;

class UserSubscriber 
{
    public function subscribe(Dispatcher $events){
        $events->listen(UserCreatedEvent::class,SendWelcomeEmail::class);
    }
}

?>

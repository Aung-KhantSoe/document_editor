<?php
    
namespace App\Subscribers\Post;

use App\Events\Post\PostCreatedEvent;
use App\Listeners\SendWelcomeEmail;
use Illuminate\Events\Dispatcher;

class PostSubscriber 
{
    public function subscribe(Dispatcher $events){
        $events->listen(PostCreatedEvent::class,SendWelcomeEmail::class);
    }
}

?>

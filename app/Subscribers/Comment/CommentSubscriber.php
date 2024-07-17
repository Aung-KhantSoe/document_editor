<?php
    
namespace App\Subscribers\Comment;

use App\Events\Comment\CommentCreatedEvent;
use App\Listeners\SendWelcomeEmail;
use Illuminate\Events\Dispatcher;

class CommentSubscriber 
{
    public function subscribe(Dispatcher $events){
        $events->listen(CommentCreatedEvent::class,SendWelcomeEmail::class);
    }
}

?>

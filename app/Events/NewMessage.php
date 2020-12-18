<?php

namespace App\Events;

use App\Message;
use App\Room;
use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class NewMessage implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $message;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(Message $message)
    {   
        
        $this->message = $message;
       
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {   
        $ids = array();
        $user_id = Room::find($this->message->room_id)->user()->select('users.id')->get();
        foreach ($user_id as $user) {
        
            if( (int)$this->message->user_id == $user['id'])
            continue;
            array_push( $ids, new PrivateChannel('messages.' . $user['id']));
        }
        
        return $ids;
    }

    // public function broadcastWith()
    // {
    //     $this->message->load('fromContact');

    //     return ["message" => $this->message];
    // }
}

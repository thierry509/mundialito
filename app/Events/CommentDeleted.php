<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class CommentDeleted implements ShouldBroadcast
{
    use Dispatchable, SerializesModels;

    public $commentId;
    public $commentableType;
    public $commentableId;

    public function __construct($commentId, $commentableType, $commentableId)
    {
        $this->commentId       = $commentId;
        $this->commentableType = class_basename($commentableType);
        $this->commentableId   = $commentableId;
    }

    public function broadcastOn()
    {
        return new Channel("comments." . strtolower($this->commentableType) . "." . $this->commentableId);
    }
}

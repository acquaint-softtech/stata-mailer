<?php

namespace AcquaintSofttech\StataMailer\Events;
use Statamic\Events\Event;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class StataMailConfiguration extends Event
{
    use Dispatchable, SerializesModels;
    
    public $data;

    public function __construct($data)
    {
        $this->data = $data;
    }
}
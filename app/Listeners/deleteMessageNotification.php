<?php

namespace App\Listeners;

use App\Events\DeleteMessage;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class deleteMessageNotification
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  \App\Events\DeleteMessage  $event
     * @return void
     */
    public function handle(DeleteMessage $event)
    {
        //
    }
}

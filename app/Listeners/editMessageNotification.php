<?php

namespace App\Listeners;

use App\Events\EditMessage;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class editMessageNotification
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
     * @param  \App\Events\EditMessage  $event
     * @return void
     */
    public function handle(EditMessage $event)
    {
        //
    }
}

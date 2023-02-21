<?php

namespace App\Listeners;

use App\Events\PostView;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;


class IncreasePostViews
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
     * @param  \App\Events\PostView  $event
     * @return void
     */
    public function handle(PostView $event)
    {
        $event->post->views = $event->post->views + 1;
        $event->post->save();
    }
}

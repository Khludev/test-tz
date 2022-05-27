<?php

namespace App\Mail;

use App\Models\Application;
use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class NotifyManagerOfNewApp extends Mailable
{
    use Queueable, SerializesModels;

    protected $app, $user;

    /**
     * Create a new message instance.
     *
     * @param Application $app
     * @param User $user
     */
    public function __construct(Application $app, User $user)
    {
        $this->app = $app;
        $this->user = $user;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('emails.notify_manager_of_new_app')
            ->with('app', $this->app)
            ->with('user', $this->user);
    }
}

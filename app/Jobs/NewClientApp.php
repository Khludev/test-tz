<?php

namespace App\Jobs;

use App\Classes\CustomRoles;
use App\Mail\NotifyManagerOfNewApp;
use App\Models\Application;
use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;

class NewClientApp implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $app, $user;

    /**
     * Create a new job instance.
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
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $first_manager = User::role(CustomRoles::ROLE_MANAGER)->first();
        if ($first_manager)
            Mail::to($first_manager->email)->send(new NotifyManagerOfNewApp($this->app, $this->user));
    }
}

<?php

namespace App\Console\Commands;

use App\Enums\UserSubscription\UserSubscriptionStatusEnums;
use App\Jobs\SendEmailJob;
use App\Models\UserSubscription;
use Illuminate\Console\Command;

class SendEmailToUnsubscribe extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'cronjob:send-email-to-unsubscribe';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Send email to each users unsubscribe';

    /**
     * Execute the console command.
     */
    public function handle()
    {
		info("Cron Job running at ". now());
		$usersSubscriptions = UserSubscription::query()
			->where('status',UserSubscriptionStatusEnums::Active)
			->with('user')
			->get();
		
		foreach ($usersSubscriptions as $item) {
			if ($item->reminder_days <= config('variables.comparison day')) {
				dispatch(new SendEmailJob($item->user));
			}
		}
    }
}

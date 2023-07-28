<?php

namespace App\Models;

use App\Enums\UserSubscription\UserSubscriptionStatusEnums;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserSubscription extends Model
{
	use HasFactory;
    protected $fillable = [
		'user_id',
		'subscription_id',
		'started_at',
		'end_at',
		'status'
	];
	
	protected $casts = [
		'started_at' => 'datetime',
		'end_at' => 'datetime',
		'status' => UserSubscriptionStatusEnums::class
	];
	
	protected $appends = [
		'reminder_days'
	];
	
	public function user() {
		return $this->belongsTo(User::class);
	}
	
	public function subscription() {
		return $this->belongsTo(Subscription::class);
	}
	
	public function getReminderDaysAttribute():int {
		if ($this->end_at < Carbon::now()) {
			return 0;
		}
		$end_at = Carbon::parse($this->end_at);
		$now = Carbon::now();
		
		return $end_at->diffInDays($now);
		
	}
}

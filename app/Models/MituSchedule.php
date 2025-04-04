<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class MituSchedule
 * 
 * @property int $id
 * @property Carbon $created_at
 * @property Carbon $updated_at
 * @property bool $is_active
 * @property string|null $content
 * @property Carbon|null $date
 * @property time without time zone|null $time
 * @property time without time zone|null $time_comming
 * @property int|null $type
 * @property int|null $platform
 * @property int|null $customer_id
 * @property int|null $creator_id
 * @property int|null $status_schedule_id
 * @property int|null $staff_id
 * @property int|null $alias_id
 * @property time without time zone|null $time_end
 * 
 * @property MituCustomer|null $mitu_customer
 * @property MituAccount|null $mitu_account
 * @property MituStatusSchedule|null $mitu_status_schedule
 * @property Collection|MituNotification[] $mitu_notifications
 * @property Collection|MituScheduleService[] $mitu_schedule_services
 * @property Collection|MituScheduleEditHistory[] $mitu_schedule_edit_histories
 *
 * @package App\Models
 */
class MituSchedule extends Model
{
	protected $table = 'mitu_schedule';

	protected $casts = [
		'is_active' => 'bool',
		'date' => 'datetime',
		'time' => 'time without time zone',
		'time_comming' => 'time without time zone',
		'type' => 'int',
		'platform' => 'int',
		'customer_id' => 'int',
		'creator_id' => 'int',
		'status_schedule_id' => 'int',
		'staff_id' => 'int',
		'alias_id' => 'int',
		'time_end' => 'time without time zone'
	];

	protected $fillable = [
		'is_active',
		'content',
		'date',
		'time',
		'time_comming',
		'type',
		'platform',
		'customer_id',
		'creator_id',
		'status_schedule_id',
		'staff_id',
		'alias_id',
		'time_end'
	];

	public function mitu_customer()
	{
		return $this->belongsTo(MituCustomer::class, 'customer_id');
	}

	public function mitu_account()
	{
		return $this->belongsTo(MituAccount::class, 'staff_id');
	}

	public function mitu_status_schedule()
	{
		return $this->belongsTo(MituStatusSchedule::class, 'status_schedule_id');
	}

	public function mitu_notifications()
	{
		return $this->hasMany(MituNotification::class, 'schedule_id');
	}

	public function mitu_schedule_services()
	{
		return $this->hasMany(MituScheduleService::class, 'schedule_id');
	}

	public function mitu_schedule_edit_histories()
	{
		return $this->hasMany(MituScheduleEditHistory::class, 'schedule_id');
	}
}

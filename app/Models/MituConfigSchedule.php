<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class MituConfigSchedule
 * 
 * @property int $id
 * @property Carbon $created_at
 * @property Carbon $updated_at
 * @property bool $is_active
 * @property time without time zone|null $time_open
 * @property time without time zone|null $time_close
 * @property int|null $time_slot
 * @property int|null $time_booking_min
 * @property int|null $unit_time_booking_min
 * @property int|null $time_booking_max
 * @property int|null $unit_time_booking_max
 * @property string|null $list_account_id
 * @property int|null $status
 * @property int|null $status_schedule_id
 * @property int|null $alias_id
 * 
 * @property MituStatusSchedule|null $mitu_status_schedule
 *
 * @package App\Models
 */
class MituConfigSchedule extends Model
{
	protected $table = 'mitu_config_schedule';

	protected $casts = [
		'is_active' => 'bool',
		'time_open' => 'time without time zone',
		'time_close' => 'time without time zone',
		'time_slot' => 'int',
		'time_booking_min' => 'int',
		'unit_time_booking_min' => 'int',
		'time_booking_max' => 'int',
		'unit_time_booking_max' => 'int',
		'status' => 'int',
		'status_schedule_id' => 'int',
		'alias_id' => 'int'
	];

	protected $fillable = [
		'is_active',
		'time_open',
		'time_close',
		'time_slot',
		'time_booking_min',
		'unit_time_booking_min',
		'time_booking_max',
		'unit_time_booking_max',
		'list_account_id',
		'status',
		'status_schedule_id',
		'alias_id'
	];

	public function mitu_status_schedule()
	{
		return $this->belongsTo(MituStatusSchedule::class, 'status_schedule_id');
	}
}

<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class MituScheduleService
 * 
 * @property int $id
 * @property Carbon $created_at
 * @property Carbon $updated_at
 * @property bool $is_active
 * @property int|null $schedule_id
 * @property int|null $service_id
 * 
 * @property MituSchedule|null $mitu_schedule
 * @property MituService|null $mitu_service
 *
 * @package App\Models
 */
class MituScheduleService extends Model
{
	protected $table = 'mitu_schedule_service';

	protected $casts = [
		'is_active' => 'bool',
		'schedule_id' => 'int',
		'service_id' => 'int'
	];

	protected $fillable = [
		'is_active',
		'schedule_id',
		'service_id'
	];

	public function mitu_schedule()
	{
		return $this->belongsTo(MituSchedule::class, 'schedule_id');
	}

	public function mitu_service()
	{
		return $this->belongsTo(MituService::class, 'service_id');
	}
}

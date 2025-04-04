<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class MituShift
 * 
 * @property int $id
 * @property Carbon $created_at
 * @property Carbon $updated_at
 * @property bool $is_active
 * @property string|null $name
 * @property time without time zone|null $start_time
 * @property time without time zone|null $end_time
 * @property int|null $alias_id
 * 
 * @property Collection|MituWorkSchedule[] $mitu_work_schedules
 *
 * @package App\Models
 */
class MituShift extends Model
{
	protected $table = 'mitu_shift';

	protected $casts = [
		'is_active' => 'bool',
		'start_time' => 'time without time zone',
		'end_time' => 'time without time zone',
		'alias_id' => 'int'
	];

	protected $fillable = [
		'is_active',
		'name',
		'start_time',
		'end_time',
		'alias_id'
	];

	public function mitu_work_schedules()
	{
		return $this->hasMany(MituWorkSchedule::class, 'shift_id');
	}
}

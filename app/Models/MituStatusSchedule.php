<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class MituStatusSchedule
 * 
 * @property int $id
 * @property Carbon $created_at
 * @property Carbon $updated_at
 * @property bool $is_active
 * @property string $name
 * @property string $color
 * @property int|null $alias_id
 * @property int|null $type
 * 
 * @property Collection|MituConfigSchedule[] $mitu_config_schedules
 * @property Collection|MituSchedule[] $mitu_schedules
 *
 * @package App\Models
 */
class MituStatusSchedule extends Model
{
	protected $table = 'mitu_status_schedule';

	protected $casts = [
		'is_active' => 'bool',
		'alias_id' => 'int',
		'type' => 'int'
	];

	protected $fillable = [
		'is_active',
		'name',
		'color',
		'alias_id',
		'type'
	];

	public function mitu_config_schedules()
	{
		return $this->hasMany(MituConfigSchedule::class, 'status_schedule_id');
	}

	public function mitu_schedules()
	{
		return $this->hasMany(MituSchedule::class, 'status_schedule_id');
	}
}

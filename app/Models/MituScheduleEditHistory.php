<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class MituScheduleEditHistory
 * 
 * @property int $id
 * @property Carbon $created_at
 * @property Carbon $updated_at
 * @property bool $is_active
 * @property string|null $infor_edit
 * @property int|null $schedule_id
 * @property int|null $creator_id
 * @property int|null $alias_id
 * 
 * @property MituSchedule|null $mitu_schedule
 * @property MituAccount|null $mitu_account
 *
 * @package App\Models
 */
class MituScheduleEditHistory extends Model
{
	protected $table = 'mitu_schedule_edit_history';

	protected $casts = [
		'is_active' => 'bool',
		'schedule_id' => 'int',
		'creator_id' => 'int',
		'alias_id' => 'int'
	];

	protected $fillable = [
		'is_active',
		'infor_edit',
		'schedule_id',
		'creator_id',
		'alias_id'
	];

	public function mitu_schedule()
	{
		return $this->belongsTo(MituSchedule::class, 'schedule_id');
	}

	public function mitu_account()
	{
		return $this->belongsTo(MituAccount::class, 'creator_id');
	}
}

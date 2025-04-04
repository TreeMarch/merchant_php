<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class MituWorkSchedule
 * 
 * @property int $id
 * @property Carbon $created_at
 * @property Carbon $updated_at
 * @property bool $is_active
 * @property int|null $type
 * @property time without time zone|null $start_time
 * @property time without time zone|null $end_time
 * @property int|null $is_repeat
 * @property int|null $type_repeat
 * @property string|null $note
 * @property int|null $shift_id
 * @property int|null $account_id
 * @property int|null $alias_id
 * 
 * @property MituShift|null $mitu_shift
 * @property MituAccount|null $mitu_account
 *
 * @package App\Models
 */
class MituWorkSchedule extends Model
{
	protected $table = 'mitu_work_schedule';

	protected $casts = [
		'is_active' => 'bool',
		'type' => 'int',
		'start_time' => 'time without time zone',
		'end_time' => 'time without time zone',
		'is_repeat' => 'int',
		'type_repeat' => 'int',
		'shift_id' => 'int',
		'account_id' => 'int',
		'alias_id' => 'int'
	];

	protected $fillable = [
		'is_active',
		'type',
		'start_time',
		'end_time',
		'is_repeat',
		'type_repeat',
		'note',
		'shift_id',
		'account_id',
		'alias_id'
	];

	public function mitu_shift()
	{
		return $this->belongsTo(MituShift::class, 'shift_id');
	}

	public function mitu_account()
	{
		return $this->belongsTo(MituAccount::class, 'account_id');
	}
}

<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class MituMailOtp
 * 
 * @property int $id
 * @property Carbon $created_at
 * @property Carbon $updated_at
 * @property bool $is_active
 * @property int|null $otp
 * @property string|null $email
 * @property int|null $alias_id
 * @property Carbon $start_time
 * @property Carbon $end_time
 *
 * @package App\Models
 */
class MituMailOtp extends Model
{
	protected $table = 'mitu_mail_otp';

	protected $casts = [
		'is_active' => 'bool',
		'otp' => 'int',
		'alias_id' => 'int',
		'start_time' => 'datetime',
		'end_time' => 'datetime'
	];

	protected $fillable = [
		'is_active',
		'otp',
		'email',
		'alias_id',
		'start_time',
		'end_time'
	];
}

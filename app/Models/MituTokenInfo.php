<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class MituTokenInfo
 * 
 * @property int $id
 * @property Carbon $created_at
 * @property Carbon $updated_at
 * @property bool $is_active
 * @property string|null $device_id
 * @property string|null $fcm_token
 * @property string|null $platform
 * @property int|null $account_id
 * 
 * @property MituAccount|null $mitu_account
 *
 * @package App\Models
 */
class MituTokenInfo extends Model
{
	protected $table = 'mitu_token_info';

	protected $casts = [
		'is_active' => 'bool',
		'account_id' => 'int'
	];

	protected $hidden = [
		'fcm_token'
	];

	protected $fillable = [
		'is_active',
		'device_id',
		'fcm_token',
		'platform',
		'account_id'
	];

	public function mitu_account()
	{
		return $this->belongsTo(MituAccount::class, 'account_id');
	}
}

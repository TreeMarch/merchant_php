<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class MituLoginHistory
 * 
 * @property int $id
 * @property Carbon $created_at
 * @property Carbon $updated_at
 * @property bool $is_active
 * @property int|null $account_id
 * 
 * @property MituAccount|null $mitu_account
 *
 * @package App\Models
 */
class MituLoginHistory extends Model
{
	protected $table = 'mitu_login_history';

	protected $casts = [
		'is_active' => 'bool',
		'account_id' => 'int'
	];

	protected $fillable = [
		'is_active',
		'account_id'
	];

	public function mitu_account()
	{
		return $this->belongsTo(MituAccount::class, 'account_id');
	}
}

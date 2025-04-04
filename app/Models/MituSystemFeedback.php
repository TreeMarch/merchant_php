<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class MituSystemFeedback
 * 
 * @property int $id
 * @property Carbon $created_at
 * @property Carbon $updated_at
 * @property bool $is_active
 * @property string|null $comment
 * @property int|null $alias_id
 * @property int|null $account_id
 * 
 * @property MituAlias|null $mitu_alias
 * @property MituAccount|null $mitu_account
 *
 * @package App\Models
 */
class MituSystemFeedback extends Model
{
	protected $table = 'mitu_system_feedback';

	protected $casts = [
		'is_active' => 'bool',
		'alias_id' => 'int',
		'account_id' => 'int'
	];

	protected $fillable = [
		'is_active',
		'comment',
		'alias_id',
		'account_id'
	];

	public function mitu_alias()
	{
		return $this->belongsTo(MituAlias::class, 'alias_id');
	}

	public function mitu_account()
	{
		return $this->belongsTo(MituAccount::class, 'account_id');
	}
}

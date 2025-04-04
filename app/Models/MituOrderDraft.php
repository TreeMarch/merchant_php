<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class MituOrderDraft
 * 
 * @property int $id
 * @property Carbon $created_at
 * @property Carbon $updated_at
 * @property bool $is_active
 * @property string|null $draft
 * @property int|null $creator_id
 * @property int|null $alias_id
 * 
 * @property MituAccount|null $mitu_account
 *
 * @package App\Models
 */
class MituOrderDraft extends Model
{
	protected $table = 'mitu_order_draft';

	protected $casts = [
		'is_active' => 'bool',
		'creator_id' => 'int',
		'alias_id' => 'int'
	];

	protected $fillable = [
		'is_active',
		'draft',
		'creator_id',
		'alias_id'
	];

	public function mitu_account()
	{
		return $this->belongsTo(MituAccount::class, 'creator_id');
	}
}

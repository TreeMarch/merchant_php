<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class MituAccountOrder
 * 
 * @property int $id
 * @property Carbon $created_at
 * @property Carbon $updated_at
 * @property bool $is_active
 * @property string|null $name
 * @property int|null $type
 * @property float|null $commission_percentage
 * @property float|null $commission
 * @property float|null $star
 * @property Carbon|null $evaluation_time
 * @property int|null $alias_id
 * @property int|null $account_id
 * @property int|null $order_detail_id
 * 
 * @property MituAccount|null $mitu_account
 * @property MituOrderDetail|null $mitu_order_detail
 *
 * @package App\Models
 */
class MituAccountOrder extends Model
{
	protected $table = 'mitu_account_order';

	protected $casts = [
		'is_active' => 'bool',
		'type' => 'int',
		'commission_percentage' => 'float',
		'commission' => 'float',
		'star' => 'float',
		'evaluation_time' => 'datetime',
		'alias_id' => 'int',
		'account_id' => 'int',
		'order_detail_id' => 'int'
	];

	protected $fillable = [
		'is_active',
		'name',
		'type',
		'commission_percentage',
		'commission',
		'star',
		'evaluation_time',
		'alias_id',
		'account_id',
		'order_detail_id'
	];

	public function mitu_account()
	{
		return $this->belongsTo(MituAccount::class, 'account_id');
	}

	public function mitu_order_detail()
	{
		return $this->belongsTo(MituOrderDetail::class, 'order_detail_id');
	}
}

<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class MituPrepaidCardFaceValue
 * 
 * @property int $id
 * @property Carbon $created_at
 * @property Carbon $updated_at
 * @property bool $is_active
 * @property string|null $name
 * @property float|null $denominations
 * @property float|null $price
 * @property float|null $use_time
 * @property string|null $note
 * @property float|null $staff_commission
 * @property float|null $staff_commission_percentage
 * @property int|null $status
 * @property int|null $alias_id
 * 
 * @property Collection|MituOrderDetail[] $mitu_order_details
 * @property Collection|MituShoppingCart[] $mitu_shopping_carts
 *
 * @package App\Models
 */
class MituPrepaidCardFaceValue extends Model
{
	protected $table = 'mitu_prepaid_card_face_value';

	protected $casts = [
		'is_active' => 'bool',
		'denominations' => 'float',
		'price' => 'float',
		'use_time' => 'float',
		'staff_commission' => 'float',
		'staff_commission_percentage' => 'float',
		'status' => 'int',
		'alias_id' => 'int'
	];

	protected $fillable = [
		'is_active',
		'name',
		'denominations',
		'price',
		'use_time',
		'note',
		'staff_commission',
		'staff_commission_percentage',
		'status',
		'alias_id'
	];

	public function mitu_order_details()
	{
		return $this->hasMany(MituOrderDetail::class, 'prepaid_card_face_value_id');
	}

	public function mitu_shopping_carts()
	{
		return $this->hasMany(MituShoppingCart::class, 'prepaid_card_face_value_id');
	}
}

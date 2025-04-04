<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class MituOrderDetailPrepaidCard
 * 
 * @property int $id
 * @property Carbon $created_at
 * @property Carbon $updated_at
 * @property bool $is_active
 * @property float|null $money_spent
 * @property float|null $remaining_amount
 * @property int|null $alias_id
 * @property int|null $order_detail_information_id
 * @property int|null $creator_id
 * @property int|null $order_id
 * 
 * @property MituOrderDetailInformation|null $mitu_order_detail_information
 * @property MituAccount|null $mitu_account
 * @property MituOrder|null $mitu_order
 * @property Collection|MituPaymentMethodsDetail[] $mitu_payment_methods_details
 * @property Collection|MituPrepaidCardPayOrder[] $mitu_prepaid_card_pay_orders
 *
 * @package App\Models
 */
class MituOrderDetailPrepaidCard extends Model
{
	protected $table = 'mitu_order_detail_prepaid_card';

	protected $casts = [
		'is_active' => 'bool',
		'money_spent' => 'float',
		'remaining_amount' => 'float',
		'alias_id' => 'int',
		'order_detail_information_id' => 'int',
		'creator_id' => 'int',
		'order_id' => 'int'
	];

	protected $fillable = [
		'is_active',
		'money_spent',
		'remaining_amount',
		'alias_id',
		'order_detail_information_id',
		'creator_id',
		'order_id'
	];

	public function mitu_order_detail_information()
	{
		return $this->belongsTo(MituOrderDetailInformation::class, 'order_detail_information_id');
	}

	public function mitu_account()
	{
		return $this->belongsTo(MituAccount::class, 'creator_id');
	}

	public function mitu_order()
	{
		return $this->belongsTo(MituOrder::class, 'order_id');
	}

	public function mitu_payment_methods_details()
	{
		return $this->hasMany(MituPaymentMethodsDetail::class, 'order_detail_prepaid_card_id');
	}

	public function mitu_prepaid_card_pay_orders()
	{
		return $this->hasMany(MituPrepaidCardPayOrder::class, 'order_detail_prepaid_card_id');
	}
}

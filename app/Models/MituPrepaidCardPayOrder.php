<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class MituPrepaidCardPayOrder
 * 
 * @property int $id
 * @property Carbon $created_at
 * @property Carbon $updated_at
 * @property bool $is_active
 * @property int|null $order_detail_prepaid_card_id
 * @property int|null $order_id
 * @property float|null $money_spent
 * 
 * @property MituOrderDetailPrepaidCard|null $mitu_order_detail_prepaid_card
 * @property MituOrder|null $mitu_order
 *
 * @package App\Models
 */
class MituPrepaidCardPayOrder extends Model
{
	protected $table = 'mitu_prepaid_card_pay_order';

	protected $casts = [
		'is_active' => 'bool',
		'order_detail_prepaid_card_id' => 'int',
		'order_id' => 'int',
		'money_spent' => 'float'
	];

	protected $fillable = [
		'is_active',
		'order_detail_prepaid_card_id',
		'order_id',
		'money_spent'
	];

	public function mitu_order_detail_prepaid_card()
	{
		return $this->belongsTo(MituOrderDetailPrepaidCard::class, 'order_detail_prepaid_card_id');
	}

	public function mitu_order()
	{
		return $this->belongsTo(MituOrder::class, 'order_id');
	}
}

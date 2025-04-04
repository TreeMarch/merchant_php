<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class MituOrderDetailTreatment
 * 
 * @property int $id
 * @property Carbon $created_at
 * @property Carbon $updated_at
 * @property bool $is_active
 * @property int|null $order_detail_information_id
 * @property int|null $payment_methods_detail_id
 * @property int|null $order_id
 * @property int|null $creator_id
 * @property string|null $name
 * @property int|null $quantity
 * @property int|null $alias_id
 * 
 * @property MituOrderDetailInformation|null $mitu_order_detail_information
 * @property MituPaymentMethodsDetail|null $mitu_payment_methods_detail
 * @property MituOrder|null $mitu_order
 * @property MituAccount|null $mitu_account
 *
 * @package App\Models
 */
class MituOrderDetailTreatment extends Model
{
	protected $table = 'mitu_order_detail_treatment';

	protected $casts = [
		'is_active' => 'bool',
		'order_detail_information_id' => 'int',
		'payment_methods_detail_id' => 'int',
		'order_id' => 'int',
		'creator_id' => 'int',
		'quantity' => 'int',
		'alias_id' => 'int'
	];

	protected $fillable = [
		'is_active',
		'order_detail_information_id',
		'payment_methods_detail_id',
		'order_id',
		'creator_id',
		'name',
		'quantity',
		'alias_id'
	];

	public function mitu_order_detail_information()
	{
		return $this->belongsTo(MituOrderDetailInformation::class, 'order_detail_information_id');
	}

	public function mitu_payment_methods_detail()
	{
		return $this->belongsTo(MituPaymentMethodsDetail::class, 'payment_methods_detail_id');
	}

	public function mitu_order()
	{
		return $this->belongsTo(MituOrder::class, 'order_id');
	}

	public function mitu_account()
	{
		return $this->belongsTo(MituAccount::class, 'creator_id');
	}
}

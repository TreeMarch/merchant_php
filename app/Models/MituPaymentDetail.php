<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class MituPaymentDetail
 * 
 * @property int $id
 * @property Carbon $created_at
 * @property Carbon $updated_at
 * @property bool $is_active
 * @property int|null $quantity
 * @property int|null $status
 * @property float|null $price
 * @property int|null $alias_id
 * @property int|null $order_id
 * @property int|null $service_id
 * @property int|null $payment_methods_detail_id
 * @property int|null $type
 * @property int|null $product_id
 * 
 * @property MituService|null $mitu_service
 * @property MituPaymentMethodsDetail|null $mitu_payment_methods_detail
 * @property MituProduct|null $mitu_product
 *
 * @package App\Models
 */
class MituPaymentDetail extends Model
{
	protected $table = 'mitu_payment_detail';

	protected $casts = [
		'is_active' => 'bool',
		'quantity' => 'int',
		'status' => 'int',
		'price' => 'float',
		'alias_id' => 'int',
		'order_id' => 'int',
		'service_id' => 'int',
		'payment_methods_detail_id' => 'int',
		'type' => 'int',
		'product_id' => 'int'
	];

	protected $fillable = [
		'is_active',
		'quantity',
		'status',
		'price',
		'alias_id',
		'order_id',
		'service_id',
		'payment_methods_detail_id',
		'type',
		'product_id'
	];

	public function mitu_service()
	{
		return $this->belongsTo(MituService::class, 'service_id');
	}

	public function mitu_payment_methods_detail()
	{
		return $this->belongsTo(MituPaymentMethodsDetail::class, 'payment_methods_detail_id');
	}

	public function mitu_product()
	{
		return $this->belongsTo(MituProduct::class, 'product_id');
	}
}

<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class MituPaymentMethodsDetail
 * 
 * @property int $id
 * @property Carbon $created_at
 * @property Carbon $updated_at
 * @property bool $is_active
 * @property int|null $paid
 * @property int|null $type
 * @property int|null $total_treatment
 * @property int|null $type_debt
 * @property int|null $order_id
 * @property int|null $payment_methods_id
 * @property int|null $order_detail_prepaid_card_id
 * @property int|null $order_detail_information_id
 * @property string|null $number_of_services_used
 * 
 * @property MituOrder|null $mitu_order
 * @property MituPaymentMethod|null $mitu_payment_method
 * @property MituOrderDetailPrepaidCard|null $mitu_order_detail_prepaid_card
 * @property MituOrderDetailInformation|null $mitu_order_detail_information
 * @property Collection|MituOrderDetailTreatment[] $mitu_order_detail_treatments
 * @property Collection|MituPaymentDetail[] $mitu_payment_details
 *
 * @package App\Models
 */
class MituPaymentMethodsDetail extends Model
{
	protected $table = 'mitu_payment_methods_detail';

	protected $casts = [
		'is_active' => 'bool',
		'paid' => 'int',
		'type' => 'int',
		'total_treatment' => 'int',
		'type_debt' => 'int',
		'order_id' => 'int',
		'payment_methods_id' => 'int',
		'order_detail_prepaid_card_id' => 'int',
		'order_detail_information_id' => 'int'
	];

	protected $fillable = [
		'is_active',
		'paid',
		'type',
		'total_treatment',
		'type_debt',
		'order_id',
		'payment_methods_id',
		'order_detail_prepaid_card_id',
		'order_detail_information_id',
		'number_of_services_used'
	];

	public function mitu_order()
	{
		return $this->belongsTo(MituOrder::class, 'order_id');
	}

	public function mitu_payment_method()
	{
		return $this->belongsTo(MituPaymentMethod::class, 'payment_methods_id');
	}

	public function mitu_order_detail_prepaid_card()
	{
		return $this->belongsTo(MituOrderDetailPrepaidCard::class, 'order_detail_prepaid_card_id');
	}

	public function mitu_order_detail_information()
	{
		return $this->belongsTo(MituOrderDetailInformation::class, 'order_detail_information_id');
	}

	public function mitu_order_detail_treatments()
	{
		return $this->hasMany(MituOrderDetailTreatment::class, 'payment_methods_detail_id');
	}

	public function mitu_payment_details()
	{
		return $this->hasMany(MituPaymentDetail::class, 'payment_methods_detail_id');
	}
}

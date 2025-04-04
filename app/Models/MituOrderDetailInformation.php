<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class MituOrderDetailInformation
 * 
 * @property int $id
 * @property Carbon $created_at
 * @property Carbon $updated_at
 * @property bool $is_active
 * @property float|null $unit_price
 * @property float|null $remaining_amount_of_prepaid_card
 * @property float|null $amount_used
 * @property int|null $number_of_treatment_used
 * @property int|null $number_of_remaining_treatments
 * @property float|null $use_time
 * @property Carbon|null $expiration_date
 * @property int|null $alias_id
 * @property int|null $order_detail_id
 * @property int|null $type_card
 * @property string|null $name
 * @property int|null $purchaser_id
 * 
 * @property MituOrderDetail|null $mitu_order_detail
 * @property MituCustomer|null $mitu_customer
 * @property Collection|MituOrderDetailInformationTreatment[] $mitu_order_detail_information_treatments
 * @property Collection|MituOrderDetailPrepaidCard[] $mitu_order_detail_prepaid_cards
 * @property Collection|MituOrderDetailTreatment[] $mitu_order_detail_treatments
 * @property Collection|MituPaymentMethodsDetail[] $mitu_payment_methods_details
 *
 * @package App\Models
 */
class MituOrderDetailInformation extends Model
{
	protected $table = 'mitu_order_detail_information';

	protected $casts = [
		'is_active' => 'bool',
		'unit_price' => 'float',
		'remaining_amount_of_prepaid_card' => 'float',
		'amount_used' => 'float',
		'number_of_treatment_used' => 'int',
		'number_of_remaining_treatments' => 'int',
		'use_time' => 'float',
		'expiration_date' => 'datetime',
		'alias_id' => 'int',
		'order_detail_id' => 'int',
		'type_card' => 'int',
		'purchaser_id' => 'int'
	];

	protected $fillable = [
		'is_active',
		'unit_price',
		'remaining_amount_of_prepaid_card',
		'amount_used',
		'number_of_treatment_used',
		'number_of_remaining_treatments',
		'use_time',
		'expiration_date',
		'alias_id',
		'order_detail_id',
		'type_card',
		'name',
		'purchaser_id'
	];

	public function mitu_order_detail()
	{
		return $this->belongsTo(MituOrderDetail::class, 'order_detail_id');
	}

	public function mitu_customer()
	{
		return $this->belongsTo(MituCustomer::class, 'purchaser_id');
	}

	public function mitu_order_detail_information_treatments()
	{
		return $this->hasMany(MituOrderDetailInformationTreatment::class, 'order_detail_information_id');
	}

	public function mitu_order_detail_prepaid_cards()
	{
		return $this->hasMany(MituOrderDetailPrepaidCard::class, 'order_detail_information_id');
	}

	public function mitu_order_detail_treatments()
	{
		return $this->hasMany(MituOrderDetailTreatment::class, 'order_detail_information_id');
	}

	public function mitu_payment_methods_details()
	{
		return $this->hasMany(MituPaymentMethodsDetail::class, 'order_detail_information_id');
	}
}

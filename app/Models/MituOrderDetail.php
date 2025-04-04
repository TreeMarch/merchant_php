<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class MituOrderDetail
 *
 * @property int $id
 * @property Carbon $created_at
 * @property Carbon $updated_at
 * @property bool $is_active
 * @property string|null $name
 * @property int|null $quantity
 * @property float|null $price
 * @property int|null $type
 * @property int|null $status_check
 * @property string|null $note_check
 * @property int|null $alias_id
 * @property int|null $order_id
 * @property int|null $prepaid_card_face_value_id
 * @property int|null $treatment_id
 * @property int|null $product_id
 * @property int|null $service_id
 * @property float|null $discount
 * @property float|null $price_after_vip_gg_vat
 * @property int|null $is_check_server_order_by_treatment
 *
 * @property MituOrder|null $mitu_order
 * @property MituPrepaidCardFaceValue|null $mitu_prepaid_card_face_value
 * @property MituTreatment|null $mitu_treatment
 * @property MituProduct|null $mitu_product
 * @property MituService|null $mitu_service
 * @property Collection|MituOrderDetailInformation[] $mitu_order_detail_informations
 * @property Collection|MituAccountOrder[] $mitu_account_orders
 *
 * @package App\Models
 */
class MituOrderDetail extends Model
{
	protected $table = 'mitu_order_detail';

	protected $casts = [
		'is_active' => 'bool',
		'quantity' => 'int',
		'price' => 'float',
		'type' => 'int',
		'status_check' => 'int',
		'alias_id' => 'int',
		'order_id' => 'int',
		'prepaid_card_face_value_id' => 'int',
		'treatment_id' => 'int',
		'product_id' => 'int',
		'service_id' => 'int',
		'discount' => 'float',
		'price_after_vip_gg_vat' => 'float',
		'is_check_server_order_by_treatment' => 'int'
	];

	protected $fillable = [
		'is_active',
		'name',
		'quantity',
		'price',
		'type',
		'status_check',
		'note_check',
		'alias_id',
		'order_id',
		'prepaid_card_face_value_id',
		'treatment_id',
		'product_id',
		'service_id',
		'discount',
		'price_after_vip_gg_vat',
		'is_check_server_order_by_treatment'
	];

    public function product()
    {
        return $this->belongsTo(MituProduct::class, 'product_id');
    }

	public function mitu_order()
	{
		return $this->belongsTo(MituOrder::class, 'order_id');
	}

	public function mitu_prepaid_card_face_value()
	{
		return $this->belongsTo(MituPrepaidCardFaceValue::class, 'prepaid_card_face_value_id');
	}

	public function mitu_treatment()
	{
		return $this->belongsTo(MituTreatment::class, 'treatment_id');
	}

	public function mitu_product()
	{
		return $this->belongsTo(MituProduct::class, 'product_id');
	}

	public function mitu_service()
	{
		return $this->belongsTo(MituService::class, 'service_id');
	}

	public function mitu_order_detail_informations()
	{
		return $this->hasMany(MituOrderDetailInformation::class, 'order_detail_id');
	}

	public function mitu_account_orders()
	{
		return $this->hasMany(MituAccountOrder::class, 'order_detail_id');
	}
}

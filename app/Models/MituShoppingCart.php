<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class MituShoppingCart
 * 
 * @property int $id
 * @property Carbon $created_at
 * @property Carbon $updated_at
 * @property bool $is_active
 * @property int|null $quanity
 * @property int|null $alias_id
 * @property int|null $service_id
 * @property int|null $product_id
 * @property int|null $treatment_id
 * @property int|null $prepaid_card_face_value_id
 * 
 * @property MituService|null $mitu_service
 * @property MituProduct|null $mitu_product
 * @property MituTreatment|null $mitu_treatment
 * @property MituPrepaidCardFaceValue|null $mitu_prepaid_card_face_value
 *
 * @package App\Models
 */
class MituShoppingCart extends Model
{
	protected $table = 'mitu_shopping_cart';

	protected $casts = [
		'is_active' => 'bool',
		'quanity' => 'int',
		'alias_id' => 'int',
		'service_id' => 'int',
		'product_id' => 'int',
		'treatment_id' => 'int',
		'prepaid_card_face_value_id' => 'int'
	];

	protected $fillable = [
		'is_active',
		'quanity',
		'alias_id',
		'service_id',
		'product_id',
		'treatment_id',
		'prepaid_card_face_value_id'
	];

	public function mitu_service()
	{
		return $this->belongsTo(MituService::class, 'service_id');
	}

	public function mitu_product()
	{
		return $this->belongsTo(MituProduct::class, 'product_id');
	}

	public function mitu_treatment()
	{
		return $this->belongsTo(MituTreatment::class, 'treatment_id');
	}

	public function mitu_prepaid_card_face_value()
	{
		return $this->belongsTo(MituPrepaidCardFaceValue::class, 'prepaid_card_face_value_id');
	}
}

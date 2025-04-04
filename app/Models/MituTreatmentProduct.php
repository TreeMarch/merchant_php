<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class MituTreatmentProduct
 * 
 * @property int $id
 * @property Carbon $created_at
 * @property Carbon $updated_at
 * @property bool $is_active
 * @property int|null $treatment_id
 * @property int|null $product_id
 * 
 * @property MituTreatment|null $mitu_treatment
 * @property MituProduct|null $mitu_product
 *
 * @package App\Models
 */
class MituTreatmentProduct extends Model
{
	protected $table = 'mitu_treatment_product';

	protected $casts = [
		'is_active' => 'bool',
		'treatment_id' => 'int',
		'product_id' => 'int'
	];

	protected $fillable = [
		'is_active',
		'treatment_id',
		'product_id'
	];

	public function mitu_treatment()
	{
		return $this->belongsTo(MituTreatment::class, 'treatment_id');
	}

	public function mitu_product()
	{
		return $this->belongsTo(MituProduct::class, 'product_id');
	}
}

<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class MituProductTypeProduct
 * 
 * @property int $id
 * @property Carbon $created_at
 * @property Carbon $updated_at
 * @property bool $is_active
 * @property int|null $product_id
 * @property int|null $product_type_id
 * 
 * @property MituProduct|null $mitu_product
 * @property MituProductType|null $mitu_product_type
 *
 * @package App\Models
 */
class MituProductTypeProduct extends Model
{
	protected $table = 'mitu_product_type_product';

	protected $casts = [
		'is_active' => 'bool',
		'product_id' => 'int',
		'product_type_id' => 'int'
	];

	protected $fillable = [
		'is_active',
		'product_id',
		'product_type_id'
	];

	public function mitu_product()
	{
		return $this->belongsTo(MituProduct::class, 'product_id');
	}

	public function mitu_product_type()
	{
		return $this->belongsTo(MituProductType::class, 'product_type_id');
	}
}

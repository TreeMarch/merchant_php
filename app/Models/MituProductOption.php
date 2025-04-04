<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class MituProductOption
 * 
 * @property int $id
 * @property Carbon $created_at
 * @property Carbon $updated_at
 * @property bool $is_active
 * @property string|null $name
 * @property string|null $value
 * @property int|null $product_id
 * 
 * @property MituProduct|null $mitu_product
 *
 * @package App\Models
 */
class MituProductOption extends Model
{
	protected $table = 'mitu_product-option';

	protected $casts = [
		'is_active' => 'bool',
		'product_id' => 'int'
	];

	protected $fillable = [
		'is_active',
		'name',
		'value',
		'product_id'
	];

	public function mitu_product()
	{
		return $this->belongsTo(MituProduct::class, 'product_id');
	}
}

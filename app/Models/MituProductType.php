<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class MituProductType
 * 
 * @property int $id
 * @property Carbon $created_at
 * @property Carbon $updated_at
 * @property bool $is_active
 * @property string $name
 * @property int|null $alias_id
 * 
 * @property Collection|MituProductTypeProduct[] $mitu_product_type_products
 *
 * @package App\Models
 */
class MituProductType extends Model
{
	protected $table = 'mitu_product_type';

	protected $casts = [
		'is_active' => 'bool',
		'alias_id' => 'int'
	];

	protected $fillable = [
		'is_active',
		'name',
		'alias_id'
	];

	public function mitu_product_type_products()
	{
		return $this->hasMany(MituProductTypeProduct::class, 'product_type_id');
	}
}

<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class MituProductCategory
 * 
 * @property int $id
 * @property Carbon $created_at
 * @property Carbon $updated_at
 * @property bool $is_active
 * @property string $name
 * @property bool $is_publish
 * @property int|null $status
 * @property int|null $alias_id
 * 
 * @property Collection|MituProduct[] $mitu_products
 *
 * @package App\Models
 */
class MituProductCategory extends Model
{
	protected $table = 'mitu_product_category';

	protected $casts = [
		'is_active' => 'bool',
		'is_publish' => 'bool',
		'status' => 'int',
		'alias_id' => 'int'
	];

	protected $fillable = [
		'is_active',
		'name',
		'is_publish',
		'status',
		'alias_id'
	];

	public function mitu_products()
	{
		return $this->hasMany(MituProduct::class, 'product_category_id');
	}
}

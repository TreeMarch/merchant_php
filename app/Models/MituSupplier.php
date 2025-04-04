<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class MituSupplier
 * 
 * @property int $id
 * @property Carbon $created_at
 * @property Carbon $updated_at
 * @property bool $is_active
 * @property string|null $name
 * @property string|null $email
 * @property string|null $phone_number
 * @property int|null $alias_id
 * 
 * @property Collection|MituProduct[] $mitu_products
 *
 * @package App\Models
 */
class MituSupplier extends Model
{
	protected $table = 'mitu_supplier';

	protected $casts = [
		'is_active' => 'bool',
		'alias_id' => 'int'
	];

	protected $fillable = [
		'is_active',
		'name',
		'email',
		'phone_number',
		'alias_id'
	];

	public function mitu_products()
	{
		return $this->hasMany(MituProduct::class, 'supplier_id');
	}
}

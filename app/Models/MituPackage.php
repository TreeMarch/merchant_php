<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class MituPackage
 * 
 * @property int $id
 * @property Carbon $created_at
 * @property Carbon $updated_at
 * @property bool $is_active
 * @property string|null $name
 * @property int|null $price
 * @property int|null $time
 * @property int|null $user_limited
 * 
 * @property Collection|MituPackageDetail[] $mitu_package_details
 *
 * @package App\Models
 */
class MituPackage extends Model
{
	protected $table = 'mitu_package';

	protected $casts = [
		'is_active' => 'bool',
		'price' => 'int',
		'time' => 'int',
		'user_limited' => 'int'
	];

	protected $fillable = [
		'is_active',
		'name',
		'price',
		'time',
		'user_limited'
	];

	public function mitu_package_details()
	{
		return $this->hasMany(MituPackageDetail::class, 'package_id');
	}
}

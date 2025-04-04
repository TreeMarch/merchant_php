<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class MituPackageDetail
 * 
 * @property int $id
 * @property Carbon $created_at
 * @property Carbon $updated_at
 * @property bool $is_active
 * @property string|null $package_infor
 * @property string|null $start_time
 * @property string|null $end_time
 * @property int|null $price
 * @property int|null $alias_id
 * @property int|null $package_id
 * 
 * @property MituAlias|null $mitu_alias
 * @property MituPackage|null $mitu_package
 *
 * @package App\Models
 */
class MituPackageDetail extends Model
{
	protected $table = 'mitu_package_detail';

	protected $casts = [
		'is_active' => 'bool',
		'price' => 'int',
		'alias_id' => 'int',
		'package_id' => 'int'
	];

	protected $fillable = [
		'is_active',
		'package_infor',
		'start_time',
		'end_time',
		'price',
		'alias_id',
		'package_id'
	];

	public function mitu_alias()
	{
		return $this->belongsTo(MituAlias::class, 'alias_id');
	}

	public function mitu_package()
	{
		return $this->belongsTo(MituPackage::class, 'package_id');
	}
}

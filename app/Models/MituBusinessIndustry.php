<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class MituBusinessIndustry
 * 
 * @property int $id
 * @property Carbon $created_at
 * @property Carbon $updated_at
 * @property bool $is_active
 * @property string|null $name
 * @property string|null $identifier_key
 * 
 * @property Collection|MituAlias[] $mitu_aliases
 *
 * @package App\Models
 */
class MituBusinessIndustry extends Model
{
	protected $table = 'mitu_business_industry';

	protected $casts = [
		'is_active' => 'bool'
	];

	protected $fillable = [
		'is_active',
		'name',
		'identifier_key'
	];

	public function mitu_aliases()
	{
		return $this->hasMany(MituAlias::class, 'business_industry_id');
	}
}

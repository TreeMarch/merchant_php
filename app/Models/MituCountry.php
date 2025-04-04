<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class MituCountry
 * 
 * @property int $id
 * @property Carbon $created_at
 * @property Carbon $updated_at
 * @property bool $is_active
 * @property string|null $name
 * 
 * @property Collection|MituCity[] $mitu_cities
 *
 * @package App\Models
 */
class MituCountry extends Model
{
	protected $table = 'mitu_country';

	protected $casts = [
		'is_active' => 'bool'
	];

	protected $fillable = [
		'is_active',
		'name'
	];

	public function mitu_cities()
	{
		return $this->hasMany(MituCity::class, 'country_id');
	}
}

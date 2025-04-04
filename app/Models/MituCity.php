<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class MituCity
 * 
 * @property int $id
 * @property Carbon $created_at
 * @property Carbon $updated_at
 * @property bool $is_active
 * @property string|null $name
 * @property int|null $country_id
 * 
 * @property MituCountry|null $mitu_country
 *
 * @package App\Models
 */
class MituCity extends Model
{
	protected $table = 'mitu_city';

	protected $casts = [
		'is_active' => 'bool',
		'country_id' => 'int'
	];

	protected $fillable = [
		'is_active',
		'name',
		'country_id'
	];

	public function mitu_country()
	{
		return $this->belongsTo(MituCountry::class, 'country_id');
	}
}

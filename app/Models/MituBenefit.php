<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class MituBenefit
 * 
 * @property int $id
 * @property Carbon $created_at
 * @property Carbon $updated_at
 * @property bool $is_active
 * @property string|null $name
 * @property int|null $alias_id
 * 
 * @property Collection|MituCustomerClassificationBenefit[] $mitu_customer_classification_benefits
 *
 * @package App\Models
 */
class MituBenefit extends Model
{
	protected $table = 'mitu_benefit';

	protected $casts = [
		'is_active' => 'bool',
		'alias_id' => 'int'
	];

	protected $fillable = [
		'is_active',
		'name',
		'alias_id'
	];

	public function mitu_customer_classification_benefits()
	{
		return $this->hasMany(MituCustomerClassificationBenefit::class, 'benefit_id');
	}
}

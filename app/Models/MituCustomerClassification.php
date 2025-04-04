<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class MituCustomerClassification
 * 
 * @property int $id
 * @property Carbon $created_at
 * @property Carbon $updated_at
 * @property bool $is_active
 * @property string|null $rank
 * @property int|null $required_amount
 * @property float|null $discount
 * @property float|null $bonus
 * @property int|null $status
 * @property string|null $color_code
 * @property int|null $alias_id
 * 
 * @property Collection|MituCustomerClassificationBenefit[] $mitu_customer_classification_benefits
 * @property Collection|MituCustomer[] $mitu_customers
 *
 * @package App\Models
 */
class MituCustomerClassification extends Model
{
	protected $table = 'mitu_customer_classification';

	protected $casts = [
		'is_active' => 'bool',
		'required_amount' => 'int',
		'discount' => 'float',
		'bonus' => 'float',
		'status' => 'int',
		'alias_id' => 'int'
	];

	protected $fillable = [
		'is_active',
		'rank',
		'required_amount',
		'discount',
		'bonus',
		'status',
		'color_code',
		'alias_id'
	];

	public function mitu_customer_classification_benefits()
	{
		return $this->hasMany(MituCustomerClassificationBenefit::class, 'customer_classification_id');
	}

	public function mitu_customers()
	{
		return $this->hasMany(MituCustomer::class, 'customer_classification_id');
	}
}

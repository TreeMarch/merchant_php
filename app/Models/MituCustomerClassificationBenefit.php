<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class MituCustomerClassificationBenefit
 * 
 * @property int $id
 * @property Carbon $created_at
 * @property Carbon $updated_at
 * @property bool $is_active
 * @property int|null $benefit_id
 * @property int|null $customer_classification_id
 * 
 * @property MituBenefit|null $mitu_benefit
 * @property MituCustomerClassification|null $mitu_customer_classification
 *
 * @package App\Models
 */
class MituCustomerClassificationBenefit extends Model
{
	protected $table = 'mitu_customer_classification_benefit';

	protected $casts = [
		'is_active' => 'bool',
		'benefit_id' => 'int',
		'customer_classification_id' => 'int'
	];

	protected $fillable = [
		'is_active',
		'benefit_id',
		'customer_classification_id'
	];

	public function mitu_benefit()
	{
		return $this->belongsTo(MituBenefit::class, 'benefit_id');
	}

	public function mitu_customer_classification()
	{
		return $this->belongsTo(MituCustomerClassification::class, 'customer_classification_id');
	}
}

<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class MituRateService
 * 
 * @property int $id
 * @property Carbon $created_at
 * @property Carbon $updated_at
 * @property bool $is_active
 * @property float|null $star
 * @property int|null $alias_id
 * @property int|null $evaluation_criteria_id
 * @property int|null $order_id
 * 
 * @property MituEvaluationCriterion|null $mitu_evaluation_criterion
 * @property MituOrder|null $mitu_order
 *
 * @package App\Models
 */
class MituRateService extends Model
{
	protected $table = 'mitu_rate_service';

	protected $casts = [
		'is_active' => 'bool',
		'star' => 'float',
		'alias_id' => 'int',
		'evaluation_criteria_id' => 'int',
		'order_id' => 'int'
	];

	protected $fillable = [
		'is_active',
		'star',
		'alias_id',
		'evaluation_criteria_id',
		'order_id'
	];

	public function mitu_evaluation_criterion()
	{
		return $this->belongsTo(MituEvaluationCriterion::class, 'evaluation_criteria_id');
	}

	public function mitu_order()
	{
		return $this->belongsTo(MituOrder::class, 'order_id');
	}
}

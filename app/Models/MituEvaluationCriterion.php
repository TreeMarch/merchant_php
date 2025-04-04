<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class MituEvaluationCriterion
 * 
 * @property int $id
 * @property Carbon $created_at
 * @property Carbon $updated_at
 * @property bool $is_active
 * @property string|null $name
 * @property int|null $status
 * @property int|null $alias_id
 * 
 * @property Collection|MituRateService[] $mitu_rate_services
 *
 * @package App\Models
 */
class MituEvaluationCriterion extends Model
{
	protected $table = 'mitu_evaluation_criteria';

	protected $casts = [
		'is_active' => 'bool',
		'status' => 'int',
		'alias_id' => 'int'
	];

	protected $fillable = [
		'is_active',
		'name',
		'status',
		'alias_id'
	];

	public function mitu_rate_services()
	{
		return $this->hasMany(MituRateService::class, 'evaluation_criteria_id');
	}
}

<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class MituTreatmentService
 * 
 * @property int $id
 * @property Carbon $created_at
 * @property Carbon $updated_at
 * @property bool $is_active
 * @property int|null $treatment_id
 * @property int|null $service_id
 * @property int|null $quantity
 * 
 * @property MituTreatment|null $mitu_treatment
 * @property MituService|null $mitu_service
 *
 * @package App\Models
 */
class MituTreatmentService extends Model
{
	protected $table = 'mitu_treatment_service';

	protected $casts = [
		'is_active' => 'bool',
		'treatment_id' => 'int',
		'service_id' => 'int',
		'quantity' => 'int'
	];

	protected $fillable = [
		'is_active',
		'treatment_id',
		'service_id',
		'quantity'
	];

	public function mitu_treatment()
	{
		return $this->belongsTo(MituTreatment::class, 'treatment_id');
	}

	public function mitu_service()
	{
		return $this->belongsTo(MituService::class, 'service_id');
	}
}

<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class MituOrderDetailInformationTreatment
 * 
 * @property int $id
 * @property Carbon $created_at
 * @property Carbon $updated_at
 * @property bool $is_active
 * @property int|null $order_detail_information_id
 * @property int|null $service_id
 * @property int|null $origin_quantity
 * @property int|null $remaining_quantity
 * 
 * @property MituOrderDetailInformation|null $mitu_order_detail_information
 * @property MituService|null $mitu_service
 *
 * @package App\Models
 */
class MituOrderDetailInformationTreatment extends Model
{
	protected $table = 'mitu_order_detail_information_treatment';

	protected $casts = [
		'is_active' => 'bool',
		'order_detail_information_id' => 'int',
		'service_id' => 'int',
		'origin_quantity' => 'int',
		'remaining_quantity' => 'int'
	];

	protected $fillable = [
		'is_active',
		'order_detail_information_id',
		'service_id',
		'origin_quantity',
		'remaining_quantity'
	];

	public function mitu_order_detail_information()
	{
		return $this->belongsTo(MituOrderDetailInformation::class, 'order_detail_information_id');
	}

	public function mitu_service()
	{
		return $this->belongsTo(MituService::class, 'service_id');
	}
}

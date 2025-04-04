<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class MituService
 * 
 * @property int $id
 * @property Carbon $created_at
 * @property Carbon $updated_at
 * @property bool $is_active
 * @property string|null $name
 * @property int|null $time
 * @property int|null $price
 * @property int|null $status
 * @property int|null $is_book_online
 * @property string|null $description
 * @property int|null $service_catalog_id
 * @property float|null $commission
 * @property float|null $commission_percentage
 * @property string|null $link_img
 * @property string|null $link_video
 * @property int|null $alias_id
 * 
 * @property MituServiceCatalog|null $mitu_service_catalog
 * @property Collection|MituOrderDetailInformationTreatment[] $mitu_order_detail_information_treatments
 * @property Collection|MituOrderDetail[] $mitu_order_details
 * @property Collection|MituPaymentDetail[] $mitu_payment_details
 * @property Collection|MituScheduleService[] $mitu_schedule_services
 * @property Collection|MituTreatmentService[] $mitu_treatment_services
 * @property Collection|MituShoppingCart[] $mitu_shopping_carts
 *
 * @package App\Models
 */
class MituService extends Model
{
	protected $table = 'mitu_service';

	protected $casts = [
		'is_active' => 'bool',
		'time' => 'int',
		'price' => 'int',
		'status' => 'int',
		'is_book_online' => 'int',
		'service_catalog_id' => 'int',
		'commission' => 'float',
		'commission_percentage' => 'float',
		'alias_id' => 'int'
	];

	protected $fillable = [
		'is_active',
		'name',
		'time',
		'price',
		'status',
		'is_book_online',
		'description',
		'service_catalog_id',
		'commission',
		'commission_percentage',
		'link_img',
		'link_video',
		'alias_id'
	];

	public function mitu_service_catalog()
	{
		return $this->belongsTo(MituServiceCatalog::class, 'service_catalog_id');
	}

	public function mitu_order_detail_information_treatments()
	{
		return $this->hasMany(MituOrderDetailInformationTreatment::class, 'service_id');
	}

	public function mitu_order_details()
	{
		return $this->hasMany(MituOrderDetail::class, 'service_id');
	}

	public function mitu_payment_details()
	{
		return $this->hasMany(MituPaymentDetail::class, 'service_id');
	}

	public function mitu_schedule_services()
	{
		return $this->hasMany(MituScheduleService::class, 'service_id');
	}

	public function mitu_treatment_services()
	{
		return $this->hasMany(MituTreatmentService::class, 'service_id');
	}

	public function mitu_shopping_carts()
	{
		return $this->hasMany(MituShoppingCart::class, 'service_id');
	}
}

<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class MituTreatment
 * 
 * @property int $id
 * @property Carbon $created_at
 * @property Carbon $updated_at
 * @property bool $is_active
 * @property string|null $name
 * @property float|null $denominations
 * @property float|null $price
 * @property int|null $total_treatment
 * @property float|null $use_time
 * @property string|null $note
 * @property float|null $staff_commission
 * @property float|null $staff_commission_percentage
 * @property int|null $status
 * @property int|null $alias_id
 * @property int|null $type_treatment
 * 
 * @property Collection|MituOrderDetail[] $mitu_order_details
 * @property Collection|MituTreatmentProduct[] $mitu_treatment_products
 * @property Collection|MituTreatmentService[] $mitu_treatment_services
 * @property Collection|MituShoppingCart[] $mitu_shopping_carts
 *
 * @package App\Models
 */
class MituTreatment extends Model
{
	protected $table = 'mitu_treatment';

	protected $casts = [
		'is_active' => 'bool',
		'denominations' => 'float',
		'price' => 'float',
		'total_treatment' => 'int',
		'use_time' => 'float',
		'staff_commission' => 'float',
		'staff_commission_percentage' => 'float',
		'status' => 'int',
		'alias_id' => 'int',
		'type_treatment' => 'int'
	];

	protected $fillable = [
		'is_active',
		'name',
		'denominations',
		'price',
		'total_treatment',
		'use_time',
		'note',
		'staff_commission',
		'staff_commission_percentage',
		'status',
		'alias_id',
		'type_treatment'
	];

	public function mitu_order_details()
	{
		return $this->hasMany(MituOrderDetail::class, 'treatment_id');
	}

	public function mitu_treatment_products()
	{
		return $this->hasMany(MituTreatmentProduct::class, 'treatment_id');
	}

	public function mitu_treatment_services()
	{
		return $this->hasMany(MituTreatmentService::class, 'treatment_id');
	}

	public function mitu_shopping_carts()
	{
		return $this->hasMany(MituShoppingCart::class, 'treatment_id');
	}
}

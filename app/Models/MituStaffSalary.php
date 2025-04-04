<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class MituStaffSalary
 * 
 * @property int $id
 * @property Carbon $created_at
 * @property Carbon $updated_at
 * @property bool $is_active
 * @property Carbon|null $month
 * @property int|null $type
 * @property int|null $quanity
 * @property float|null $fine
 * @property float|null $money_per_quantity
 * @property float|null $total_commission
 * @property float|null $allowance
 * @property float|null $total_salary
 * @property int|null $staff_id
 * @property int|null $alias_id
 * 
 * @property MituAccount|null $mitu_account
 *
 * @package App\Models
 */
class MituStaffSalary extends Model
{
	protected $table = 'mitu_staff_salary';

	protected $casts = [
		'is_active' => 'bool',
		'month' => 'datetime',
		'type' => 'int',
		'quanity' => 'int',
		'fine' => 'float',
		'money_per_quantity' => 'float',
		'total_commission' => 'float',
		'allowance' => 'float',
		'total_salary' => 'float',
		'staff_id' => 'int',
		'alias_id' => 'int'
	];

	protected $fillable = [
		'is_active',
		'month',
		'type',
		'quanity',
		'fine',
		'money_per_quantity',
		'total_commission',
		'allowance',
		'total_salary',
		'staff_id',
		'alias_id'
	];

	public function mitu_account()
	{
		return $this->belongsTo(MituAccount::class, 'staff_id');
	}
}

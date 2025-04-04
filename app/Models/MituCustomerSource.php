<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class MituCustomerSource
 * 
 * @property int $id
 * @property Carbon $created_at
 * @property Carbon $updated_at
 * @property bool $is_active
 * @property string|null $name
 * @property int|null $status
 * @property int|null $alias_id
 * 
 * @property Collection|MituCustomer[] $mitu_customers
 *
 * @package App\Models
 */
class MituCustomerSource extends Model
{
	protected $table = 'mitu_customer_source';

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

	public function mitu_customers()
	{
		return $this->hasMany(MituCustomer::class, 'customer_source_id');
	}
}

<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class MituAccountCustomer
 * 
 * @property int $id
 * @property Carbon $created_at
 * @property Carbon $updated_at
 * @property bool $is_active
 * @property string|null $name
 * @property int|null $type
 * @property int|null $account_id
 * @property int|null $customer_id
 * 
 * @property MituAccount|null $mitu_account
 * @property MituCustomer|null $mitu_customer
 *
 * @package App\Models
 */
class MituAccountCustomer extends Model
{
	protected $table = 'mitu_account_customer';

	protected $casts = [
		'is_active' => 'bool',
		'type' => 'int',
		'account_id' => 'int',
		'customer_id' => 'int'
	];

	protected $fillable = [
		'is_active',
		'name',
		'type',
		'account_id',
		'customer_id'
	];

	public function mitu_account()
	{
		return $this->belongsTo(MituAccount::class, 'account_id');
	}

	public function mitu_customer()
	{
		return $this->belongsTo(MituCustomer::class, 'customer_id');
	}
}

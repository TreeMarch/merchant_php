<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class MituPaymentMethod
 * 
 * @property int $id
 * @property Carbon $created_at
 * @property Carbon $updated_at
 * @property bool $is_active
 * @property string|null $name
 * @property int|null $status
 * @property string|null $name_account
 * @property string|null $number_account
 * @property int|null $default_payment
 * @property string|null $fixed_qr
 * @property int|null $alias_id
 * @property int|null $bank_id
 * 
 * @property MituBank|null $mitu_bank
 * @property Collection|MituPaymentMethodsDetail[] $mitu_payment_methods_details
 *
 * @package App\Models
 */
class MituPaymentMethod extends Model
{
	protected $table = 'mitu_payment_methods';

	protected $casts = [
		'is_active' => 'bool',
		'status' => 'int',
		'default_payment' => 'int',
		'alias_id' => 'int',
		'bank_id' => 'int'
	];

	protected $fillable = [
		'is_active',
		'name',
		'status',
		'name_account',
		'number_account',
		'default_payment',
		'fixed_qr',
		'alias_id',
		'bank_id'
	];

	public function mitu_bank()
	{
		return $this->belongsTo(MituBank::class, 'bank_id');
	}

	public function mitu_payment_methods_details()
	{
		return $this->hasMany(MituPaymentMethodsDetail::class, 'payment_methods_id');
	}
}

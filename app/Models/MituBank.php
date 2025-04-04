<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class MituBank
 * 
 * @property int $id
 * @property Carbon $created_at
 * @property Carbon $updated_at
 * @property bool $is_active
 * @property string|null $name
 * @property string|null $full_name
 * @property string|null $icon
 * @property int|null $alias_id
 * 
 * @property Collection|MituPaymentMethod[] $mitu_payment_methods
 *
 * @package App\Models
 */
class MituBank extends Model
{
	protected $table = 'mitu_bank';

	protected $casts = [
		'is_active' => 'bool',
		'alias_id' => 'int'
	];

	protected $fillable = [
		'is_active',
		'name',
		'full_name',
		'icon',
		'alias_id'
	];

	public function mitu_payment_methods()
	{
		return $this->hasMany(MituPaymentMethod::class, 'bank_id');
	}
}

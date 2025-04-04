<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class MituCustomerNote
 * 
 * @property int $id
 * @property Carbon $created_at
 * @property Carbon $updated_at
 * @property bool $is_active
 * @property string|null $note
 * @property string|null $img
 * @property int|null $customer_id
 * @property int|null $account_id
 * @property int|null $alias_id
 * 
 * @property MituCustomer|null $mitu_customer
 * @property MituAccount|null $mitu_account
 *
 * @package App\Models
 */
class MituCustomerNote extends Model
{
	protected $table = 'mitu_customer_note';

	protected $casts = [
		'is_active' => 'bool',
		'customer_id' => 'int',
		'account_id' => 'int',
		'alias_id' => 'int'
	];

	protected $fillable = [
		'is_active',
		'note',
		'img',
		'customer_id',
		'account_id',
		'alias_id'
	];

	public function mitu_customer()
	{
		return $this->belongsTo(MituCustomer::class, 'customer_id');
	}

	public function mitu_account()
	{
		return $this->belongsTo(MituAccount::class, 'account_id');
	}
}

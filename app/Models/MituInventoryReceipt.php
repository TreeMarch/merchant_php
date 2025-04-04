<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class MituInventoryReceipt
 * 
 * @property int $id
 * @property Carbon $created_at
 * @property Carbon $updated_at
 * @property bool $is_active
 * @property Carbon|null $date
 * @property float|null $money_total
 * @property string|null $note
 * @property string|null $outbound_warehouse
 * @property int|null $staff_id
 * @property int|null $creator_id
 * 
 * @property MituAccount|null $mitu_account
 * @property Collection|MituInventoryReceiptDetail[] $mitu_inventory_receipt_details
 *
 * @package App\Models
 */
class MituInventoryReceipt extends Model
{
	protected $table = 'mitu_inventory_receipt';

	protected $casts = [
		'is_active' => 'bool',
		'date' => 'datetime',
		'money_total' => 'float',
		'staff_id' => 'int',
		'creator_id' => 'int'
	];

	protected $fillable = [
		'is_active',
		'date',
		'money_total',
		'note',
		'outbound_warehouse',
		'staff_id',
		'creator_id'
	];

	public function mitu_account()
	{
		return $this->belongsTo(MituAccount::class, 'creator_id');
	}

	public function mitu_inventory_receipt_details()
	{
		return $this->hasMany(MituInventoryReceiptDetail::class, 'inventory_receipt_id');
	}
}

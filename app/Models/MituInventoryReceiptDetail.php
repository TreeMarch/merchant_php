<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class MituInventoryReceiptDetail
 * 
 * @property int $id
 * @property Carbon $created_at
 * @property Carbon $updated_at
 * @property bool $is_active
 * @property int|null $product_id
 * @property string|null $barcode
 * @property int|null $inventory_receipt_id
 * @property string|null $name_product
 * @property int|null $quanity
 * @property float|null $unit_price
 * @property string|null $original_unit
 * @property string|null $shipment
 * @property Carbon|null $expiration_date
 * @property float|null $total_amount
 * 
 * @property MituProduct|null $mitu_product
 * @property MituInventoryReceipt|null $mitu_inventory_receipt
 *
 * @package App\Models
 */
class MituInventoryReceiptDetail extends Model
{
	protected $table = 'mitu_inventory_receipt_detail';

	protected $casts = [
		'is_active' => 'bool',
		'product_id' => 'int',
		'inventory_receipt_id' => 'int',
		'quanity' => 'int',
		'unit_price' => 'float',
		'expiration_date' => 'datetime',
		'total_amount' => 'float'
	];

	protected $fillable = [
		'is_active',
		'product_id',
		'barcode',
		'inventory_receipt_id',
		'name_product',
		'quanity',
		'unit_price',
		'original_unit',
		'shipment',
		'expiration_date',
		'total_amount'
	];

	public function mitu_product()
	{
		return $this->belongsTo(MituProduct::class, 'product_id');
	}

	public function mitu_inventory_receipt()
	{
		return $this->belongsTo(MituInventoryReceipt::class, 'inventory_receipt_id');
	}
}

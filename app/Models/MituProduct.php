<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class MituProduct
 *
 * @property int $id
 * @property Carbon $created_at
 * @property Carbon $updated_at
 * @property bool $is_active
 * @property string|null $name
 * @property string|null $image
 * @property string|null $brand
 * @property int|null $stock
 * @property int|null $original_price
 * @property int|null $selling_price
 * @property string|null $description
 * @property int|null $status
 * @property float|null $commission
 * @property float|null $commission_percentage
 * @property int|null $alias_id
 * @property int|null $product_category_id
 * @property int|null $product_type_id
 * @property int|null $supplier_id
 *
 * @property MituProductCategory|null $mitu_product_category
 * @property MituSupplier|null $mitu_supplier
 * @property Collection|MituOrderDetail[] $mitu_order_details
 * @property Collection|MituInventoryReceiptDetail[] $mitu_inventory_receipt_details
 * @property Collection|MituInventoryIssueDetail[] $mitu_inventory_issue_details
 * @property Collection|MituProductOption[] $mitu_product_options
 * @property Collection|MituPaymentDetail[] $mitu_payment_details
 * @property Collection|MituProductTypeProduct[] $mitu_product_type_products
 * @property Collection|MituTreatmentProduct[] $mitu_treatment_products
 * @property Collection|MituShoppingCart[] $mitu_shopping_carts
 *
 * @package App\Models
 */
class MituProduct extends Model
{
	protected $table = 'mitu_products';

	protected $casts = [
        'image' => 'array',
		'is_active' => 'bool',
		'stock' => 'int',
		'original_price' => 'int',
		'selling_price' => 'int',
		'status' => 'int',
		'commission' => 'float',
		'commission_percentage' => 'float',
		'alias_id' => 'int',
		'product_category_id' => 'int',
		'product_type_id' => 'int',
		'supplier_id' => 'int'
	];

	protected $fillable = [
		'is_active',
		'name',
		'image',
		'brand',
		'stock',
		'original_price',
		'selling_price',
		'description',
		'status',
		'commission',
		'commission_percentage',
		'alias_id',
		'product_category_id',
		'product_type_id',
		'supplier_id'
	];

	public function mitu_product_category()
	{
		return $this->belongsTo(MituProductCategory::class, 'product_category_id');
	}

	public function mitu_supplier()
	{
		return $this->belongsTo(MituSupplier::class, 'supplier_id');
	}

	public function mitu_order_details()
	{
		return $this->hasMany(MituOrderDetail::class, 'product_id');
	}

	public function mitu_inventory_receipt_details()
	{
		return $this->hasMany(MituInventoryReceiptDetail::class, 'product_id');
	}

	public function mitu_inventory_issue_details()
	{
		return $this->hasMany(MituInventoryIssueDetail::class, 'product_id');
	}

	public function mitu_product_options()
	{
		return $this->hasMany(MituProductOption::class, 'product_id');
	}

	public function mitu_payment_details()
	{
		return $this->hasMany(MituPaymentDetail::class, 'product_id');
	}
    public function product_category()
    {
        return $this->belongsTo(MituProductCategory::class, 'product_category_id');
    }

	public function mitu_product_type_products()
	{
		return $this->hasMany(MituProductTypeProduct::class, 'product_id');
	}

	public function mitu_treatment_products()
	{
		return $this->hasMany(MituTreatmentProduct::class, 'product_id');
	}

	public function mitu_shopping_carts()
	{
		return $this->hasMany(MituShoppingCart::class, 'product_id');
	}
}

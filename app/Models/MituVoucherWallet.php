<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class MituVoucherWallet
 * 
 * @property int $id
 * @property Carbon $created_at
 * @property Carbon $updated_at
 * @property bool $is_active
 * @property int|null $tokenID
 * @property string|null $name
 * @property string|null $description
 * @property float|null $price
 * @property float|null $discount
 * @property string|null $image
 * @property float|null $startDate
 * @property float|null $endDate
 * @property int|null $categoryId
 * @property string|null $merchantReceiveMoney
 * @property int|null $alias_id
 * 
 * @property MituAlias|null $mitu_alias
 *
 * @package App\Models
 */
class MituVoucherWallet extends Model
{
	protected $table = 'mitu_voucher_wallet';

	protected $casts = [
		'is_active' => 'bool',
		'tokenID' => 'int',
		'price' => 'float',
		'discount' => 'float',
		'startDate' => 'float',
		'endDate' => 'float',
		'categoryId' => 'int',
		'alias_id' => 'int'
	];

	protected $fillable = [
		'is_active',
		'tokenID',
		'name',
		'description',
		'price',
		'discount',
		'image',
		'startDate',
		'endDate',
		'categoryId',
		'merchantReceiveMoney',
		'alias_id'
	];

	public function mitu_alias()
	{
		return $this->belongsTo(MituAlias::class, 'alias_id');
	}
}

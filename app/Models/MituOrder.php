<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * Class MituOrder
 *
 * @property int $id
 * @property Carbon $created_at
 * @property Carbon $updated_at
 * @property bool $is_active
 * @property float|null $provisional
 * @property float|null $VAT
 * @property float|null $cash_discount
 * @property float|null $total
 * @property float|null $paid
 * @property string|null $note
 * @property float|null $status
 * @property float|null $average_score
 * @property int|null $is_evaluate
 * @property int|null $alias_id
 * @property int|null $creator_id
 * @property int|null $table_id
 * @property int|null $room_id
 * @property Carbon|null $time_start
 * @property Carbon|null $time_end
 * @property int|null $customer_id
 * @property float|null $customer_classification_discount
 * @property string|null $invoice_note
 *
 * @property MituAccount|null $mitu_account
 * @property MituTable|null $mitu_table
 * @property MituCustomer|null $mitu_customer
 * @property Collection|MituNotification[] $mitu_notifications
 * @property Collection|MituOrderDetailPrepaidCard[] $mitu_order_detail_prepaid_cards
 * @property Collection|MituOrderDetail[] $mitu_order_details
 * @property Collection|MituOrderDetailTreatment[] $mitu_order_detail_treatments
 * @property Collection|MituPaymentMethodsDetail[] $mitu_payment_methods_details
 * @property Collection|MituPrepaidCardPayOrder[] $mitu_prepaid_card_pay_orders
 * @property Collection|MituRateService[] $mitu_rate_services
 *
 * @package App\Models
 */
class MituOrder extends Model
{
	protected $table = 'mitu_order';

	protected $casts = [
		'is_active' => 'bool',
		'provisional' => 'float',
		'VAT' => 'float',
		'cash_discount' => 'float',
		'total' => 'float',
		'paid' => 'float',
		'status' => 'float',
		'average_score' => 'float',
		'is_evaluate' => 'int',
		'alias_id' => 'int',
		'creator_id' => 'int',
		'table_id' => 'int',
		'room_id' => 'int',
		'time_start' => 'datetime',
		'time_end' => 'datetime',
		'customer_id' => 'int',
		'customer_classification_discount' => 'float'
	];

	protected $fillable = [
		'is_active',
		'provisional',
		'VAT',
		'cash_discount',
		'total',
		'paid',
		'note',
		'status',
		'average_score',
		'is_evaluate',
		'alias_id',
		'creator_id',
		'table_id',
		'room_id',
		'time_start',
		'time_end',
		'customer_id',
		'customer_classification_discount',
		'invoice_note'
	];

    // Trong model MituOrder
    public function customer()
    {
        return $this->belongsTo(MituCustomer::class, 'customer_id');
    }

    public function account()
    {
        return $this->belongsTo(MituAccount::class, 'account_id');
    }
	public function mitu_account()
    {
		return $this->belongsTo(MituAccount::class, 'creator_id');
	}

	public function mitu_table()
	{
		return $this->belongsTo(MituTable::class, 'room_id');
	}

	public function mitu_customer()
	{
		return $this->belongsTo(MituCustomer::class, 'customer_id');
	}

	public function mitu_notifications()
	{
		return $this->hasMany(MituNotification::class, 'order_id');
	}

	public function mitu_order_detail_prepaid_cards()
	{
		return $this->hasMany(MituOrderDetailPrepaidCard::class, 'order_id');
	}

	public function mitu_order_details()
	{
		return $this->hasMany(MituOrderDetail::class, 'order_id');
	}

	public function mitu_order_detail_treatments()
	{
		return $this->hasMany(MituOrderDetailTreatment::class, 'order_id');
	}

	public function mitu_payment_methods_details()
	{
		return $this->hasMany(MituPaymentMethodsDetail::class, 'order_id');
	}

	public function mitu_prepaid_card_pay_orders()
	{
		return $this->hasMany(MituPrepaidCardPayOrder::class, 'order_id');
	}

	public function mitu_rate_services()
	{
		return $this->hasMany(MituRateService::class, 'order_id');
	}
}

<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class MituCustomer
 *
 * @property int $id
 * @property Carbon $created_at
 * @property Carbon $updated_at
 * @property bool $is_active
 * @property string|null $full_name
 * @property string|null $phone_number
 * @property string|null $email
 * @property int|null $gender
 * @property string|null $address
 * @property string|null $note
 * @property int|null $alias_id
 * @property int|null $customer_source_id
 * @property int|null $customer_classification_id
 * @property Carbon|null $date_of_birth
 * @property float|null $total_spending
 * @property int|null $creator_id
 * @property Carbon|null $recent_order
 *
 * @property MituCustomerSource|null $mitu_customer_source
 * @property MituCustomerClassification|null $mitu_customer_classification
 * @property MituAccount|null $mitu_account
 * @property Collection|MituOrderDetailInformation[] $mitu_order_detail_informations
 * @property Collection|MituOrder[] $mitu_orders
 * @property Collection|MituAccountCustomer[] $mitu_account_customers
 * @property Collection|MituCustomerNote[] $mitu_customer_notes
 * @property Collection|MituSchedule[] $mitu_schedules
 *
 * @package App\Models
 */
class MituCustomer extends Model
{
	protected $table = 'mitu_customer';

	protected $casts = [
		'is_active' => 'bool',
		'gender' => 'int',
		'alias_id' => 'int',
		'customer_source_id' => 'int',
		'customer_classification_id' => 'int',
		'date_of_birth' => 'datetime',
		'total_spending' => 'float',
		'creator_id' => 'int',
		'recent_order' => 'datetime'
	];

	protected $fillable = [
		'is_active',
		'full_name',
		'phone_number',
		'email',
		'gender',
		'address',
		'note',
		'alias_id',
		'customer_source_id',
		'customer_classification_id',
		'date_of_birth',
		'total_spending',
		'creator_id',
		'recent_order'
	];

    public function customer()
    {
        return $this->belongsTo(MituCustomer::class, 'customer_id');
    }
	public function mitu_customer_source()
	{
		return $this->belongsTo(MituCustomerSource::class, 'customer_source_id');
	}

	public function mitu_customer_classification()
	{
		return $this->belongsTo(MituCustomerClassification::class, 'customer_classification_id');
	}

	public function mitu_account()
	{
		return $this->belongsTo(MituAccount::class, 'creator_id');
	}

	public function mitu_order_detail_informations()
	{
		return $this->hasMany(MituOrderDetailInformation::class, 'purchaser_id');
	}

	public function mitu_orders()
	{
		return $this->hasMany(MituOrder::class, 'customer_id');
	}

	public function mitu_account_customers()
	{
		return $this->hasMany(MituAccountCustomer::class, 'customer_id');
	}

	public function mitu_customer_notes()
	{
		return $this->hasMany(MituCustomerNote::class, 'customer_id');
	}

	public function mitu_schedules()
	{
		return $this->hasMany(MituSchedule::class, 'customer_id');
	}
}

<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class MituNotification
 * 
 * @property int $id
 * @property Carbon $created_at
 * @property Carbon $updated_at
 * @property bool $is_active
 * @property string|null $content
 * @property int|null $status
 * @property int|null $schedule_id
 * @property int|null $alias_id
 * @property int|null $type
 * @property int|null $account_id
 * @property int|null $order_id
 * @property string|null $list_customer_id
 * @property string|null $list_card_id
 * @property bool|null $is_send_to_admin
 * 
 * @property MituSchedule|null $mitu_schedule
 * @property MituAccount|null $mitu_account
 * @property MituOrder|null $mitu_order
 *
 * @package App\Models
 */
class MituNotification extends Model
{
	protected $table = 'mitu_notification';

	protected $casts = [
		'is_active' => 'bool',
		'status' => 'int',
		'schedule_id' => 'int',
		'alias_id' => 'int',
		'type' => 'int',
		'account_id' => 'int',
		'order_id' => 'int',
		'is_send_to_admin' => 'bool'
	];

	protected $fillable = [
		'is_active',
		'content',
		'status',
		'schedule_id',
		'alias_id',
		'type',
		'account_id',
		'order_id',
		'list_customer_id',
		'list_card_id',
		'is_send_to_admin'
	];

	public function mitu_schedule()
	{
		return $this->belongsTo(MituSchedule::class, 'schedule_id');
	}

	public function mitu_account()
	{
		return $this->belongsTo(MituAccount::class, 'account_id');
	}

	public function mitu_order()
	{
		return $this->belongsTo(MituOrder::class, 'order_id');
	}
}

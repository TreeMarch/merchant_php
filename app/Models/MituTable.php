<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class MituTable
 * 
 * @property int $id
 * @property Carbon $created_at
 * @property Carbon $updated_at
 * @property bool $is_active
 * @property string|null $name
 * @property string|null $floor
 * @property int|null $alias_id
 * @property int|null $order_id_exist
 * 
 * @property Collection|MituOrder[] $mitu_orders
 *
 * @package App\Models
 */
class MituTable extends Model
{
	protected $table = 'mitu_table';

	protected $casts = [
		'is_active' => 'bool',
		'alias_id' => 'int',
		'order_id_exist' => 'int'
	];

	protected $fillable = [
		'is_active',
		'name',
		'floor',
		'alias_id',
		'order_id_exist'
	];

	public function mitu_orders()
	{
		return $this->hasMany(MituOrder::class, 'room_id');
	}
}

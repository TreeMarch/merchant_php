<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class MituRoom
 * 
 * @property int $id
 * @property Carbon $created_at
 * @property Carbon $updated_at
 * @property bool $is_active
 * @property string|null $name
 * @property string|null $floor
 * @property int|null $alias_id
 * @property int|null $status
 * @property int|null $type_room_id
 * @property int|null $order_id_exist
 * 
 * @property MituTypeRoom|null $mitu_type_room
 *
 * @package App\Models
 */
class MituRoom extends Model
{
	protected $table = 'mitu_room';

	protected $casts = [
		'is_active' => 'bool',
		'alias_id' => 'int',
		'status' => 'int',
		'type_room_id' => 'int',
		'order_id_exist' => 'int'
	];

	protected $fillable = [
		'is_active',
		'name',
		'floor',
		'alias_id',
		'status',
		'type_room_id',
		'order_id_exist'
	];

	public function mitu_type_room()
	{
		return $this->belongsTo(MituTypeRoom::class, 'type_room_id');
	}
}

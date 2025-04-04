<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class MituTypeRoom
 * 
 * @property int $id
 * @property Carbon $created_at
 * @property Carbon $updated_at
 * @property bool $is_active
 * @property string|null $name
 * @property string|null $config_time
 * @property string|null $config_time_hotel
 * @property int|null $average_price
 * @property int|null $alias_id
 * 
 * @property Collection|MituRoom[] $mitu_rooms
 *
 * @package App\Models
 */
class MituTypeRoom extends Model
{
	protected $table = 'mitu_type_room';

	protected $casts = [
		'is_active' => 'bool',
		'average_price' => 'int',
		'alias_id' => 'int'
	];

	protected $fillable = [
		'is_active',
		'name',
		'config_time',
		'config_time_hotel',
		'average_price',
		'alias_id'
	];

	public function mitu_rooms()
	{
		return $this->hasMany(MituRoom::class, 'type_room_id');
	}
}

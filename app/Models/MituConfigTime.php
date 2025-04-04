<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class MituConfigTime
 * 
 * @property int $id
 * @property Carbon $created_at
 * @property Carbon $updated_at
 * @property bool $is_active
 * @property string|null $list_config
 * @property int|null $alias_id
 *
 * @package App\Models
 */
class MituConfigTime extends Model
{
	protected $table = 'mitu_config_time';

	protected $casts = [
		'is_active' => 'bool',
		'alias_id' => 'int'
	];

	protected $fillable = [
		'is_active',
		'list_config',
		'alias_id'
	];
}

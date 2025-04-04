<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class MituRolePermission
 * 
 * @property int $id
 * @property Carbon $created_at
 * @property Carbon $updated_at
 * @property bool $is_active
 * @property string|null $name
 * @property int|null $role_id
 * @property int|null $permission_id
 * 
 * @property MituRole|null $mitu_role
 * @property MituPermission|null $mitu_permission
 *
 * @package App\Models
 */
class MituRolePermission extends Model
{
	protected $table = 'mitu_role_permission';

	protected $casts = [
		'is_active' => 'bool',
		'role_id' => 'int',
		'permission_id' => 'int'
	];

	protected $fillable = [
		'is_active',
		'name',
		'role_id',
		'permission_id'
	];

	public function mitu_role()
	{
		return $this->belongsTo(MituRole::class, 'role_id');
	}

	public function mitu_permission()
	{
		return $this->belongsTo(MituPermission::class, 'permission_id');
	}
}

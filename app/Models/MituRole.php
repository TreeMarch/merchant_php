<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class MituRole
 * 
 * @property int $id
 * @property Carbon $created_at
 * @property Carbon $updated_at
 * @property bool $is_active
 * @property string|null $mitu_code
 * @property string|null $name
 * @property int|null $status
 * @property string|null $note
 * @property int|null $alias_id
 * 
 * @property Collection|MituAccount[] $mitu_accounts
 * @property Collection|MituRolePermission[] $mitu_role_permissions
 *
 * @package App\Models
 */
class MituRole extends Model
{
	protected $table = 'mitu_role';

	protected $casts = [
		'is_active' => 'bool',
		'status' => 'int',
		'alias_id' => 'int'
	];

	protected $fillable = [
		'is_active',
		'mitu_code',
		'name',
		'status',
		'note',
		'alias_id'
	];

	public function mitu_accounts()
	{
		return $this->hasMany(MituAccount::class, 'role_id');
	}

	public function mitu_role_permissions()
	{
		return $this->hasMany(MituRolePermission::class, 'role_id');
	}
}

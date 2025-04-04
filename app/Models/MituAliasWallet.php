<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class MituAliasWallet
 * 
 * @property int $id
 * @property Carbon $created_at
 * @property Carbon $updated_at
 * @property bool $is_active
 * @property string|null $user_name
 * @property string|null $email
 * @property string|null $phone_number
 * @property string|null $password
 * @property int|null $alias_id
 * @property string|null $jwt
 * 
 * @property MituAlias|null $mitu_alias
 *
 * @package App\Models
 */
class MituAliasWallet extends Model
{
	protected $table = 'mitu_alias_wallet';

	protected $casts = [
		'is_active' => 'bool',
		'alias_id' => 'int'
	];

	protected $hidden = [
		'password'
	];

	protected $fillable = [
		'is_active',
		'user_name',
		'email',
		'phone_number',
		'password',
		'alias_id',
		'jwt'
	];

	public function mitu_alias()
	{
		return $this->belongsTo(MituAlias::class, 'alias_id');
	}
}

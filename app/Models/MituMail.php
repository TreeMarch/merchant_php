<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class MituMail
 * 
 * @property int $id
 * @property Carbon $created_at
 * @property Carbon $updated_at
 * @property bool $is_active
 * @property string|null $email_customer
 * @property string|null $facility
 * @property string|null $company_name
 * @property string|null $address
 * @property string|null $company_phone_number
 * @property string|null $contract_package
 * @property string|null $start_date
 * @property string|null $end_date
 * @property string|null $link_login
 * @property string|null $username
 * @property string|null $password
 * @property string|null $domain
 * @property string|null $hotline
 * @property string|null $html
 * @property int|null $type
 * @property string|null $type_name
 *
 * @package App\Models
 */
class MituMail extends Model
{
	protected $table = 'mitu_mail';

	protected $casts = [
		'is_active' => 'bool',
		'type' => 'int'
	];

	protected $hidden = [
		'password'
	];

	protected $fillable = [
		'is_active',
		'email_customer',
		'facility',
		'company_name',
		'address',
		'company_phone_number',
		'contract_package',
		'start_date',
		'end_date',
		'link_login',
		'username',
		'password',
		'domain',
		'hotline',
		'html',
		'type',
		'type_name'
	];
}

<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class MituCompanyInformation
 * 
 * @property int $id
 * @property Carbon $created_at
 * @property Carbon $updated_at
 * @property bool $is_active
 * @property string|null $company_avt
 * @property string|null $company_name
 * @property string|null $phone_number
 * @property string|null $email
 * @property string|null $address
 * @property string|null $city
 * @property string|null $district
 * @property string|null $ward
 * @property string|null $website
 * @property string|null $facebook
 * @property string|null $zalo
 * @property string|null $short_description
 * @property string|null $business_introduction
 * @property string|null $opening_and_closing_hour
 * @property int|null $payment_successful
 * @property int|null $payment_successful_template_id
 * @property int|null $booking_successful
 * @property int|null $booking_successful_template_id
 * @property int|null $appointment_rescheduled
 * @property int|null $appointment_rescheduled_template_id
 * @property string|null $access_token
 * @property string|null $refresh_token
 * @property string|null $secret_key
 * @property string|null $app_id
 * @property int|null $alias_id
 * @property int|null $total_branch
 * @property int|null $total_staff
 * 
 * @property MituAlias|null $mitu_alias
 * @property Collection|MituCompanyInformationOption[] $mitu_company_information_options
 *
 * @package App\Models
 */
class MituCompanyInformation extends Model
{
	protected $table = 'mitu_company_information';

	protected $casts = [
		'is_active' => 'bool',
		'payment_successful' => 'int',
		'payment_successful_template_id' => 'int',
		'booking_successful' => 'int',
		'booking_successful_template_id' => 'int',
		'appointment_rescheduled' => 'int',
		'appointment_rescheduled_template_id' => 'int',
		'alias_id' => 'int',
		'total_branch' => 'int',
		'total_staff' => 'int'
	];

	protected $hidden = [
		'access_token',
		'refresh_token',
		'secret_key'
	];

	protected $fillable = [
		'is_active',
		'company_avt',
		'company_name',
		'phone_number',
		'email',
		'address',
		'city',
		'district',
		'ward',
		'website',
		'facebook',
		'zalo',
		'short_description',
		'business_introduction',
		'opening_and_closing_hour',
		'payment_successful',
		'payment_successful_template_id',
		'booking_successful',
		'booking_successful_template_id',
		'appointment_rescheduled',
		'appointment_rescheduled_template_id',
		'access_token',
		'refresh_token',
		'secret_key',
		'app_id',
		'alias_id',
		'total_branch',
		'total_staff'
	];

	public function mitu_alias()
	{
		return $this->belongsTo(MituAlias::class, 'alias_id');
	}

	public function mitu_company_information_options()
	{
		return $this->hasMany(MituCompanyInformationOption::class, 'company_information_id');
	}
}

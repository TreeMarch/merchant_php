<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class MituAlias
 * 
 * @property int $id
 * @property Carbon $created_at
 * @property Carbon $updated_at
 * @property bool $is_active
 * @property string|null $name
 * @property string|null $phone_number
 * @property string|null $address
 * @property int|null $business_industry_id
 * @property int|null $check_send_mail
 * 
 * @property MituBusinessIndustry|null $mitu_business_industry
 * @property Collection|MituAccount[] $mitu_accounts
 * @property Collection|MituCompanyInformation[] $mitu_company_informations
 * @property Collection|MituAliasWallet[] $mitu_alias_wallets
 * @property Collection|MituPackageDetail[] $mitu_package_details
 * @property Collection|MituSystemFeedback[] $mitu_system_feedbacks
 * @property Collection|MituVoucherWallet[] $mitu_voucher_wallets
 *
 * @package App\Models
 */
class MituAlias extends Model
{
	protected $table = 'mitu_alias';

	protected $casts = [
		'is_active' => 'bool',
		'business_industry_id' => 'int',
		'check_send_mail' => 'int'
	];

	protected $fillable = [
		'is_active',
		'name',
		'phone_number',
		'address',
		'business_industry_id',
		'check_send_mail'
	];

	public function mitu_business_industry()
	{
		return $this->belongsTo(MituBusinessIndustry::class, 'business_industry_id');
	}

	public function mitu_accounts()
	{
		return $this->hasMany(MituAccount::class, 'alias_id');
	}

	public function mitu_company_informations()
	{
		return $this->hasMany(MituCompanyInformation::class, 'alias_id');
	}

	public function mitu_alias_wallets()
	{
		return $this->hasMany(MituAliasWallet::class, 'alias_id');
	}

	public function mitu_package_details()
	{
		return $this->hasMany(MituPackageDetail::class, 'alias_id');
	}

	public function mitu_system_feedbacks()
	{
		return $this->hasMany(MituSystemFeedback::class, 'alias_id');
	}

	public function mitu_voucher_wallets()
	{
		return $this->hasMany(MituVoucherWallet::class, 'alias_id');
	}
}

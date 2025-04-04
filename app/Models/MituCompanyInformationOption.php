<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class MituCompanyInformationOption
 * 
 * @property int $id
 * @property Carbon $created_at
 * @property Carbon $updated_at
 * @property bool $is_active
 * @property string|null $name
 * @property string|null $value
 * @property int|null $company_information_id
 * 
 * @property MituCompanyInformation|null $mitu_company_information
 *
 * @package App\Models
 */
class MituCompanyInformationOption extends Model
{
	protected $table = 'mitu_company_information_option';

	protected $casts = [
		'is_active' => 'bool',
		'company_information_id' => 'int'
	];

	protected $fillable = [
		'is_active',
		'name',
		'value',
		'company_information_id'
	];

	public function mitu_company_information()
	{
		return $this->belongsTo(MituCompanyInformation::class, 'company_information_id');
	}
}

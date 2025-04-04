<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class MituGeneralSetting
 * 
 * @property int $id
 * @property Carbon $created_at
 * @property Carbon $updated_at
 * @property bool $is_active
 * @property int|null $bill_size
 * @property int|null $bill_content
 * @property int|null $display_employee_name_on_invoice
 * @property int|null $content_display_end_invoice
 * @property int|null $display_qrcode_evalute_appointment
 * @property string|null $content_end_invoice
 * @property string|null $logo_store
 * @property int|null $alias_id
 *
 * @package App\Models
 */
class MituGeneralSetting extends Model
{
	protected $table = 'mitu_general_setting';

	protected $casts = [
		'is_active' => 'bool',
		'bill_size' => 'int',
		'bill_content' => 'int',
		'display_employee_name_on_invoice' => 'int',
		'content_display_end_invoice' => 'int',
		'display_qrcode_evalute_appointment' => 'int',
		'alias_id' => 'int'
	];

	protected $fillable = [
		'is_active',
		'bill_size',
		'bill_content',
		'display_employee_name_on_invoice',
		'content_display_end_invoice',
		'display_qrcode_evalute_appointment',
		'content_end_invoice',
		'logo_store',
		'alias_id'
	];
}

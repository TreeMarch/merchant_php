<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class MituServiceCatalog
 * 
 * @property int $id
 * @property Carbon $created_at
 * @property Carbon $updated_at
 * @property bool $is_active
 * @property string|null $name
 * @property int|null $alias_id
 * 
 * @property Collection|MituService[] $mitu_services
 *
 * @package App\Models
 */
class MituServiceCatalog extends Model
{
	protected $table = 'mitu_service_catalog';

	protected $casts = [
		'is_active' => 'bool',
		'alias_id' => 'int'
	];

	protected $fillable = [
		'is_active',
		'name',
		'alias_id'
	];

	public function mitu_services()
	{
		return $this->hasMany(MituService::class, 'service_catalog_id');
	}
}

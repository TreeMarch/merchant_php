<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class MituPermission
 *
 * @property int $id
 * @property Carbon $created_at
 * @property Carbon $updated_at
 * @property bool $is_active
 * @property string|null $name
 * @property string|null $description
 * @property string|null $http_method
 * @property string|null $pattern
 * @property string|null $permission_name
 * @property string|null $is_required_access_token
 * @property string|null $should_check_permission
 * @property int|null $alias_id
 *
 * @property Collection|MituRolePermission[] $mitu_role_permissions
 *
 * @package App\Models
 */
class MituPermission extends Model
{
    // Đặt tên bảng của model
    protected $table = 'mitu_permission';

    // Các kiểu dữ liệu của thuộc tính
    protected $casts = [
        'is_active' => 'bool',
        'alias_id' => 'int'
    ];

    // Các thuộc tính ẩn
    protected $hidden = [
        'is_required_access_token'
    ];

    // Các thuộc tính có thể gán
    protected $fillable = [
        'is_active',
        'name',
        'description',
        'http_method',
        'pattern',
        'permission_name',
        'is_required_access_token',
        'should_check_permission',
        'alias_id'
    ];

    // Mối quan hệ với bảng MituRolePermission
    public function mitu_role_permissions()
    {
        return $this->hasMany(MituRolePermission::class, 'permission_id');
    }

    /**
     * Tìm Permission theo tên.
     *
     * @param string $name
     * @return MituPermission|null
     */
    public static function findByName($name)
    {
        // Trả về Permission có tên khớp với $name
        return self::where('name', $name)->first();
    }
}

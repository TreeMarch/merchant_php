<?php

namespace App\Models;

use Filament\Models\Contracts\FilamentUser;
use Filament\Models\Contracts\HasTenants;
use Filament\Panel;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Collection;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;
use Filament\Models\Contracts\HasName;

class MituAccount extends Authenticatable implements FilamentUser, HasTenants, HasName
{
    public function getFilamentName(): string
    {
        return $this->full_name ?? 'Guest';
    }
    use HasApiTokens;
    use HasFactory;
    use Notifiable;
    use HasRoles;

    protected $table = 'mitu_account';

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'date_of_birth' => 'datetime',
        'is_active' => 'bool',
        'average_star' => 'float',
        'shift_wage' => 'float',
        'hourly_wage' => 'float',
        'is_book_online' => 'int',
        'role_id' => 'int',
        'alias_id' => 'int',
        'is_first_login' => 'int',
        'is_guide' => 'int',
        'is_book' => 'int',
    ];

    protected $fillable = [
        'is_active',
        'mitu_code',
        'image',
        'username',
        'password',
        'full_name',
        'address',
        'date_of_birth',
        'email',
        'phone_number',
        'cccd',
        'shift_wage',
        'hourly_wage',
        'note',
        'is_book_online',
        'position',
        'type',
        'referral_code',
        'referred_code',
        'status',
        'note_detail',
        'description',
        'average_star',
        'role_id',
        'alias_id',
        'is_first_login',
        'is_guide',
        'is_book',
    ];

    /**
     * Lấy tên người dùng cho Filament
     */
    public function getUserName(): string
    {
        // Sử dụng thuộc tính đã có trong model của bạn
        return $this->full_name ?? 'Guest';
    }




    /**
     * Xác thực người dùng
     */
    public function getAuthIdentifier()
    {
        return $this->getKey(); // Trả về khóa chính của bảng (thường là `id`)
    }

    public function getAuthIdentifierName()
    {
        return 'id'; // Tên của trường khóa chính
    }

    public function getAuthPassword()
    {
        return $this->password; // Trả về mật khẩu
    }

    public function getRememberToken()
    {
        return $this->remember_token; // Trả về token nhớ phiên
    }

    public function setRememberToken($value)
    {
        $this->remember_token = $value; // Cập nhật token nhớ phiên
    }

    public function getRememberTokenName()
    {
        return 'remember_token'; // Tên trường lưu token nhớ phiên
    }

    /**
     * Quyền hạn truy cập trên Filament Panel
     */
    public function canAccessPanel(Panel $panel): bool
    {
        return true; // Bạn có thể thay đổi logic này tùy nhu cầu của bạn
    }

    /**
     * Quyền truy cập cho tenant.
     */
    public function canAccessTenant(Model $tenant): bool
    {
        return true; // Bạn có thể thay đổi logic này tùy nhu cầu của bạn
    }

    /**
     * Lấy tất cả tenants liên quan đến người dùng (có thể thay đổi tùy vào logic).
     */
    public function getTenants(Panel $panel): Collection
    {
        return Team::all(); // Hoặc thay thế bằng tên mô hình của bạn
    }

    /**
     * Các quan hệ trong model
     */
    public function mitu_role()
    {
        return $this->belongsTo(MituRole::class, 'role_id');
    }

    public function mitu_alias()
    {
        return $this->belongsTo(MituAlias::class, 'alias_id');
    }

    public function mitu_notifications()
    {
        return $this->hasMany(MituNotification::class, 'account_id');
    }

    public function mitu_orders()
    {
        return $this->hasMany(MituOrder::class, 'creator_id');
    }

    public function mitu_order_detail_prepaid_cards()
    {
        return $this->hasMany(MituOrderDetailPrepaidCard::class, 'creator_id');
    }

    public function mitu_login_histories()
    {
        return $this->hasMany(MituLoginHistory::class, 'account_id');
    }

    public function mitu_order_drafts()
    {
        return $this->hasMany(MituOrderDraft::class, 'creator_id');
    }

    public function mitu_order_detail_treatments()
    {
        return $this->hasMany(MituOrderDetailTreatment::class, 'creator_id');
    }

    public function mitu_account_customers()
    {
        return $this->hasMany(MituAccountCustomer::class, 'account_id');
    }

    public function mitu_account_orders()
    {
        return $this->hasMany(MituAccountOrder::class, 'account_id');
    }

    public function mitu_customer_notes()
    {
        return $this->hasMany(MituCustomerNote::class, 'account_id');
    }

    public function mitu_customers()
    {
        return $this->hasMany(MituCustomer::class, 'creator_id');
    }

    public function mitu_inventory_issues()
    {
        return $this->hasMany(MituInventoryIssue::class, 'creator_id');
    }

    public function mitu_inventory_receipts()
    {
        return $this->hasMany(MituInventoryReceipt::class, 'creator_id');
    }

    public function mitu_schedules()
    {
        return $this->hasMany(MituSchedule::class, 'staff_id');
    }

    public function mitu_schedule_edit_histories()
    {
        return $this->hasMany(MituScheduleEditHistory::class, 'creator_id');
    }

    public function mitu_token_infos()
    {
        return $this->hasMany(MituTokenInfo::class, 'account_id');
    }

    public function mitu_staff_salaries()
    {
        return $this->hasMany(MituStaffSalary::class, 'staff_id');
    }

    public function mitu_system_feedbacks()
    {
        return $this->hasMany(MituSystemFeedback::class, 'account_id');
    }

    public function mitu_work_schedules()
    {
        return $this->hasMany(MituWorkSchedule::class, 'account_id');
    }
}


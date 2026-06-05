<?php

namespace App\Models;

use Stancl\Tenancy\Database\Models\Tenant as BaseTenant;
use Stancl\Tenancy\Contracts\TenantWithDatabase;
use Stancl\Tenancy\Database\Concerns\HasDatabase;
use Stancl\Tenancy\Database\Concerns\HasDomains;

class Tenant extends BaseTenant implements TenantWithDatabase
{
    use HasDatabase, HasDomains;

    public static function getCustomColumns(): array
    {
        return [
            'id',
            'blog_name',
            'bio',
            'avatar',
            'bg_color',
            'text_color',
            'accent_color',
            'font',
            'is_active',
        ];
    }

    public function users()
    {
        return $this->belongsToMany(User::class, 'tenant_users');
    }
}
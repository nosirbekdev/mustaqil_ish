<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class User extends Authenticatable
{
    use HasFactory, Notifiable, HasRoles; // Rol va huquqlarni boshqarish uchun trait qo'shildi

    /**
     * Foydalanuvchi uchun mass assignable (massa tayinlanadigan) atributlar.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * Foydalanuvchi uchun maxfiy atributlar.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Foydalanuvchi uchun turli atributlarni avtomatik ravishda qamrab olish (casting).
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    /**
     * Polimorfik aloqada foydalanuvchi bir nechta maqolaga ega bo'lishi mumkin.
     * Bu metod orqali foydalanuvchi maqolalari bilan aloqani o'rnatamiz.
     */
    public function articles()
    {
        return $this->morphMany(Article::class, 'author'); // Polimorfik aloqani o'rnatamiz
    }

    public function role(): BelongsTo
    {
        return $this->belongsTo(Role::class);
    }
}

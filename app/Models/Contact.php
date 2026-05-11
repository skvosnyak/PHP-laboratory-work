<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
    protected $fillable = [
        'last_name',
        'first_name',
        'middle_name',
        'gender',
        'birth_date',
        'phone',
        'address',
        'email',
        'comment',
    ];

    protected $casts = [
        'birth_date' => 'date',
    ];

    /**
     * Полное ФИО
     */
    public function getFullNameAttribute(): string
    {
        return trim("{$this->last_name} {$this->first_name} {$this->middle_name}");
    }

    /**
     * Фамилия + инициалы (для списка удаления)
     */
    public function getShortNameAttribute(): string
    {
        $initials = mb_substr($this->first_name, 0, 1) . '.';
        if ($this->middle_name) {
            $initials .= mb_substr($this->middle_name, 0, 1) . '.';
        }
        return "{$this->last_name} {$initials}";
    }
}

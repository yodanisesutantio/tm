<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;

class M5D3140 extends Model
{
    use SoftDeletes;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'M5D3140';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'uuid',
        'code',
        'name',
        'address',
        'province',
        'city',
        'district',
        'subdistrict',
        'postal_code',
    ];

    /**
     * Automatically generate UUID when creating a new record.
     */
    protected static function boot(): void
    {
        parent::boot();

        static::creating(function ($model) {
            if (empty($model->uuid)) {
                $model->uuid = (string) Str::uuid();
            }
        });
    }

    public static function validate(array $data, ?string $uuid = null): array
    {
        return Validator::make($data, [
            'code' => [
                'nullable',
                'string',
                'max:64',
                Rule::unique('M5D3140', 'code')->ignore($uuid, 'uuid')->whereNull('deleted_at'),
            ],
            'name'        => 'nullable|string|max:255',
            'address'     => 'nullable|string|max:255',
            'province'    => 'nullable|string|max:255',
            'city'        => 'nullable|string|max:255',
            'district'    => 'nullable|string|max:255',
            'subdistrict' => 'nullable|string|max:255',
            'postal_code' => 'nullable|string|max:255',
        ], [
            'code.unique' => 'Kode sudah digunakan.',
            'code.max'    => 'Kode maksimal 64 karakter.',
            'name.max'    => 'Nama maksimal 255 karakter.',
        ])->validate();
    }
}

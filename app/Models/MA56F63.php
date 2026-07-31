<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;

class MA56F63 extends Model
{
    use SoftDeletes;

    protected $table = 'MA56F63';

    protected $fillable = [
        'uuid',
        'no_inv',
        'inv_date',
        'cust_uuid',
        'cust_code',
        'cust_name',
        'cust_address',
        'total',
    ];

    protected static function boot(): void
    {
        parent::boot();

        static::creating(function ($model) {
            if (empty($model->uuid)) {
                $model->uuid = (string) Str::uuid();
            }
        });
    }

    protected function casts(): array
    {
        return [
            'total' => 'decimal:2',
        ];
    }

    public function items(): HasMany
    {
        return $this->hasMany(MA56F64::class, 'detail_uuid', 'uuid');
    }

    public static function validate(array $data, ?string $uuid = null): array
    {
        return Validator::make($data, [
            'no_inv' => [
                'required',
                'string',
                'max:64',
                Rule::unique('MA56F63', 'no_inv')->ignore($uuid, 'uuid'),
            ],
            'inv_date'     => 'required|date',
            'cust_uuid'    => 'nullable|string|max:36',
            'cust_code'    => 'required|string|max:64',
            'cust_name'    => 'required|string|max:255',
            'cust_address' => 'nullable|string|max:500',
            'total'        => ['nullable', 'numeric', 'min:0', 'regex:/^\d+(\.\d{1,2})?$/'],
        ], [
            'no_inv.required'   => 'Nomor invoice wajib diisi.',
            'no_inv.unique'     => 'Nomor invoice sudah digunakan.',
            'inv_date.required' => 'Tanggal invoice wajib diisi.',
            'cust_code.required'=> 'Kode customer wajib diisi.',
            'cust_name.required'=> 'Nama customer wajib diisi.',
            'total.regex'       => 'Total maksimal memiliki 2 angka di belakang koma.',
        ])->validate();
    }
}

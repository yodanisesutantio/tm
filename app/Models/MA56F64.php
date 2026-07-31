<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class MA56F64 extends Model
{
    use SoftDeletes;

    protected $table = 'MA56F64';

    protected $fillable = [
        'uuid',
        'detail_uuid',
        'detail_no_inv',
        'product_uuid',
        'product_code',
        'product_name',
        'qty',
        'price',
        'discounts_json',
        'net_price',
        'subtotal',
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
            'qty'            => 'integer',
            'price'          => 'decimal:2',
            'discounts_json' => 'array',
            'net_price'      => 'decimal:2',
            'subtotal'       => 'decimal:2',
        ];
    }

    public function header(): BelongsTo
    {
        return $this->belongsTo(MA56F63::class, 'detail_uuid', 'uuid');
    }

    public static function validate(array $data): array
    {
        return Validator::make($data, [
            'product_code' => 'required|string|max:64',
            'product_name' => 'required|string|max:255',
            'qty'          => 'required|integer|min:1',
            'price'        => ['required', 'numeric', 'min:0'],
            'net_price'    => ['required', 'numeric', 'min:0'],
            'subtotal'     => ['required', 'numeric', 'min:0'],
        ], [
            'product_code.required' => 'Kode produk wajib diisi.',
            'product_name.required' => 'Nama produk wajib diisi.',
            'qty.required'          => 'Jumlah produk wajib diisi.',
            'qty.min'               => 'Jumlah produk minimal 1.',
        ])->validate();
    }
}

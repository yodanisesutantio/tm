<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;

class M90CAF9 extends Model
{
    use SoftDeletes;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'M90CAF9';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'uuid',
        'category',
        'code',
        'name',
        'price',
        'stock',
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

    /**
     * Type casts for attributes.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'price' => 'decimal:2',
            'stock' => 'decimal:2',
        ];
    }

    public static function validate(array $data, ?string $uuid = null): array
    {
        return Validator::make($data, [
            'category' => 'required|string|max:255',
            'code'     => [
                'required',
                'string',
                'max:64',
                Rule::unique('M90CAF9', 'code')->ignore($uuid, 'uuid'),
            ],
            'name'     => 'required|string|max:255',
            'price'    => ['nullable', 'numeric', 'min:0', 'regex:/^\d+(\.\d{1,2})?$/'],
            'stock'    => ['nullable', 'numeric', 'min:0', 'regex:/^\d+(\.\d{1,2})?$/'],
        ], [
            'code.unique'       => 'Kode produk sudah digunakan.',
            'code.required'     => 'Kode produk wajib diisi.',
            'name.required'     => 'Nama produk wajib diisi.',
            'category.required' => 'Kategori produk wajib diisi.',
            'price.regex'       => 'Harga maksimal memiliki 2 angka di belakang koma.',
            'stock.regex'       => 'Stok maksimal memiliki 2 angka di belakang koma.',
        ])->validate();
    }
}

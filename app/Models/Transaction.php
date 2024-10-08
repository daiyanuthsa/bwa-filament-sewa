<?php

namespace App\Models;

use App\Casts\MoneyCast;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class Transaction extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'name',
        'trx_id',
        'phone_number',
        'proof',
        'address',
        'start_date',
        'duration',
        'ended_date',
        'is_paid',
        'delivery_type',
        'total_amount',
        'product_id',
        'store_id',
    ];

    protected $casts = [
        'total_amount'=> MoneyCast::class,
        'start_date'=> 'date',
        'ended_date' => 'date',
    ];

    public static function generateUniqueTrxId(){
        $prefix = 'SEWA';
        $datePart = now()->format('dmY-His');
        do{$randomNumber = rand(1000, 9999);
        } while(self::where('trx_id', "{$prefix}-{$datePart}-{$randomNumber}")->exists());
        

        return "{$prefix}-{$datePart}-{$randomNumber}";
    }

    /**
     * Get the product associated with the transaction.
     */
    public function product() : BelongsTo
    {
        return $this->belongsTo(Product::class);
    }

    /**
     * Get the store associated with the transaction.
     */
    public function store() : BelongsTo
    {
        return $this->belongsTo(Store::class);
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class UrunlerModel extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $guarded = [];
    protected $primaryKey = "urn_id";
    protected $table = "urunler";
    public const CREATED_AT = "urn_created_at";
    public const UPDATED_AT = "urn_updated_at";
}

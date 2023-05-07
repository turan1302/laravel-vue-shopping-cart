<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class SepetModel extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $guarded = [];
    protected $primaryKey = "spt_id";
    protected $table = "sepet";

    public const CREATED_AT = "spt_created_at";
    public const UPDATED_AT = "spt_updated_at";

}

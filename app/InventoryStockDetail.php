<?php
namespace App;

use Illuminate\Database\Eloquent\Model;

class InventoryStockDetail extends Model
{

    public $fillable = ['stockId','productId','qty','price','locationId'];

}
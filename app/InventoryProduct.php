<?php
namespace App;

use Illuminate\Database\Eloquent\Model;

class InventoryProduct extends Model
{

    public $fillable = ['code','name','type','productCategoryId','productUnitId','costOfGoodSalesMethod','costOfGoodSales','sellingMethod','sellingManualPrice','sellingAutoPercentage'];

}
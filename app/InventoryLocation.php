<?php 
namespace App;

use Illuminate\Database\Eloquent\Model;

class InventoryLocation extends Model
{

    public $fillable = ['title','address','status'];

}
<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    const CATEGORIES = [
        'AC' => 'Accesorios'
       ,'CL' => 'Ropa'
       ,'TS' => 'Juguetes'
   ];
}

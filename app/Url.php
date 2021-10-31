<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Url extends Model
{
    protected $table = "urls";

    protected $fillable = ['name','description'];


    protected $validationAttributes = [
      'name' => 'Url'
  ];

}

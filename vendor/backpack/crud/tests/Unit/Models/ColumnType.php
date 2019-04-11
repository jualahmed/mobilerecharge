<?php

namespace Backpack\CRUD\Tests\Unit\Models;

use Backpack\CRUD\CrudTrait;
use Illuminate\Database\Eloquent\Model;

class ColumnType extends Model
{
    use CrudTrait;

    protected $table = 'column_types';
}

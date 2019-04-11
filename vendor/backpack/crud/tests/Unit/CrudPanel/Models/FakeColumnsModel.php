<?php

namespace Unit\CrudPanel\Models;

use Backpack\CRUD\CrudTrait;
use Illuminate\Database\Eloquent\Model;
use Backpack\CRUD\ModelTraits\SpatieTranslatable\Sluggable;
use Backpack\CRUD\ModelTraits\SpatieTranslatable\HasTranslations;
use Backpack\CRUD\ModelTraits\SpatieTranslatable\SluggableScopeHelpers;

class FakeColumnsModel extends Model
{
    use CrudTrait;
    use HasTranslations;

    // TODO: also use sluggable and translated slugs to unit test
//    use Sluggable;
//    use SluggableScopeHelpers;

    protected $fillable = [
        'extras',
        'extras_translatable',
        'fake_object',
        'fake_object_translatable',
        'fake_array',
        'fake_array_translatable',
        'fake_assoc_array',
        'fake_assoc_array_translatable',
    ];

    protected $translatable = [
        'extras_translatable',
        'fake_object_translatable',
        'fake_array_translatable',
        'fake_assoc_array_translatable',
    ];

    protected $fakeColumns = [
        'extras',
        'extras_translatable',
        'fake_object',
        'fake_object_translatable',
        'fake_array',
        'fake_array_translatable',
        'fake_assoc_array',
        'fake_assoc_array_translatable',
    ];

    protected $casts = [
        'fake_object' => 'object',
        'fake_object_translatable' => 'object',
        'fake_array' => 'array',
        'fake_array_translatable' => 'array',
        'fake_assoc_array' => 'array',
        'fake_assoc_array_translatable' => 'array',
    ];
}

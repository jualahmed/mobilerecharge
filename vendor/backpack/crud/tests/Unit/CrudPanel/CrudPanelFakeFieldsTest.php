<?php

namespace Backpack\CRUD\Tests\Unit\CrudPanel;

use Illuminate\Support\Facades\DB;
use Backpack\CRUD\Tests\Unit\Models\Article;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class CrudPanelFakeFieldsTest extends BaseDBCrudPanelTest
{
    private $fakeFieldsArray = [
        [
            'name' => 'field',
            'label' => 'Normal Field',
        ],
        [
            'name' => 'meta_title',
            'label' => 'Meta Title',
            'fake' => true,
            'store_in' => 'metas',
        ],
        [
            'name' => 'meta_description',
            'label' => 'Meta Description',
            'fake' => true,
            'store_in' => 'metas',
        ],
        [
            'name' => 'meta_keywords',
            'label' => 'Meta Keywords',
            'fake' => true,
            'store_in' => 'metas',
        ],
        [
            'name' => 'tags',
            'label' => 'Tags',
            'fake' => true,
            'store_in' => 'tags',
        ],
        [
            'name' => 'extra_details',
            'label' => 'Extra Details',
            'fake' => true,
        ],
        [
            'name' => 'cast_meta_title',
            'label' => 'Meta Title',
            'fake' => true,
            'store_in' => 'cast_metas',
        ],
        [
            'name' => 'cast_meta_description',
            'label' => 'Meta Description',
            'fake' => true,
            'store_in' => 'cast_metas',
        ],
        [
            'name' => 'cast_meta_keywords',
            'label' => 'Meta Keywords',
            'fake' => true,
            'store_in' => 'cast_metas',
        ],
        [
            'name' => 'cast_tags',
            'label' => 'Tags',
            'fake' => true,
            'store_in' => 'cast_tags',
        ],
        [
            'name' => 'cast_extra_details',
            'label' => 'Extra Details',
            'fake' => true,
            'store_in' => 'cast_extras',
        ],
    ];

    private $noFakeFieldsInputData = [
        'value1' => 'Value 1',
        'value2' => 'Value 2',
        'value3' => 'Value 3',
    ];

    private $fakeFieldsInputData = [
        'value1' => 'Value 1',
        'value2' => 'Value 2',
        'value3' => 'Value 3',
        'meta_title' => 'Meta Title Value',
        'meta_description' => 'Meta Description Value',
        'tags' => ['tag1', 'tag2', 'tag3'],
        'extra_details' => ['detail1', 'detail2', 'detail3'],
        'cast_meta_title' => 'Meta Title Value',
        'cast_meta_description' => 'Meta Description Value',
        'cast_tags' => ['tag1', 'tag2', 'tag3'],
        'cast_extra_details' => ['detail1', 'detail2', 'detail3'],
    ];

    private $expectedInputDataWithCompactedFakeFields = [
        'value1' => 'Value 1',
        'value2' => 'Value 2',
        'value3' => 'Value 3',
        'metas' => '{"meta_title":"Meta Title Value","meta_description":"Meta Description Value"}',
        'tags' => '{"tags":["tag1","tag2","tag3"]}',
        'extras' => '{"extra_details":["detail1","detail2","detail3"]}',
        'cast_metas'  => [
            'cast_meta_title'       => 'Meta Title Value',
            'cast_meta_description' => 'Meta Description Value',
        ],
        'cast_tags'   => [
            'cast_tags' => ['tag1', 'tag2', 'tag3'],
        ],
        'cast_extras' => [
            'cast_extra_details' => ['detail1', 'detail2', 'detail3'],
        ],
    ];

    public function testCompactFakeFieldsFromCreateForm()
    {
        $this->crudPanel->addFields($this->fakeFieldsArray);
        $this->crudPanel->setModel(Article::class);

        $compactedFakeFields = $this->crudPanel->compactFakeFields($this->fakeFieldsInputData, 'create');

        $this->assertEquals($this->expectedInputDataWithCompactedFakeFields, $compactedFakeFields);
    }

    public function testCompactFakeFieldsFromUpdateForm()
    {
        $article = DB::table('articles')->where('id', 1)->first();
        $this->crudPanel->setModel(Article::class);
        $this->crudPanel->addFields($this->fakeFieldsArray, 'update');

        $compactedFakeFields = $this->crudPanel->compactFakeFields($this->fakeFieldsInputData, 'update', $article->id);

        $this->assertEquals($this->expectedInputDataWithCompactedFakeFields, $compactedFakeFields);
    }

    public function testCompactFakeFieldsFromUpdateFormWithoutId()
    {
        $this->expectException(ModelNotFoundException::class);

        $this->crudPanel->setModel(Article::class);
        $this->crudPanel->addFields($this->fakeFieldsArray, 'update');

        $compactedFakeFields = $this->crudPanel->compactFakeFields($this->fakeFieldsInputData, 'update');

        $this->assertEquals($this->expectedInputDataWithCompactedFakeFields, $compactedFakeFields);
    }

    public function testCompactFakeFieldsFromUpdateFormWithUnknownId()
    {
        $this->expectException(ModelNotFoundException::class);

        $unknownId = DB::getPdo()->lastInsertId() + 1;
        $this->crudPanel->setModel(Article::class);
        $this->crudPanel->addFields($this->fakeFieldsArray, 'update');

        $compactedFakeFields = $this->crudPanel->compactFakeFields($this->fakeFieldsInputData, 'update', $unknownId);

        $this->assertEquals($this->expectedInputDataWithCompactedFakeFields, $compactedFakeFields);
    }

    public function testCompactFakeFieldsFromEmptyRequest()
    {
        $compactedFakeFields = $this->crudPanel->compactFakeFields([]);

        $this->assertEmpty($compactedFakeFields);
    }

    public function testCompactFakeFieldsFromRequestWithNoFakes()
    {
        $compactedFakeFields = $this->crudPanel->compactFakeFields($this->noFakeFieldsInputData);

        $this->assertEquals($this->noFakeFieldsInputData, $compactedFakeFields);
    }

    public function testCompactFakeFieldsFromUnknownForm()
    {
        $this->markTestIncomplete('Not correctly implemented');

        $this->expectException(\InvalidArgumentException::class);

        // TODO: this should throw an invalid argument exception but doesn't because of the getFields method in the
        //       read trait, which returns the create fields in case of an unknown form type.
        $this->crudPanel->compactFakeFields($this->fakeFieldsInputData, 'unknownForm');
    }
}

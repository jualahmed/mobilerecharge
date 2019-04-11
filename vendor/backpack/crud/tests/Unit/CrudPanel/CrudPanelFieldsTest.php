<?php

namespace Backpack\CRUD\Tests\Unit\CrudPanel;

class CrudPanelFieldsTest extends BaseCrudPanelTest
{
    private $oneTextFieldArray = [
        'name' => 'field1',
        'label' => 'Field1',
        'type' => 'text',
    ];

    private $expectedOneTextFieldArray = [
        'field1' => [
            'name' => 'field1',
            'label' => 'Field1',
            'type' => 'text',
        ],
    ];

    private $unknownFieldTypeArray = [
        'name' => 'field1',
        'type' => 'unknownType',
    ];

    private $invalidTwoFieldsArray = [
        [
            'keyOne' => 'field1',
            'keyTwo' => 'Field1',
        ],
        [
            'otherKey' => 'field2',
        ],
    ];

    private $twoTextFieldsArray = [
        [
            'name' => 'field1',
            'label' => 'Field1',
            'type' => 'text',
        ],
        [
            'name' => 'field2',
            'label' => 'Field2',
        ],
    ];

    private $expectedTwoTextFieldsArray = [
        'field1' => [
            'name' => 'field1',
            'label' => 'Field1',
            'type' => 'text',
        ],
        'field2' => [
            'name' => 'field2',
            'label' => 'Field2',
            'type' => 'text',
        ],
    ];

    private $threeTextFieldsArray = [
        [
            'name' => 'field1',
            'label' => 'Field1',
            'type' => 'text',
        ],
        [
            'name' => 'field2',
            'label' => 'Field2',
        ],
        [
            'name' => 'field3',
        ],
    ];

    private $expectedThreeTextFieldsArray = [
        'field1' => [
            'name' => 'field1',
            'label' => 'Field1',
            'type' => 'text',
        ],
        'field2' => [
            'name' => 'field2',
            'label' => 'Field2',
            'type' => 'text',
        ],
        'field3' => [
            'name' => 'field3',
            'label' => 'Field3',
            'type' => 'text',
        ],
    ];

    private $multipleFieldTypesArray = [
        [
            'name' => 'field1',
            'label' => 'Field1',
        ],
        [
            'name' => 'field2',
            'type' => 'address',
        ],
        [
            'name' => 'field3',
            'type' => 'address',
        ],
        [
            'name' => 'field4',
            'type' => 'checkbox',
        ],
        [
            'name' => 'field5',
            'type' => 'date',
        ],
        [
            'name' => 'field6',
            'type' => 'email',
        ],
        [
            'name' => 'field7',
            'type' => 'hidden',
        ],
        [
            'name' => 'field8',
            'type' => 'password',
        ],
        [
            'name' => 'field9',
            'type' => 'select2',
        ],
        [
            'name' => 'field10',
            'type' => 'select2_multiple',
        ],
        [
            'name' => 'field11',
            'type' => 'table',
        ],
        [
            'name' => 'field12',
            'type' => 'url',
        ],
    ];

    private $expectedMultipleFieldTypesArray = [
        'field1' => [
            'name' => 'field1',
            'label' => 'Field1',
            'type' => 'text',
        ],
        'field2' => [
            'name' => 'field2',
            'type' => 'address',
            'label' => 'Field2',
        ],
        'field3' => [
            'name' => 'field3',
            'type' => 'address',
            'label' => 'Field3',
        ],
        'field4' => [
            'name' => 'field4',
            'type' => 'checkbox',
            'label' => 'Field4',
        ],
        'field5' => [
            'name' => 'field5',
            'type' => 'date',
            'label' => 'Field5',
        ],
        'field6' => [
            'name' => 'field6',
            'type' => 'email',
            'label' => 'Field6',
        ],
        'field7' => [
            'name' => 'field7',
            'type' => 'hidden',
            'label' => 'Field7',
        ],
        'field8' => [
            'name' => 'field8',
            'type' => 'password',
            'label' => 'Field8',
        ],
        'field9' => [
            'name' => 'field9',
            'type' => 'select2',
            'label' => 'Field9',
        ],
        'field10' => [
            'name' => 'field10',
            'type' => 'select2_multiple',
            'label' => 'Field10',
        ],
        'field11' => [
            'name' => 'field11',
            'type' => 'table',
            'label' => 'Field11',
        ],
        'field12' => [
            'name' => 'field12',
            'type' => 'url',
            'label' => 'Field12',
        ],
    ];

    public function testAddFieldByName()
    {
        $this->crudPanel->addField('field1');

        $this->assertEquals(1, count($this->crudPanel->create_fields));
        $this->assertEquals(1, count($this->crudPanel->update_fields));
        $this->assertEquals($this->expectedOneTextFieldArray, $this->crudPanel->create_fields);
        $this->assertEquals($this->expectedOneTextFieldArray, $this->crudPanel->update_fields);
    }

    public function testAddFieldsByName()
    {
        $this->crudPanel->addFields(['field1', 'field2', 'field3']);

        $this->assertEquals(3, count($this->crudPanel->create_fields));
        $this->assertEquals(3, count($this->crudPanel->update_fields));
        $this->assertEquals($this->expectedThreeTextFieldsArray, $this->crudPanel->create_fields);
        $this->assertEquals($this->expectedThreeTextFieldsArray, $this->crudPanel->update_fields);
    }

    public function testAddFieldsAsArray()
    {
        $this->crudPanel->addFields($this->threeTextFieldsArray);

        $this->assertEquals(3, count($this->crudPanel->create_fields));
        $this->assertEquals(3, count($this->crudPanel->update_fields));
        $this->assertEquals($this->expectedThreeTextFieldsArray, $this->crudPanel->create_fields);
        $this->assertEquals($this->expectedThreeTextFieldsArray, $this->crudPanel->update_fields);
    }

    public function testAddFieldsDifferentTypes()
    {
        $this->crudPanel->addFields($this->multipleFieldTypesArray);

        $this->assertEquals(12, count($this->crudPanel->create_fields));
        $this->assertEquals(12, count($this->crudPanel->update_fields));
        $this->assertEquals($this->expectedMultipleFieldTypesArray, $this->crudPanel->create_fields);
        $this->assertEquals($this->expectedMultipleFieldTypesArray, $this->crudPanel->update_fields);
    }

    public function testAddFieldsInvalidArray()
    {
        $this->expectException(\ErrorException::class);

        $this->crudPanel->addFields($this->invalidTwoFieldsArray);
    }

    public function testAddFieldWithInvalidType()
    {
        $this->markTestIncomplete('Not correctly implemented');

        // TODO: should we validate field types and throw an error if they're not in the pre-defined list of fields or
        //       in the list of custom field?
        $this->crudPanel->addFields($this->unknownFieldTypeArray);
    }

    public function testAddFieldsForCreateForm()
    {
        $this->crudPanel->addFields($this->threeTextFieldsArray, 'create');

        $this->assertEquals(3, count($this->crudPanel->create_fields));
        $this->assertEquals($this->expectedThreeTextFieldsArray, $this->crudPanel->create_fields);
        $this->assertEmpty($this->crudPanel->update_fields);
    }

    public function testAddFieldsForUpdateForm()
    {
        $this->crudPanel->addFields($this->threeTextFieldsArray, 'update');

        $this->assertEquals(3, count($this->crudPanel->update_fields));
        $this->assertEquals($this->expectedThreeTextFieldsArray, $this->crudPanel->update_fields);
        $this->assertEmpty($this->crudPanel->create_fields);
    }

    public function testBeforeField()
    {
        $this->crudPanel->addFields($this->threeTextFieldsArray);

        $this->crudPanel->beforeField('field2');

        $createKeys = array_keys($this->crudPanel->create_fields);
        $this->assertEquals($this->expectedThreeTextFieldsArray['field3'], $this->crudPanel->create_fields[$createKeys[1]]);
        $this->assertEquals(['field1', 'field3', 'field2'], $createKeys);

        $updateKeys = array_keys($this->crudPanel->update_fields);
        $this->assertEquals($this->expectedThreeTextFieldsArray['field3'], $this->crudPanel->update_fields[$updateKeys[1]]);
        $this->assertEquals(['field1', 'field3', 'field2'], $updateKeys);
    }

    public function testBeforeFieldFirstField()
    {
        $this->crudPanel->addFields($this->threeTextFieldsArray);

        $this->crudPanel->beforeField('field1');

        $createKeys = array_keys($this->crudPanel->create_fields);
        $this->assertEquals($this->expectedThreeTextFieldsArray['field3'], $this->crudPanel->create_fields[$createKeys[0]]);
        $this->assertEquals(['field3', 'field1', 'field2'], $createKeys);

        $updateKeys = array_keys($this->crudPanel->update_fields);
        $this->assertEquals($this->expectedThreeTextFieldsArray['field3'], $this->crudPanel->update_fields[$updateKeys[0]]);
        $this->assertEquals(['field3', 'field1', 'field2'], $updateKeys);
    }

    public function testBeforeFieldLastField()
    {
        $this->crudPanel->addFields($this->threeTextFieldsArray);

        $this->crudPanel->beforeField('field3');

        $createKeys = array_keys($this->crudPanel->create_fields);
        $this->assertEquals($this->expectedThreeTextFieldsArray['field3'], $this->crudPanel->create_fields[$createKeys[2]]);
        $this->assertEquals(['field1', 'field2', 'field3'], $createKeys);

        $updateKeys = array_keys($this->crudPanel->update_fields);
        $this->assertEquals($this->expectedThreeTextFieldsArray['field3'], $this->crudPanel->update_fields[$updateKeys[2]]);
        $this->assertEquals(['field1', 'field2', 'field3'], $updateKeys);
    }

    public function testBeforeFieldCreateForm()
    {
        $this->crudPanel->addFields($this->threeTextFieldsArray);

        $this->crudPanel->beforeField('field1', 'create');

        $createKeys = array_keys($this->crudPanel->create_fields);
        $this->assertEquals($this->expectedThreeTextFieldsArray['field3'], $this->crudPanel->create_fields[$createKeys[0]]);
        $this->assertEquals(['field3', 'field1', 'field2'], $createKeys);

        $updateKeys = array_keys($this->crudPanel->update_fields);
        $this->assertEquals($this->expectedThreeTextFieldsArray['field3'], $this->crudPanel->update_fields[$updateKeys[2]]);
        $this->assertEquals(['field1', 'field2', 'field3'], $updateKeys);
    }

    public function testBeforeFieldUpdateForm()
    {
        $this->crudPanel->addFields($this->threeTextFieldsArray);

        $this->crudPanel->beforeField('field1', 'update');

        $createKeys = array_keys($this->crudPanel->create_fields);
        $this->assertEquals($this->expectedThreeTextFieldsArray['field3'], $this->crudPanel->create_fields[$createKeys[2]]);
        $this->assertEquals(['field1', 'field2', 'field3'], $createKeys);

        $updateKeys = array_keys($this->crudPanel->update_fields);
        $this->assertEquals($this->expectedThreeTextFieldsArray['field3'], $this->crudPanel->update_fields[$updateKeys[0]]);
        $this->assertEquals(['field3', 'field1', 'field2'], $updateKeys);
    }

    public function testBeforeFieldForDifferentFieldsInCreateAndUpdate()
    {
        $this->crudPanel->addFields($this->threeTextFieldsArray, 'create');
        $this->crudPanel->addFields($this->twoTextFieldsArray, 'update');

        $this->crudPanel->beforeField('field1');

        $createKeys = array_keys($this->crudPanel->create_fields);
        $this->assertEquals($this->expectedThreeTextFieldsArray['field3'], $this->crudPanel->create_fields[$createKeys[0]]);
        $this->assertEquals(['field3', 'field1', 'field2'], $createKeys);

        $updateKeys = array_keys($this->crudPanel->update_fields);
        $this->assertEquals($this->expectedTwoTextFieldsArray['field2'], $this->crudPanel->update_fields[$updateKeys[0]]);
        $this->assertEquals(['field2', 'field1'], $updateKeys);
    }

    public function testBeforeUnknownField()
    {
        $this->crudPanel->addFields($this->threeTextFieldsArray);

        $this->crudPanel->beforeField('field4');

        $this->assertEquals(3, count($this->crudPanel->create_fields));
        $this->assertEquals(3, count($this->crudPanel->update_fields));
        $this->assertEquals(array_keys($this->expectedThreeTextFieldsArray), array_keys($this->crudPanel->create_fields));
        $this->assertEquals(array_keys($this->expectedThreeTextFieldsArray), array_keys($this->crudPanel->update_fields));
    }

    public function testAfterField()
    {
        $this->crudPanel->addFields($this->threeTextFieldsArray);

        $this->crudPanel->afterField('field1');

        $createKeys = array_keys($this->crudPanel->create_fields);
        $this->assertEquals($this->expectedThreeTextFieldsArray['field3'], $this->crudPanel->create_fields[$createKeys[1]]);
        $this->assertEquals(['field1', 'field3', 'field2'], $createKeys);

        $updateKeys = array_keys($this->crudPanel->update_fields);
        $this->assertEquals($this->expectedThreeTextFieldsArray['field3'], $this->crudPanel->update_fields[$updateKeys[1]]);
        $this->assertEquals(['field1', 'field3', 'field2'], $updateKeys);
    }

    public function testAfterFieldLastField()
    {
        $this->crudPanel->addFields($this->threeTextFieldsArray);

        $this->crudPanel->afterField('field3');

        $createKeys = array_keys($this->crudPanel->create_fields);
        $this->assertEquals($this->expectedThreeTextFieldsArray['field3'], $this->crudPanel->create_fields[$createKeys[2]]);
        $this->assertEquals(['field1', 'field2', 'field3'], $createKeys);

        $updateKeys = array_keys($this->crudPanel->update_fields);
        $this->assertEquals($this->expectedThreeTextFieldsArray['field3'], $this->crudPanel->update_fields[$updateKeys[2]]);
        $this->assertEquals(['field1', 'field2', 'field3'], $updateKeys);
    }

    public function testAfterFieldCreateForm()
    {
        $this->crudPanel->addFields($this->threeTextFieldsArray);

        $this->crudPanel->afterField('field1', 'create');

        $createKeys = array_keys($this->crudPanel->create_fields);
        $this->assertEquals($this->expectedThreeTextFieldsArray['field3'], $this->crudPanel->create_fields[$createKeys[1]]);
        $this->assertEquals(['field1', 'field3', 'field2'], $createKeys);

        $updateKeys = array_keys($this->crudPanel->update_fields);
        $this->assertEquals($this->expectedThreeTextFieldsArray['field3'], $this->crudPanel->update_fields[$updateKeys[2]]);
        $this->assertEquals(['field1', 'field2', 'field3'], $updateKeys);
    }

    public function testAfterFieldUpdateForm()
    {
        $this->crudPanel->addFields($this->threeTextFieldsArray);

        $this->crudPanel->afterField('field1', 'update');

        $createKeys = array_keys($this->crudPanel->create_fields);
        $this->assertEquals($this->expectedThreeTextFieldsArray['field3'], $this->crudPanel->create_fields[$createKeys[2]]);
        $this->assertEquals(['field1', 'field2', 'field3'], $createKeys);

        $updateKeys = array_keys($this->crudPanel->update_fields);
        $this->assertEquals($this->expectedThreeTextFieldsArray['field3'], $this->crudPanel->update_fields[$updateKeys[1]]);
        $this->assertEquals(['field1', 'field3', 'field2'], $updateKeys);
    }

    public function testAfterFieldForDifferentFieldsInCreateAndUpdate()
    {
        $this->crudPanel->addFields($this->threeTextFieldsArray, 'create');
        $this->crudPanel->addFields($this->twoTextFieldsArray, 'update');

        $this->crudPanel->afterField('field1');

        $createKeys = array_keys($this->crudPanel->create_fields);
        $this->assertEquals($this->expectedThreeTextFieldsArray['field3'], $this->crudPanel->create_fields[$createKeys[1]]);
        $this->assertEquals(['field1', 'field3', 'field2'], $createKeys);

        $updateKeys = array_keys($this->crudPanel->update_fields);
        $this->assertEquals($this->expectedTwoTextFieldsArray['field2'], $this->crudPanel->update_fields[$updateKeys[1]]);
        $this->assertEquals(['field1', 'field2'], $updateKeys);
    }

    public function testAfterUnknownField()
    {
        $this->crudPanel->addFields($this->threeTextFieldsArray);

        $this->crudPanel->afterField('field4');

        $this->assertEquals(3, count($this->crudPanel->create_fields));
        $this->assertEquals(3, count($this->crudPanel->update_fields));
        $this->assertEquals(array_keys($this->expectedThreeTextFieldsArray), array_keys($this->crudPanel->create_fields));
        $this->assertEquals(array_keys($this->expectedThreeTextFieldsArray), array_keys($this->crudPanel->update_fields));
    }

    public function testRemoveFieldsByName()
    {
        $this->crudPanel->addFields($this->threeTextFieldsArray);

        $this->crudPanel->removeFields(['field1']);

        $this->assertEquals(2, count($this->crudPanel->create_fields));
        $this->assertEquals(2, count($this->crudPanel->update_fields));
        $this->assertEquals(['field2', 'field3'], array_keys($this->crudPanel->create_fields));
        $this->assertEquals(['field2', 'field3'], array_keys($this->crudPanel->update_fields));
    }

    public function testRemoveFieldsByNameInvalidArray()
    {
        $this->markTestIncomplete('Not correctly implemented');

        $this->crudPanel->addFields($this->threeTextFieldsArray);

        // TODO: this should not work because the method specifically asks for an array of field keys, but it does
        //       because the removeField method will actually work with arrays instead of a string
        $this->crudPanel->removeFields($this->twoTextFieldsArray);

        $this->assertEquals(3, count($this->crudPanel->create_fields));
        $this->assertEquals(3, count($this->crudPanel->update_fields));
        $this->assertEquals(array_keys($this->expectedThreeTextFieldsArray), array_keys($this->crudPanel->create_fields));
        $this->assertEquals(array_keys($this->expectedThreeTextFieldsArray), array_keys($this->crudPanel->update_fields));
    }

    public function testRemoveFieldsFromCreateForm()
    {
        $this->crudPanel->addFields($this->threeTextFieldsArray);

        $this->crudPanel->removeFields(['field1'], 'create');

        $this->assertEquals(2, count($this->crudPanel->create_fields));
        $this->assertEquals(3, count($this->crudPanel->update_fields));
        $this->assertEquals(['field2', 'field3'], array_keys($this->crudPanel->create_fields));
        $this->assertEquals(array_keys($this->expectedThreeTextFieldsArray), array_keys($this->crudPanel->update_fields));
    }

    public function testRemoveFieldsFromUpdateForm()
    {
        $this->crudPanel->addFields($this->threeTextFieldsArray);

        $this->crudPanel->removeFields(['field1'], 'update');

        $this->assertEquals(3, count($this->crudPanel->create_fields));
        $this->assertEquals(2, count($this->crudPanel->update_fields));
        $this->assertEquals(array_keys($this->expectedThreeTextFieldsArray), array_keys($this->crudPanel->create_fields));
        $this->assertEquals(['field2', 'field3'], array_keys($this->crudPanel->update_fields));
    }

    public function testRemoveUnknownFields()
    {
        $this->crudPanel->addFields($this->threeTextFieldsArray);

        $this->crudPanel->removeFields(['field4']);

        $this->assertEquals(3, count($this->crudPanel->create_fields));
        $this->assertEquals(3, count($this->crudPanel->update_fields));
        $this->assertEquals(array_keys($this->expectedThreeTextFieldsArray), array_keys($this->crudPanel->create_fields));
        $this->assertEquals(array_keys($this->expectedThreeTextFieldsArray), array_keys($this->crudPanel->update_fields));
    }

    public function testOrderFields()
    {
        $this->crudPanel->addFields($this->threeTextFieldsArray);

        $this->crudPanel->orderFields(['field2', 'field1', 'field3']);

        $this->assertEquals(['field2', 'field1', 'field3'], array_keys($this->crudPanel->create_fields));
        $this->assertEquals(['field2', 'field1', 'field3'], array_keys($this->crudPanel->update_fields));
    }

    public function testOrderFieldsCreateForm()
    {
        $this->crudPanel->addFields($this->threeTextFieldsArray);

        $this->crudPanel->orderFields(['field2', 'field1', 'field3'], 'create');

        $this->assertEquals(['field2', 'field1', 'field3'], array_keys($this->crudPanel->create_fields));
        $this->assertEquals($this->expectedThreeTextFieldsArray, $this->crudPanel->update_fields);
    }

    public function testOrderFieldsUpdateForm()
    {
        $this->crudPanel->addFields($this->threeTextFieldsArray);

        $this->crudPanel->orderFields(['field2', 'field1', 'field3'], 'update');

        $this->assertEquals($this->expectedThreeTextFieldsArray, $this->crudPanel->create_fields);
        $this->assertEquals(['field2', 'field1', 'field3'], array_keys($this->crudPanel->update_fields));
    }

    public function testOrderFieldsIncompleteList()
    {
        $this->crudPanel->addFields($this->threeTextFieldsArray);

        $this->crudPanel->orderFields(['field2', 'field3']);

        $this->assertEquals(['field2', 'field3', 'field1'], array_keys($this->crudPanel->create_fields));
        $this->assertEquals(['field2', 'field3', 'field1'], array_keys($this->crudPanel->update_fields));
    }

    public function testOrderFieldsEmptyList()
    {
        $this->crudPanel->addFields($this->threeTextFieldsArray);

        $this->crudPanel->orderFields([]);

        $this->assertEquals($this->expectedThreeTextFieldsArray, $this->crudPanel->create_fields);
        $this->assertEquals($this->expectedThreeTextFieldsArray, $this->crudPanel->update_fields);
    }

    public function testOrderFieldsUnknownList()
    {
        $this->crudPanel->addFields($this->threeTextFieldsArray);

        $this->crudPanel->orderFields(['field4', 'field5', 'field6']);

        $this->assertEquals($this->expectedThreeTextFieldsArray, $this->crudPanel->create_fields);
        $this->assertEquals($this->expectedThreeTextFieldsArray, $this->crudPanel->update_fields);
    }

    public function testOrderColumnsMixedList()
    {
        $this->crudPanel->addFields($this->threeTextFieldsArray);

        $this->crudPanel->orderFields(['field2', 'field5', 'field6']);

        $this->assertEquals(['field2', 'field1', 'field3'], array_keys($this->crudPanel->create_fields));
        $this->assertEquals(['field2', 'field1', 'field3'], array_keys($this->crudPanel->update_fields));
    }

    public function testCheckIfFieldIsFirstOfItsType()
    {
        $this->crudPanel->addFields($this->multipleFieldTypesArray);

        $isFirstAddressFieldFirst = $this->crudPanel->checkIfFieldIsFirstOfItsType($this->multipleFieldTypesArray[1]);
        $isSecondAddressFieldFirst = $this->crudPanel->checkIfFieldIsFirstOfItsType($this->multipleFieldTypesArray[2]);

        $this->assertTrue($isFirstAddressFieldFirst);
        $this->assertFalse($isSecondAddressFieldFirst);
    }

    public function testCheckIfUnknownFieldIsFirstOfItsType()
    {
        $isUnknownFieldFirst = $this->crudPanel->checkIfFieldIsFirstOfItsType($this->unknownFieldTypeArray, $this->expectedMultipleFieldTypesArray);

        $this->assertFalse($isUnknownFieldFirst);
    }

    public function testCheckIfInvalidFieldIsFirstOfItsType()
    {
        $this->expectException(\ErrorException::class);

        $this->crudPanel->checkIfFieldIsFirstOfItsType($this->invalidTwoFieldsArray[0], $this->expectedMultipleFieldTypesArray);
    }

    public function testDecodeJsonCastedAttributes()
    {
        $this->markTestIncomplete();

        // TODO: the decode JSON method should not be in fields trait and should not be exposed in the public API.
    }
}

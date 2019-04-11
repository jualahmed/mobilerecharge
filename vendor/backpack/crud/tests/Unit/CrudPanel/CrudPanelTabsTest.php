<?php

namespace Backpack\CRUD\Tests\Unit\CrudPanel;

use Illuminate\Support\Facades\DB;
use Backpack\CRUD\Tests\Unit\Models\Article;

class CrudPanelTabsTest extends BaseDBCrudPanelTest
{
    private $horizontalTabsType = 'horizontal';
    private $verticalTabsType = 'vertical';

    private $threeTextFieldsArray = [
        [
            'name' => 'field1',
            'label' => 'Field1',
        ],
        [
            'name' => 'field2',
            'label' => 'Field2',
            'tab' => 'First Tab',
        ],
        [
            'name' => 'field3',
            'label' => 'Field3',
            'tab' => 'First Tab',
            'type' => 'email',
        ],
        [
            'name' => 'field4',
            'label' => 'Field4',
            'tab' => 'Second Tab',
        ],
        [
            'name' => 'field5',
            'label' => 'Field5',
            'tab' => 'Third Tab',
        ],
    ];

    private $expectedTabNames = ['First Tab', 'Second Tab', 'Third Tab'];

    private $expectedFieldsInFirstTab = [
        'field2' => [
            'name' => 'field2',
            'label' => 'Field2',
            'tab' => 'First Tab',
            'type' => 'text',
        ],
        'field3' => [
            'name' => 'field3',
            'label' => 'Field3',
            'tab' => 'First Tab',
            'type' => 'email',
        ],
    ];

    private $expectedFieldsInSecondTab = [
        'field2' => [
            'name' => 'field4',
            'label' => 'Field4',
            'tab' => 'Second Tab',
            'type' => 'text',
        ],
    ];

    private $expectedFieldsInThirdTab = [
        'field2' => [
            'name' => 'field5',
            'label' => 'Field5',
            'tab' => 'Third Tab',
            'type' => 'text',
        ],
    ];

    public function testEnableTabs()
    {
        $this->crudPanel->enableTabs();

        $this->assertTrue($this->crudPanel->tabsEnabled);
    }

    public function testDisableTabs()
    {
        $this->crudPanel->disableTabs();

        $this->assertFalse($this->crudPanel->tabsEnabled);
    }

    public function testTabsEnabled()
    {
        $this->crudPanel->enableTabs();

        $this->assertTrue($this->crudPanel->tabsEnabled());
    }

    public function testTabsDisabled()
    {
        $this->crudPanel->disableTabs();

        $this->assertTrue($this->crudPanel->tabsDisabled());
    }

    public function testSetTabsType()
    {
        $this->crudPanel->setTabsType($this->verticalTabsType);

        $this->assertEquals($this->verticalTabsType, $this->crudPanel->tabsType);
    }

    public function testGetTabsType()
    {
        $defaultTabsType = $this->crudPanel->getTabsType();

        $this->assertEquals($this->horizontalTabsType, $defaultTabsType);
    }

    public function testEnableVerticalTabs()
    {
        $this->crudPanel->enableVerticalTabs();

        $this->assertEquals($this->verticalTabsType, $this->crudPanel->getTabsType());
    }

    public function testDisableVerticalTabs()
    {
        $this->crudPanel->disableVerticalTabs();

        $this->assertEquals($this->horizontalTabsType, $this->crudPanel->getTabsType());
    }

    public function testEnableHorizontalTabs()
    {
        $this->crudPanel->enableHorizontalTabs();

        $this->assertEquals($this->horizontalTabsType, $this->crudPanel->getTabsType());
    }

    public function testDisableHorizontalTabs()
    {
        $this->crudPanel->disableHorizontalTabs();

        $this->assertEquals($this->verticalTabsType, $this->crudPanel->getTabsType());
    }

    public function testTabExists()
    {
        $this->crudPanel->addFields($this->threeTextFieldsArray);

        $tabExists = $this->crudPanel->tabExists($this->expectedTabNames[0]);

        $this->assertTrue($tabExists);
    }

    public function testTabExistsUnknownLabel()
    {
        $this->crudPanel->addFields($this->threeTextFieldsArray);

        $tabExists = $this->crudPanel->tabExists('someLabel');

        $this->assertFalse($tabExists);
    }

    public function testGetLastTab()
    {
        $this->crudPanel->addFields($this->threeTextFieldsArray);

        $lastTab = $this->crudPanel->getLastTab();

        $this->assertEquals(array_last($this->expectedTabNames), $lastTab);
    }

    public function testGetLastTabNoTabs()
    {
        $lastTab = $this->crudPanel->getLastTab();

        $this->assertFalse($lastTab);
    }

    public function testIsLastTab()
    {
        $this->crudPanel->addFields($this->threeTextFieldsArray);

        $isFirstLastTab = $this->crudPanel->isLastTab($this->expectedTabNames[0]);
        $isSecondLastTab = $this->crudPanel->isLastTab($this->expectedTabNames[1]);
        $isThirdLastTab = $this->crudPanel->isLastTab($this->expectedTabNames[2]);

        $this->assertFalse($isFirstLastTab);
        $this->assertFalse($isSecondLastTab);
        $this->assertTrue($isThirdLastTab);
    }

    public function testIsLastTabUnknownLabel()
    {
        $this->crudPanel->addFields($this->threeTextFieldsArray);

        $isUnknownLastTab = $this->crudPanel->isLastTab('someLabel');

        $this->assertFalse($isUnknownLastTab);
    }

    public function testGetTabFields()
    {
        $this->markTestIncomplete('Not correctly implemented');

        $this->crudPanel->addFields($this->threeTextFieldsArray);

        // TODO: the method returns an eloquent collection in case fields for a given label are found, array if
        //       otherwise. the return type should be either one or the other.
        $firstTabFields = $this->crudPanel->getTabFields($this->expectedTabNames[0]);
        $secondTabFields = $this->crudPanel->getTabFields($this->expectedTabNames[1]);
        $thirdTabFields = $this->crudPanel->getTabFields($this->expectedTabNames[2]);

        $this->assertEquals($this->expectedFieldsInFirstTab, $firstTabFields);
        $this->assertEquals($this->expectedFieldsInSecondTab, $secondTabFields);
        $this->assertEquals($this->expectedFieldsInThirdTab, $thirdTabFields);
    }

    public function testGetTabFieldsUnknownLabel()
    {
        $tabFields = $this->crudPanel->getTabFields('someLabel');

        $this->assertEmpty($tabFields);
    }

    public function testGetTabs()
    {
        $this->crudPanel->addFields($this->threeTextFieldsArray);

        $tabNames = $this->crudPanel->getTabs();

        $this->assertEquals($this->expectedTabNames, $tabNames);
    }

    public function testGetTabsEntryExists()
    {
        $this->crudPanel->setModel(Article::class);
        $article = DB::table('articles')->where('id', 1)->first();

        // manually call this method to set the crud panel entry attribute used in the getTabs method to get the current
        // fields from the update form.
        $this->crudPanel->getEntry($article->id);

        $this->crudPanel->addFields($this->threeTextFieldsArray, 'update');
        $tabNames = $this->crudPanel->getTabs();

        $this->assertEquals($this->expectedTabNames, $tabNames);
    }
}

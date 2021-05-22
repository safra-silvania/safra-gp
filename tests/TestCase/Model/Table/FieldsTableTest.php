<?php
declare(strict_types=1);

namespace App\Test\TestCase\Model\Table;

use App\Model\Table\FieldsTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\FieldsTable Test Case
 */
class FieldsTableTest extends TestCase
{
    /**
     * @var \App\Model\Table\FieldsTable
     */
    protected $Fields;

    /**
     * @var array
     */
    protected $fixtures = [
        'app.Fields',
        'app.Immobiles',
        'app.MeasureUnits',
        'app.CultivationSystems',
        'app.Fertilities',
        'app.Cities',
        'app.FieldDetails',
        'app.PlanFields',
        'app.Sketches',
    ];

    public function setUp(): void
    {
        parent::setUp();
        $config = TableRegistry::getTableLocator()->exists('Fields') ? [] : ['className' => FieldsTable::class];
        $this->Fields = TableRegistry::getTableLocator()->get('Fields', $config);
    }

    public function tearDown(): void
    {
        unset($this->Fields);

        parent::tearDown();
    }

    public function testBeforeSave(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    public function testAfterSave(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    public function testInsertPlanFieldAfterPlanning(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    public function testValidationDefault(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    public function testBuildRules(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    public function testGetFieldsByImmobile(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}

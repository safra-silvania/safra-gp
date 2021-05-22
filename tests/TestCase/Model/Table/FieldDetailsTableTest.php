<?php
declare(strict_types=1);

namespace App\Test\TestCase\Model\Table;

use App\Model\Table\FieldDetailsTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\FieldDetailsTable Test Case
 */
class FieldDetailsTableTest extends TestCase
{
    /**
     * @var \App\Model\Table\FieldDetailsTable
     */
    protected $FieldDetails;

    /**
     * @var array
     */
    protected $fixtures = [
        'app.FieldDetails',
        'app.Fields',
        'app.Cultures',
        'app.Fertilities',
        'app.MeasureUnits',
        'app.PlanFieldDetails',
    ];

    public function setUp(): void
    {
        parent::setUp();
        $config = TableRegistry::getTableLocator()->exists('FieldDetails') ? [] : ['className' => FieldDetailsTable::class];
        $this->FieldDetails = TableRegistry::getTableLocator()->get('FieldDetails', $config);
    }

    public function tearDown(): void
    {
        unset($this->FieldDetails);

        parent::tearDown();
    }

    public function testValidationDefault(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    public function testBuildRules(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}

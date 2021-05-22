<?php
declare(strict_types=1);

namespace App\Test\TestCase\Model\Table;

use App\Model\Table\SelectedChemicalsTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\SelectedChemicalsTable Test Case
 */
class SelectedChemicalsTableTest extends TestCase
{
    /**
     * @var \App\Model\Table\SelectedChemicalsTable
     */
    protected $SelectedChemicals;

    /**
     * @var array
     */
    protected $fixtures = [
        'app.SelectedChemicals',
        'app.Chemicals',
        'app.Plans',
    ];

    public function setUp(): void
    {
        parent::setUp();
        $config = TableRegistry::getTableLocator()->exists('SelectedChemicals') ? [] : ['className' => SelectedChemicalsTable::class];
        $this->SelectedChemicals = TableRegistry::getTableLocator()->get('SelectedChemicals', $config);
    }

    public function tearDown(): void
    {
        unset($this->SelectedChemicals);

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

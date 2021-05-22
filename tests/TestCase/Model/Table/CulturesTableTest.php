<?php
declare(strict_types=1);

namespace App\Test\TestCase\Model\Table;

use App\Model\Table\CulturesTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\CulturesTable Test Case
 */
class CulturesTableTest extends TestCase
{
    /**
     * @var \App\Model\Table\CulturesTable
     */
    protected $Cultures;

    /**
     * @var array
     */
    protected $fixtures = [
        'app.Cultures',
        'app.FieldDetails',
        'app.Seeds',
    ];

    public function setUp(): void
    {
        parent::setUp();
        $config = TableRegistry::getTableLocator()->exists('Cultures') ? [] : ['className' => CulturesTable::class];
        $this->Cultures = TableRegistry::getTableLocator()->get('Cultures', $config);
    }

    public function tearDown(): void
    {
        unset($this->Cultures);

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

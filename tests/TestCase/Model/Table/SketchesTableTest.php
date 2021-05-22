<?php
declare(strict_types=1);

namespace App\Test\TestCase\Model\Table;

use App\Model\Table\SketchesTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\SketchesTable Test Case
 */
class SketchesTableTest extends TestCase
{
    /**
     * @var \App\Model\Table\SketchesTable
     */
    protected $Sketches;

    /**
     * @var array
     */
    protected $fixtures = [
        'app.Sketches',
        'app.Fields',
        'app.Files',
    ];

    public function setUp(): void
    {
        parent::setUp();
        $config = TableRegistry::getTableLocator()->exists('Sketches') ? [] : ['className' => SketchesTable::class];
        $this->Sketches = TableRegistry::getTableLocator()->get('Sketches', $config);
    }

    public function tearDown(): void
    {
        unset($this->Sketches);

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

<?php
declare(strict_types=1);

namespace App\Test\TestCase\Model\Table;

use App\Model\Table\ChemicalNotesTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\ChemicalNotesTable Test Case
 */
class ChemicalNotesTableTest extends TestCase
{
    /**
     * @var \App\Model\Table\ChemicalNotesTable
     */
    protected $ChemicalNotes;

    /**
     * @var array
     */
    protected $fixtures = [
        'app.ChemicalNotes',
        'app.Chemicals',
    ];

    public function setUp(): void
    {
        parent::setUp();
        $config = TableRegistry::getTableLocator()->exists('ChemicalNotes') ? [] : ['className' => ChemicalNotesTable::class];
        $this->ChemicalNotes = TableRegistry::getTableLocator()->get('ChemicalNotes', $config);
    }

    public function tearDown(): void
    {
        unset($this->ChemicalNotes);

        parent::tearDown();
    }

    public function testValidationDefault(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}

<?php
declare(strict_types=1);

namespace App\Test\TestCase\Model\Table;

use App\Model\Table\ApplicationSeasonsTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\ApplicationSeasonsTable Test Case
 */
class ApplicationSeasonsTableTest extends TestCase
{
    /**
     * @var \App\Model\Table\ApplicationSeasonsTable
     */
    protected $ApplicationSeasons;

    /**
     * @var array
     */
    protected $fixtures = [
        'app.ApplicationSeasons',
        'app.Chemicals',
    ];

    public function setUp(): void
    {
        parent::setUp();
        $config = TableRegistry::getTableLocator()->exists('ApplicationSeasons') ? [] : ['className' => ApplicationSeasonsTable::class];
        $this->ApplicationSeasons = TableRegistry::getTableLocator()->get('ApplicationSeasons', $config);
    }

    public function tearDown(): void
    {
        unset($this->ApplicationSeasons);

        parent::tearDown();
    }

    public function testValidationDefault(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}

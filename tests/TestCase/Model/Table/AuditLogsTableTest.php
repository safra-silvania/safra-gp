<?php
declare(strict_types=1);

namespace App\Test\TestCase\Model\Table;

use App\Model\Table\AuditLogsTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\AuditLogsTable Test Case
 */
class AuditLogsTableTest extends TestCase
{
    /**
     * @var \App\Model\Table\AuditLogsTable
     */
    protected $AuditLogs;

    /**
     * @var array
     */
    protected $fixtures = [
        'app.AuditLogs',
    ];

    public function setUp(): void
    {
        parent::setUp();
        $config = TableRegistry::getTableLocator()->exists('AuditLogs') ? [] : ['className' => AuditLogsTable::class];
        $this->AuditLogs = TableRegistry::getTableLocator()->get('AuditLogs', $config);
    }

    public function tearDown(): void
    {
        unset($this->AuditLogs);

        parent::tearDown();
    }

    public function testValidationDefault(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}

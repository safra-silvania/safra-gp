<?php
declare(strict_types=1);

namespace App\Test\TestCase\Controller;

use App\Controller\AuditLogsController;
use Cake\TestSuite\IntegrationTestTrait;
use Cake\TestSuite\TestCase;
use Cake\ORM\TableRegistry;

/**
 * App\Controller\AuditLogsController Test Case
 *
 * @uses \App\Controller\AuditLogsController
 */
class AuditLogsControllerTest extends TestCase
{
    use IntegrationTestTrait;

    /**
     * @var array
     */
    protected $fixtures = [
        'app.AuditLogs',
    ];
    
    /**
     * @var \App\Model\Table\AuditlogsTable
     */
    protected $Auditlogs;

    public function setUp(): void
    {
        parent::setUp();

        $this->session([
            'Auth' => [
                'User' => [
                    'id' => 1,
                    'role_id' => 1,
                    'username' => 'testing',
                    'email' => 'testing@test.com',
                ]
            ]
        ]);

        $this->enableCsrfToken();
        $this->enableSecurityToken();

        $this->Auditlogs = TableRegistry::getTableLocator()->get('Auditlogs');
    }

    public function testBeforeFilter(): void
    {
        $this->get('/auditlogs');
        $this->assertResponseOk();
    }

    public function testGetTimelineData(): void
    {
        $this->get('/auditlogs');
        $this->assertResponseOk();
    }

    public function testAddPostData()
    {
        $this->markTestIncomplete('Not implemented yet.');

        /*
        $data = [];
        $this->post('/auditlogs/add', $data);

        $this->assertResponseSuccess();
        $auditlogs = TableRegistry::getTableLocator()->get('Auditlogs');
        $query = $auditlogs->find()->where(['' => $data['']]);
        $this->assertEquals(1, $query->count());
        */
    }

    public function testEditPostData()
    {
        $this->markTestIncomplete('Not implemented yet.');

        /*
        $data = [];
        $this->post('/auditlogs/edit/1', $data);

        $this->assertResponseSuccess();
        $auditlogs = TableRegistry::getTableLocator()->get('Auditlogs');
        $query = $auditlogs->find()->where(['' => $data['']]);
        $this->assertEquals(1, $query->count());
        */
    }
}

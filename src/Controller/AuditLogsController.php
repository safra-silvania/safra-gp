<?php
declare(strict_types=1);

namespace App\Controller;

/**
 * @property \App\Model\Table\AuditLogsTable $AuditLogs
 * @method \App\Model\Entity\AuditLog[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class AuditLogsController extends AppController
{
    public function beforeFilter(\Cake\Event\EventInterface $event)
    {
        parent::beforeFilter($event);

        $this->viewBuilder()->setLayout('admin');

        $this->set('canCreate', $this->userAuthenticated && $this->userAuthenticated->can('create', $this->AuditLogs->newEmptyEntity()));
    }

    public function getTimelineData($id=null, $model=null)
    {
        $this->RequestHandler->respondAs('json');
        $this->autoRender = false;
        
        //@todo: move to AuditLogsTable->getLogsByModel()
        $query = $this->AuditLogs->find();

        $logs = $query->select([
            'year' => 'YEAR(created)',
            'month' => 'MONTH(created)',
            'monthName' => 'MONTHNAME(created)',
            'id',
            'source',
            'primary_key',
            'type',
            'original',
            'changed',
            'meta',
            'created',
        ])
        ->where([
            'primary_key' => $id,
            'source' => $model,
        ])
        ->order(['created' => 'DESC']);
        
        // pr(json_encode($logs, JSON_PRETTY_PRINT));
        echo json_encode($logs, JSON_PRETTY_PRINT);
        die();
    }
    
}

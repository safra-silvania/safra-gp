<?php
declare(strict_types=1);

namespace App\Controller;

class DashboardController extends AppController
{
    public function beforeFilter(\Cake\Event\EventInterface $event)
    {
        parent::beforeFilter($event);

        $this->viewBuilder()->setLayout('admin');
    }

    public function index()
    {
    }

    public function profile()
    {
        $this->set('title', "Meu Perfil");
    }
}
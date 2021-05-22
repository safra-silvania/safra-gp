<?php
declare(strict_types=1);

namespace App\View\Cell;

use Cake\View\Cell;

/**
 * ImmobileCard cell
 */
class ImmobileCardCell extends Cell
{
    /**
     * List of valid options that can be passed into this
     * cell's constructor.
     *
     * @var array
     */
    protected $_validCellOptions = [];

    /**
     * Initialization logic run at the end of object construction.
     *
     * @return void
     */
    public function initialize(): void
    {
        $this->loadModel('Immobiles');
    }

    /**
     * Default display method.
     *
     * @return void
     */
    public function display($immobileId)
    {
        $immobile = $this->Immobiles->get($immobileId, ['contain' => ['Producers', 'Cities', 'Plans']]);
        $totals = $this->Immobiles->getTotalAreaGroupByCultivationSystem($immobile->id);
        $isCompletedArea = $this->Immobiles->isCompletedArea($immobile->id);

        $this->set(compact('immobile', 'totals', 'isCompletedArea'));
    }
}

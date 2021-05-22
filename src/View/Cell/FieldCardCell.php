<?php
declare(strict_types=1);

namespace App\View\Cell;

use Cake\View\Cell;

/**
 * FieldCard cell
 */
class FieldCardCell extends Cell
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
        $this->loadModel('Fields');
        $this->loadModel('Immobiles');
        $this->loadModel('FieldDetails');
    }

    /**
     * Default display method.
     *
     * @return void
     */
    public function display($fieldId)
    {
        $field = $this->Fields->get($fieldId, ['contain' => ['Immobiles', 'Immobiles.Producers', 'Cities']]);
        $totals = $this->FieldDetails->getTotalAreaGroupByCulture($fieldId);

        $this->set(compact('field', 'totals'));
    }
}

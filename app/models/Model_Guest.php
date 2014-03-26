<?php

/**
 * Object model mapping for relational table `guest` 
 */
class Model_Guest extends Model_Base {
    
    public function getAll($isBean = false) {
        if ($isBean)
            return R::findAll('guest', 'ORDER BY modify_date DESC');
        else
            return R::getAll('SELECT * FROM guest ORDER BY modify_date DESC');
    }

    // lifecycle hooks
    public function dispense() {
        parent::dispense();
        $this->bean->role = $this->beanType;
    }

}

?>

<?php

/**
 * Object model mapping for relational table `guest` 
 */
class Model_Guest extends Model_Base {

    // lifecycle hooks
    public function dispense() {
        parent::dispense();
        $this->bean->role = $this->beanType;
    }

}

?>

<?php

/* Base Model for all common actions
 * 
 * RedBean Fused methods
 * R::store	$model->update()
 * R::store	$model->after_update()
 * R::load	$model->open()
 * R::trash	$model->delete()
 * R::trash	$model->after_delete()
 * R::dispense	$model->dispense()
 * 
 */

class Model_Base extends RedBean_SimpleModel {
    
    protected $beanType;
    
    // lifecycle hooks
    public function dispense() {
        $this->beanType = $this->bean->getMeta('type');
    }

    public function update() {
        $this->bean->modify_date = date("Y-m-d H:i:s");
    }

}

?>

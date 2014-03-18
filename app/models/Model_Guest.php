<?php

/**
 * Object model mapping for relational table `guest`
 *
 * RedBean Fused methods
 * R::store	$model->update()
 * R::store	$model->after_update()
 * R::load	$model->open()
 * R::trash	$model->delete()
 * R::trash	$model->after_delete()
 * R::dispense	$model->dispense()
 */

class Model_Guest extends RedBean_SimpleModel {

    // lifecycle hooks

    public function dispense() {
        $this->role = 'guest';
    }


    public function update() {
        $this->modify_date = date("Y-m-d H:i:s");
    }

}

?>

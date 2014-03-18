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

  // app functions
  public function get_guests() {

  $sql = R::findAll('guest', 'ORDER BY modify_date DESC');
  return $sql;

  }


  public function get_guests_json() {

  $sql = R::getAll('SELECT * FROM guest ORDER BY modify_date DESC');
  return $sql;

  }


    // lifecycle hooks

    public function dispense() {
        $this->role = 'guest';
    }


    public function update() {
        $this->modify_date = date("Y-m-d H:i:s");
    }

}

?>

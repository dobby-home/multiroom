<?php defined('SYSPATH') or die('No direct script access.');


class Controller_Ajax_Multiroom extends Controller_Ajax {

    public function action_add() {

        $multiroom = Multiroom::factory()->save($this->request->post());

        Message::instance()->isempty(true);
        Message::instance(0, 'Устройство добавлено')->setValue(array('id' => $multiroom->id))->out(true);
    }


    public function action_edit() {

        Multiroom::factory($this->request->post('id'))->save($this->request->post());

        Message::instance()->isempty(true);
        Message::instance(0, 'Изменения сохранены')->out(true);
    }

    public function action_test() {

    }
}
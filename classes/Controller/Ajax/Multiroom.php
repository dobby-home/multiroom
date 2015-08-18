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

        Multiroom::factory($this->request->post('id'))->test();

    }

    public function action_scan() {
        Multiroom::send('command=scan');
    }

    public function action_play() {
        Multiroom::send('command=play&id=' . $this->request->post('id') . '&channels=' . $this->request->post('channels'));
    }

    public function action_stop() {
        Multiroom::send('command=stop&channels=' . $this->request->post('channels'));
    }
}
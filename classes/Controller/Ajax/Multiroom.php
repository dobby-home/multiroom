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

        $room = Multiroom::factory($this->request->post('id'));
        Multiroom::send('command=say&channels=' . $room->channels . '&text=' . "Это " . $room->name);
//        Multiroom::factory($this->request->post('id'))->test();

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

    public function action_say() {
        Multiroom::send('command=say&channels=' . $this->request->post('channels') . '&text=' . "Погода сегодня прекрасная, За окном плюс 60, ожидается дождь");
//        Multiroom::send('command=say&channels=' . $this->request->post('channels') . '&text=' . "Пукся");
    }

    public function action_playlists() {
        $result = Multiroom::send('command=getplaylists');
        echo json_encode($result);
    }

    public function action_position() {
        Multiroom::send('command=position&position=' . round($this->request->post('position'),2) . '&playlist=' . $this->request->post('playlist'));
    }
}
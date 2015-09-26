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
        Multiroom::send('command=say&channels=' . $room->channels . '&text=' . "Это " . $room->name . '&voice=' . Module::instance(Multiroom::NAME)->getValue('voice'));

    }

    public function action_scan() {
        Multiroom::send('command=scan');
    }

    public function action_play() {
        if ($this->request->post('channels') !== null) {
            Multiroom::send('command=play&id=' . $this->request->post('id') . '&channels=' . $this->request->post('channels'));
        }
        if ($this->request->post('playlist') !== null) {
            Multiroom::send('command=play&playlist=' . $this->request->post('playlist'));
        }
    }

    public function action_stop() {
        if ($this->request->post('channels') !== null) {
            Multiroom::send('command=stop&channels=' . $this->request->post('channels'));
        }
        if ($this->request->post('playlist') !== null) {
            Multiroom::send('command=stop&playlist=' . $this->request->post('playlist'));
        }
    }

    public function action_pause() {
        Multiroom::send('command=pause&playlist=' . $this->request->post('playlist'));
    }

    public function action_say() {
        Multiroom::send('command=say&channels=' . $this->request->post('channels') . '&text=' . "Погода сегодня прекрасная, За окном плюс 60, ожидается дождь");
//        Multiroom::send('command=say&channels=' . $this->request->post('channels') . '&text=' . "Пукся");
    }

    public function action_playlists() {
        $result = Multiroom::send('command=getplaylists');
        echo($result);
    }

    public function action_channels() {
        $result = Multiroom::send('command=getchannels');
        echo($result);
    }

    public function action_position() {
        Multiroom::send('command=position&position=' . round($this->request->post('position'), 2) . '&playlist=' . $this->request->post('playlist'));
    }

    public function action_next() {
        Multiroom::send('command=next&playlist=' . $this->request->post('playlist'));
    }

    public function action_prev() {
        Multiroom::send('command=prev&playlist=' . $this->request->post('playlist'));
    }

    public function action_volume() {
        Multiroom::send('command=setvolume&volume=' . round($this->request->post('volume'), 2) . '&channels=' . $this->request->post('channels'));
    }

    public function action_setvoice() {
        Module::instance(Multiroom::NAME)->setValue('voice', $this->request->post('name'));
    }
}
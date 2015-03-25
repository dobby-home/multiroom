<?php defined('SYSPATH') or die('No direct script access.');


class Controller_Admin_Multiroom extends Controller_Admin {

    public $template = 'admin/multiroom/index';

    public function before(){
        parent::before();
        $this->view->outputs = Multiroom::$ouputs;
    }

    public function action_index() {

        if ($this->request->param('id') && is_numeric($this->request->param('id'))) {

            $this->template = 'admin/multiroom/edit';
            $this->view->item = Module::instance(Multiroom::NAME)->getRecord($this->request->param('id'));

        } else {
            $this->view->items = Module::instance(Multiroom::NAME)->getValues();
        }
    }


    public function action_add() {
        $this->template = 'admin/multiroom/add';
    }

}
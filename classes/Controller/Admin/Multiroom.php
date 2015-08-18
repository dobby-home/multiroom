<?php defined('SYSPATH') or die('No direct script access.');


class Controller_Admin_Multiroom extends Controller_Admin {

    public $template = 'admin/multiroom/index';

    public function before() {
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

    public function action_library() {
        $this->template = 'admin/multiroom/library';
        $array = Multiroom::getItems();
        //Helper to create nodes

        $tree = $this->tree_node(array('id_files' => 0, 'id_parent' => 0), null); //root node
        $map = array(0 => &$tree);
        foreach ($array as $cur) {
            $id = (int)$cur['id_files'];
            $parentId = (int)$cur['id_parent'];
            $map[$id] =& $map[$parentId]['children'][];
            $map[$id] = $this->tree_node($cur);
        }

        function flatter($node) {
            //Create an array element of the node
            $array_element = $node;
            //Add all children after me
            $result = array($array_element);
            foreach ($node['children'] as $child) {
                $result = array_merge($result, flatter($child));
            }
            return $result;
        }

        $array = flatter($tree);
        array_shift($array); //Remove the root node, which was only added as a helper
        $this->view->files = $array;
        $this->view->rooms = Module::instance(Multiroom::NAME)->getValues();
    }

    private function tree_node($data) {
        $data['children'] = array();
        return $data;
    }
}
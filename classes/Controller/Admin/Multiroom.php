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
            $result = Multiroom::send('command=getvoices');
            $this->view->voices = json_decode($result, true);
            $this->view->voice = Module::instance(Multiroom::NAME)->getValue('voice');
        }
    }


    public function action_add() {
        $this->template = 'admin/multiroom/add';
    }

    public function action_library() {
        $this->template = 'admin/multiroom/library';
        $array = Multiroom::getItems();
        //Helper to create nodes
        $tree = $this->tree_node(array('id_files' => '', 'id_parent' => ''), null); //root node
        $map = array("" => &$tree);
        foreach ($array as $cur) {
            $id = $cur['id_files'];
            $parentId = $cur['id_parent'];
            $map[$id] =& $map[$parentId]['children'][];
            $map[$id] = $this->tree_node($cur);
        }

        $array = $this->flatter($tree);
        array_shift($array); //Remove the root node, which was only added as a helper
        $this->view->files = $array;
        $this->view->rooms = Module::instance(Multiroom::NAME)->getValues();
    }

    public function action_platlists() {
        $this->template = 'admin/multiroom/platlists';
        $result = Multiroom::send('command=getplaylists');
        $playlists = json_decode($result, true);
        $this->view->rooms = Module::instance(Multiroom::NAME)->getValues();
        foreach ($playlists as $key => $playlist) {
            $playlists[$key]['songs'] = Multiroom::getSongsByPlaylist($playlist['PlaylistId']);
            $playlists[$key]['Channels'] = explode(",", $playlists[$key]['Channels']);
        }

        $this->view->playlists = $playlists;

    }

    private function tree_node($data) {
        $data['children'] = array();
        return $data;
    }

    private function flatter($node) {
        //Create an array element of the node
        $array_element = $node;
        //Add all children after me
        $result = array($array_element);
        foreach ($node['children'] as $child) {
            $result = array_merge($result, $this->flatter($child));
        }
        return $result;
    }
}
<?php defined('SYSPATH') or die('No direct script access.');


class Controller_Front_Multiroom extends Controller_Front {

    public $template = 'front/multiroom/index';

    public function action_index() {
        $rooms = Module::instance(Multiroom::NAME)->getValues();
        $result = Multiroom::send('command=getplaylists');
        $playlists = json_decode($result, true);
        foreach ($playlists as $key => $playlist) {
            $playlists[$key]['songs'] = Multiroom::getSongsByPlaylist($playlist['PlaylistId']);
            $playlists[$key]['Channels'] = explode(",", $playlists[$key]['Channels']);
        }
        foreach ($rooms as $kr => $room) {
            foreach ($playlists as $key => $playlist) {
                if (in_array($room['channels'], $playlists[$key]['Channels'])) {
                    $rooms[$kr]['playlist'] = $playlist;
                }
            }
        }
        $this->view->rooms = $rooms;
    }

}
{extends "front/pages/index.tpl"}
{block "content"}
    <div class="multiroom-rooms">
        {foreach $rooms as $room}
            <div class="multiroom-room">
                <span class="name">{$room.name}</span>
                <span class="playlist">Плейлист #{$room.playlist.PlaylistId}</span>
                <span class="current">{$room.playlist.Current}</span>
            </div>
        {/foreach}
    </div>
{/block}
{extends "front/pages/index.tpl"}
{block "content"}
    <div class="multiroom-rooms">
        {foreach $rooms as $room}
            <div class="multiroom-room">
                <div class="head">
                    <span class="name">{$room.name}</span>
                    <span class="playlist">Плейлист #{$room.playlist.PlaylistId}</span>
                </div>
                <div class="detail">
                    <span class="current">{$room.playlist.Current}</span>
                    <span class="duration">{$room.playlist.Duration}</span>
                    <span class="position">{$room.playlist.Position}</span>
                    <span class="IsPlaying">{$room.playlist.IsPlaying}</span>
                    <div class="controls">
                        <a href="#" class="{if $room.playlist.IsPlaying}pause{else}play{/if} js-play-pause"></a>
                        <a href="#" class="stop js-stop"></a>
                        <a href="#" class="prev js-prev"></a>
                        <a href="#" class="next js-next"></a>
                        <div class="volume">
                            <a href="#" class="turn-up"></a>
                            <a href="#" class="turn-down"></a>
                        </div>
                    </div>
                </div>
            </div>
        {/foreach}
    </div>
{/block}
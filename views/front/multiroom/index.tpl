{extends "front/pages/index.tpl"}
{block "content"}
    <div class="multiroom-rooms">
        {foreach $rooms as $room}
            <div class="multiroom-room js-room-{$room.channels} js-room" data-id="{$room.channels}"
                 data-playlist="{$room.playlist.PlaylistId}">
                <div class="head">
                    <span class="name">{$room.name}</span>
                    <span class="playlist js-playlist">Плейлист #{$room.playlist.PlaylistId}</span>
                </div>
                <div class="detail">
                    <span class="current js-current-song">{$room.playlist.Current}</span>
                    <small class="js-current-song-full"></small>

                    <div class="tracker js-tracker">
                        <div class="full js-track"
                             style="width: {{$room.playlist.Position/$room.playlist.Duration*100}}%"></div>
                        <span class="duration js-duration">{$room.playlist.Duration|round} сек.</span>
                        <span class="position js-position">{$room.playlist.Position|round} сек.</span>
                    </div>
                    <div class="controls">
                        <a href="#"
                           class="{if $room.playlist.IsPlaying}pause js-pause{else}play js-play-playlist{/if} "></a>
                        <a href="#" class="stop js-stop"></a>
                        <a href="#" class="prev js-prev"></a>
                        <a href="#" class="next js-next"></a>

                        <div class="volume-container js-volume-container">
                            <div class="volume-full js-volume">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        {/foreach}
    </div>
{/block}
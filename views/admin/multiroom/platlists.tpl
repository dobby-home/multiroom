{extends "admin/pages/index.tpl"}
{block "content"}
    <h1>Плейлисты</h1>
    {foreach $playlists as $playlist}
        <h3>Плейлист #{$playlist.PlaylistId}</h3>
        <p>Комнаты:<strong>
            {foreach $playlist.Channels as $channel}
                {foreach $rooms as $room}
                    {if $channel == $room.channels}
                        {$room.name},
                    {/if}
                {/foreach}
            {/foreach}
            </strong>
        </p><ul>
            {foreach $playlist.songs as $song}
                <li>
                    {$song.name}
                </li>
            {/foreach}
        </ul>
    {/foreach}

{/block}
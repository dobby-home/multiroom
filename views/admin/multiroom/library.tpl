{extends "admin/pages/index.tpl"}
{block "content"}
    <h1>Библиотека</h1>
    <a href="#" class="js-multiroom-scan">Сканировать</a>
    <a href="#" class="js-multiroom-stop">Остановить</a>
    {foreach $rooms as $item}
        <label><input type="checkbox" name="room" value="{$item.channels}"> {$item.name}</label>
    {/foreach}
    <table>
        <thead>
        <tr>
            <th></th>
        </tr>
        </thead>
        <tbody>
        {foreach $files as $file}
            <tr>
                <td style="padding-left: {$file.clevel*25}px;">{if $file.is_folder}{$file.name}{else}
                        <a href="#" class="js-play" data-id="{$file.id_files}">{$file.name}</a>{/if}</td>
                <td>{$file.is_directory}</td>
            </tr>
        {/foreach}
        </tbody>
    </table>
{/block}
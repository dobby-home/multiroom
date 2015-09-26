{extends "admin/pages/index.tpl"}
{block "content"}
    <h1>Мультирум</h1>
    <a href="/admin/multiroom/add">Добавить комнату</a>
    <a href="/admin/multiroom/library">Библиотека</a>
    <a href="/admin/multiroom/platlists">Плейлисты</a>
    <table class="table table-bordered">
        <thead>
        <tr>
            <th>Комната</th>
            <th>На латинице</th>
            <th>Каналы</th>
        </tr>
        </thead>
        <tbody>
        {foreach $items as $item}
            <tr>
                <td>{$item.name}</td>
                <td>{$item.engname}</td>
                <td>{$outputs[$item.channels]}</td>
                <td><a href="#" class="js-multiroom-test" data-id="{$item.id}">Тест</a> </td>
                <td><a href="/admin/multiroom/{$item.id}">Ред</a> </td>
            </tr>
        {/foreach}
        </tbody>
    </table>
    <h3>Доступные голоса на сервере</h3>
    <table class="table table-bordered">
    <thead>
    <tr>
        <th>Name</th>
        <th>Culture</th>
        <th>Age</th>
        <th>Gender</th>
        <th>Description</th>
        <th>Id</th>
        <th>Enabled</th>
        <th>Formats</th>
    </tr>
    </thead>
    <tbody>
    {foreach $voices as $item}
        <tr{if $voice == $item.Name} style="background:#000" {/if}>
            <td>{$item.Name}</td>
            <td>{$item.Culture}</td>
            <td>{$item.Age}</td>
            <td>{$item.Gender}</td>
            <td>{$item.Description}</td>
            <td>{$item.Id}</td>
            <td>{$item.Enabled}</td>
            <td><a href="#" data-name="{$item.Name}" class="js-select-voice">Выбрать голос</a> </td>
        </tr>
    {/foreach}
    </tbody>
    </table>
{/block}
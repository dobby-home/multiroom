{extends "admin/pages/index.tpl"}
{block "content"}
    <h1>Мультирум</h1>
    <a href="/admin/multiroom/add">Добавить комнату</a>
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
{/block}
{extends "admin/pages/index.tpl"}
{block "content"}
    <h1>Добавление комнаты</h1>
    <form role="form" action="/ajax/multiroom/add" class="app-module-action">
        <div class="form-group">
            <label for="name">Название комнаты</label>
            <input id="name" name="name" class="form-control required iname" placeholder="Введите название комнаты">
        </div>
        <div class="form-group">
            <label for="address">Название на латинице</label>
            <input id="engname" name="engname" class="required iengname form-control"
                   placeholder="Введите название на латинице">
        </div>
        <div class="form-group">
            <label for="channels">Каналы</label>
            <select class="form-control required ichannels " id="channels" name="channels">
                {foreach $outputs as $key => $output}
                    <option value="{$key}">{$output}</option>
                {/foreach}
            </select>
        </div>
        <button type="submit" class="btn btn-default">Добавить комнату</button>
    </form>
{/block}
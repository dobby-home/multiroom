{extends "admin/pages/index.tpl"}
{block "content"}
    <h1>Редактирование комнаты</h1>
    <form role="form"  action="/ajax/multiroom/edit" class="app-module-action">
        <div class="form-group">
            <label for="name">Название комнаты</label>
            <input id="name" name="name" class="form-control required iname" placeholder="Введите название комнаты"
                   value="{$item.name}">
        </div>
        <div class="form-group">
            <label for="engname">Название на латинице</label>
            <input id="engname" name="engname" class="required iengname form-control"
                   placeholder="Введите название на латинице" value="{$item.engname}">
        </div>
        <div class="form-group">
            <label for="channels">Каналы</label>
            <select class="form-control required ichannels " id="channels" name="channels">
                {foreach $outputs as $key => $output}
                    <option value="{$key}" {if $key == $item.channels}selected="selected" {/if}>{$output}</option>
                {/foreach}
            </select>
        </div>
        <button type="submit" class="btn btn-default">Сохранить</button>
        <input type="hidden" name="id" value="{$item.id}">
    </form>
{/block}
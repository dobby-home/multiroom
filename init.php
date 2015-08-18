<?php defined('SYSPATH') or die('No direct script access.');

Route::set('admin_multiroom', 'admin/multiroom(/<action>)(/<id>)', array('action' => 'add|library', 'id' => '[0-9]+'))
    ->defaults(array(
        'controller' => 'Multiroom',
        'action' => 'index',
        'directory' => 'Admin',
    ));

Route::set('multiroom', 'multiroom(/<action>)')
    ->defaults(array(
        'controller' => 'Multiroom',
        'action' => 'index',
        'directory' => 'Front',
    ));


Dobby::registrationModule(Multiroom::CAPTION, Multiroom::NAME);
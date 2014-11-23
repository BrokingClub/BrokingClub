<?php
Menu::make('MainMenu', function($menu){

    $menu->add('Home', '')->data('icon', 'dashboard');
    $menu->add('Profile', 'profile')->data('icon', 'user');

});

?>
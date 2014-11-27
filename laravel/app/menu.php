<?php
Menu::make('MainMenu', function($menu){

    $menu->add('Dashboard', 'players/' . Player::auth()->id)->data('icon', 'dashboard');
    $menu->add('Profile', 'profile')->data('icon', 'user');
    $menu->add('Stocks', 'stocks')->data('icon', 'line-chart');
    $menu->add('Clubs', 'clubs')->data('icon', 'mortar-board');
    $menu->add('Ranking', 'players')->data('icon', 'users');

});

?>
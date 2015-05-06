<?php
Menu::make('MainMenu', function($menu){

    if(Player::auth())
    $menu->add('Dashboard', 'players/' . Player::auth()->id)->data('icon', 'dashboard');

    $menu->add('Profile', 'profile')->data('icon', 'user');
    $menu->add('Stocks', 'stocks')->data('icon', 'line-chart');
    $menu->add('Clubs', 'clubs')->data('icon', 'mortar-board');
    $menu->add('Ranking', 'players')->data('icon', 'globe');

    if(Player::auth() && Player::auth()->user->role == 'admin') {
        $menu->add('Administrate', 'admin')->data('icon', 'gavel');
        $menu->item('administrate')->add('Users', 'admin/users');
        $menu->item('administrate')->add('Stocks', 'admin/stocks');
    }

});

?>
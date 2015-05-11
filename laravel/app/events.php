<?php


Event::subscribe('BrokingClub\RolePlay\ExperienceDistributor');
Event::subscribe('BrokingClub\RolePlay\LevelManager');
Event::subscribe('BrokingClub\RolePlay\Notifier');

Event::fire('events.created', ['welcome']);
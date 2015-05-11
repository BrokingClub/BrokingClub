<?php


Event::subscribe('BrokingClub\RolePlay\ExperienceDistributor');
Event::subscribe('BrokingClub\RolePlay\LevelManager');

Event::fire('events.created', ['welcome']);
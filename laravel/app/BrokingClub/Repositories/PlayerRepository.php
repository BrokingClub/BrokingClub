<?php
/**
 * Project: BrokingClub | PlayerRepository.php
 * Author: Simon - www.triggerdesign.de
 * Date: 06.05.2015
 * Time: 14:21
 */

namespace BrokingClub\Repositories;


use BrokingClub\Cache\RepositoryCache;
use Player;

class PlayerRepository extends RepositoryCache{

    protected $class = "Player";

}
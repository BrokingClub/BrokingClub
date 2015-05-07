<?php
/**
 * Project: BrokingClub | PlayerRepository.php
 * Author: Simon - www.triggerdesign.de
 * Date: 06.05.2015
 * Time: 14:21
 */

namespace BrokingClub\Repositories;


use Player;

class PlayerRepository {

    /**
     * @param int $id
     * @return \Illuminate\Support\Collection|null|static
     */
    public function findById($id)
    {
        return Player::find($id);
    }


}
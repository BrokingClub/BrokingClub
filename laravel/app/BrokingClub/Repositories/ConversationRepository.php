<?php
/**
 * Project: BrokingClub | ConversationRepository.php
 * Author: Simon - www.triggerdesign.de
 * Date: 08.05.2015
 * Time: 18:54
 */

namespace BrokingClub\Repositories;


use BrokingClub\Cache\RepositoryCache;
use Triggerdesign\Hermes\Models\Conversation;

class ConversationRepository extends RepositoryCache{
    protected $class = "Triggerdesign\\Hermes\\Models\\Conversation";

    /**
     * @param integer $id
     * @param bool $fail
     * @return Conversation
     */
    public function findById($id, $fail = true){

        return parent::findById($id, $fail);
    }
}
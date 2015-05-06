<?php
/**
 * Project: BrokingClub | DatabaseConfigService.php
 * Author: Simon - www.triggerdesign.de
 * Date: 06.05.2015
 * Time: 11:45
 */

namespace BrokingClub\Services;


class DatabaseConfigService {
    private $host;

    private $database;

    private $username;

    private $password;

    public function __construct(){
        $this->host = getenv('DB_HOST');
        $this->database = getenv('DB_DATABASE');
        $this->username = getenv('DB_USERNAME');
        $this->password = getenv('DB_PASSWORD');
    }

    /**
     * @return string
     */
    public function getUsername()
    {
        return $this->username;
    }

    /**
     * @return string
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * @return string
     */
    public function getDatabase()
    {
        return $this->database;
    }

    /**
     * @return string
     */
    public function getHost()
    {
        return $this->host;
    }

} 
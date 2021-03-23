<?php

declare(strict_types = 1);

namespace App\Libraries;

use App\Models\UserModel;
use CodeIgniter\Config\Services;
use CodeIgniter\Session\Session;

/**
 * Class LoginVerification
 * Class for verification if user is logged in
 * @package App\Libraries
 */
class LoginVerification
{
    /**
     * @var Session
     */
    protected Session $session;

    /**
     * @var UserModel
     */
    protected $userModel;

    public function __construct()
    {
        $this->userModel = model('App\Models\UserModel');
        $this->session = Services::session();
    }

    /**
     * Method verify if user is logged in by checking if username and md5 hash of login date exists in database
     *
     * @return bool
     */
    public function verify(): bool
    {
        $sessionUsername = filter_var($this->session->get('log_in_username'), FILTER_SANITIZE_STRING);
        $sessionLogInTime = filter_var($this->session->get('log_in_time'), FILTER_SANITIZE_STRING);
        if (empty($sessionUsername) || empty($sessionLogInTime)) {
            return false;
        }

        $user = $this->userModel->getUserByUsernameAndHashedLogInDate($sessionUsername, $sessionLogInTime);

        if (empty($user)) {
            return false;
        }

        return true;
    }
}

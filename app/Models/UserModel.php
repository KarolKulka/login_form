<?php

namespace App\Models;

use App\Entities\UserEntity;
use CodeIgniter\Model;

class UserModel extends Model
{
    protected $table = 'users';
    protected $primaryKey = 'id';
    protected $returnType = 'App\Entities\UserEntity';
    protected $useSoftDelete = false;
    protected $protectFields = true;
    protected $allowedFields = [
        'username',
        'password',
        'last_log_in',
    ];

    // Dates
    protected $useTimestamps = false;

    /**
     * @param string $username
     * @return array|UserEntity|null
     */
    public function getUserByUsername(string $username)
    {
        return $this->where('username', $username)->first();
    }

    /**
     * @param string $username
     * @param string $sessionlogInTime
     * @return array|UserEntity|null
     */
    public function getUserByUsernameAndHashedLogInDate(string $username, string $sessionLogInTime)
    {
        return $this->where('username', $username)->where('MD5(last_log_in)', $sessionLogInTime)->first();
    }

    /**
     * @param UserEntity $userEntity
     * @throws \ReflectionException
     */
    public function saveUser(UserEntity $userEntity)
    {
        $this->save($userEntity);
    }
}

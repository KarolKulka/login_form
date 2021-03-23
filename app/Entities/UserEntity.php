<?php
declare(strict_types = 1);

namespace App\Entities;

use CodeIgniter\Entity;
use DateTime;

class UserEntity extends Entity
{
    protected $casts = [
        'id' => 'integer'
    ];

    public function getId()
    {
        return $this->attributes['id'];
    }

    /**
     * @return string
     */
    public function getUsername(): string
    {
        return $this->attributes['username'];
    }

    /**
     * @return string
     */
    public function getPassword(): string
    {
        return $this->attributes['password'];
    }

    /**
     * @param string $passwordToVerify
     * @return bool
     */
    public function verifyPassword(string $passwordToVerify): bool
    {
        return password_verify($passwordToVerify, $this->getPassword());
    }

    /**
     * @param bool $formated
     * @return DateTime
     */
    public function getLastLogIn(): DateTime
    {
        return DateTime::createFromFormat('Y-m-d H:i:s', $this->attributes['last_log_in']);
    }

    public function getLastLogInFormated(): string
    {
        return $this->getLastLogIn()->format('Y-m-d H:i:s');
    }

    /**
     * @param DateTime $dateTime
     * @return self
     */
    public function setLastLogIn(DateTime $dateTime = null)
    {
        if (is_null($dateTime)){
            $dateTime = new DateTime();
        }

        $this->attributes['last_log_in'] = $dateTime->format('Y-m-d H:i:s');

        return $this;
    }
}

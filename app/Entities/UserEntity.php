<?php
declare(strict_types = 1);

namespace App\Entities;

use CodeIgniter\Entity;
use DateTime;

/**
 * User entity class
 *
 * @package App\Entities
 */
class UserEntity extends Entity
{
    protected $casts = [
        'id' => 'integer'
    ];

    /**
     * Return user id
     *
     * @return mixed
     */
    public function getId()
    {
        return $this->attributes['id'];
    }

    /**
     * Return user username
     *
     * @return string
     */
    public function getUsername(): string
    {
        return $this->attributes['username'];
    }

    /**
     * Return raw user password hash
     *
     * @return string
     */
    public function getPassword(): string
    {
        return $this->attributes['password'];
    }

    /**
     * Verify is given password equals password from db
     *
     * @param string $passwordToVerify
     * @return bool
     */
    public function verifyPassword(string $passwordToVerify): bool
    {
        return password_verify($passwordToVerify, $this->getPassword());
    }

    /**
     * Returns DateTime object created from last log in field value
     *
     * @return DateTime
     */
    public function getLastLogIn(): DateTime
    {
        return DateTime::createFromFormat('Y-m-d H:i:s', $this->attributes['last_log_in'] ?? date('Y-m-d H:i:s'));
    }

    /**
     * Returns last log in formatted
     *
     * @return string
     */
    public function getLastLogInFormatted(): string
    {
        return $this->getLastLogIn()->format('Y-m-d H:i:s');
    }

    /**
     * Set current time as last log in time
     *
     * @param DateTime|null $dateTime
     * @return self
     */
    public function setLastLogIn(DateTime $dateTime = null): self
    {
        if (is_null($dateTime)){
            $dateTime = new DateTime();
        }

        $this->attributes['last_log_in'] = $dateTime->format('Y-m-d H:i:s');

        return $this;
    }
}

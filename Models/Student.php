<?php

namespace Models;

use SannyTech\App;
use SannyTech\Exceptions\DatabaseException;
use SannyTech\Helper;

#[\AllowDynamicProperties]
class Student extends App
{
    protected static string $dbTable = 'students';
    protected static array $dbFields = array(
        'id', 'name', 'email', 'username', 'password', 'dob', 'gender', 'address',
        'department', 'faculty', 'bio', 'role', 'created_at', 'updated_at'
    );

    public int $id;
    public string $name;
    public string $email;
    public string $username;
    public string $password;
    public mixed $dob;
    public string $gender;
    public string $address;
    public string $department;
    public string $faculty;
    public string $bio;
    public string $role;
    public string $created_at;
    public string $updated_at;

    protected static array $protected = [
        'created_at', 'updated_at', 'password'
    ];


    public function __construct()
    {
      /*  $this->name = '';
        $this->email = '';
        $this->username = '';
        $this->password = '';
        $this->dob = '';
        $this->address = '';
        $this->contact = '';
        $this->department = '';
        $this->faculty = '';
        $this->bio = '';*/
        $this->created_at = date('D, d M Y H:i');
        $this->updated_at = date('D, d M Y H:i');
    }


    /**
     * Get User ID
     * @return int
     */
    public function id(): int
    {
        return $this->id;
    }


    /**
     * Set the modified_at to the current time
     * @return void
     */
    public function modified(): void
    {
        $this->updated_at = date('D, d M Y H:i:s');
    }


    /**
     * Check if the email is already registered
     * @param string $email
     * @return bool
     */
    public function exists(string $email): bool
    {
        global $db;
        try {
            $sql = "SELECT `username` FROM " . static::$dbTable . " WHERE `username` = " . $db->escape($email);
            $db->query($sql);
            return $db->rowCount() > 0;
        } catch (DatabaseException $e) {
            echo $e->getMessage();
        }
        return false;
    }


    /**
     * Grab Client Password
     * @param string $email
     * @return string
     */
    private function grabPassword(string $email): string
    {
        global $db;
        try {
            $sql = "SELECT `password` FROM " . static::$dbTable . " WHERE `username` = " . $db->escape($email);
            $result = $db->query($sql)->fetch();
            if ($db->rowCount() > 0) return $result->password;
        } catch (DatabaseException $e) {
            echo $e->getMessage();
        }
        return "";
    }

    /**
     * Grab Password by Id
     * @param int $id
     * @return string
     */
    public static function grabPasswordById(int $id): string
    {
        global $db;
        try {
            $sql = "SELECT `password` FROM " . static::$dbTable . " WHERE `id` = " . $db->escape($id) . " LIMIT 1";
            $result = $db->query($sql)->fetch();
            if ($db->rowCount() > 0) return $result->password;
        } catch (DatabaseException $e) {
            echo $e->getMessage();
        }
        return "";
    }

    /**
     * Verify Client Password
     * @param string $email
     * @param string|int $password
     * @return bool
     */
    private function checkPassword(string $email, string|int $password): bool
    {
        return $this->verifyPassword($password, $this->grabPassword($email));
    }

    /**
     * Verify if the password is correct
     * @param string|int $password
     * @param string $hash
     * @return bool
     * @example $user->verifyPassword('password');
     */
    private function verifyPassword(string|int $password, string $hash): bool
    {
        return password_verify($password, $hash);
    }

    /**
     * Authenticate User
     * @param string $email
     * @param string|int $password
     * @return bool|object
     * @throws DatabaseException
     */
    public function authenticate(string $email, string|int $password): bool|object
    {
        global $db;
        if ($this->exists($email)) {
            if (!$this->checkPassword($email, $password)) {
                return false;
            }
            try {
                $sql = "SELECT * FROM " . static::$dbTable . " WHERE `username` = " . $db->escape($email);
                $result = $db->query($sql)->fetch();
                return !empty($result) ? $result : false;
            } catch (DatabaseException $e) {
                Helper::productionErrorLog($e, message: "Error Authenticating User");
            }
        }
        return false;
    }
}
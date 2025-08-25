<?php

require_once __DIR__ . '/../../../commons/Connection.php';

class User extends Connection
{
    /**
     * @var string The name of the users table.
     */
    private $table = "users";

    /**
     * Creates a new user in the database.
     *
     * @param array $data An associative array containing user details:
     * 'username', 'email', 'password', and 'type'.
     * @return int The ID of the newly created user, or false on failure.
     */
    public function create($data)
    {
        // Hash the password for security before storing it in the database.
        $hashed_password = password_hash($data['password'], PASSWORD_DEFAULT);

        $stmt = parent::$connection->prepare("INSERT INTO $this->table (
            username, 
            email, 
            password, 
            type
        ) VALUES (?, ?, ?, ?)");

        $stmt->bind_param(
            "ssss",
            $data['username'],
            $data['email'],
            $hashed_password,
            $data['type']
        );

        $stmt->execute();
        return $stmt->insert_id;
    }

    /**
     * Reads all users from the database.
     *
     * @return array An associative array of all users.
     */
    public function readAll($filter = null)
    {
        $query = parent::$connection->query("SELECT id, username, email, type, created_at FROM $this->table ORDER BY id DESC");
        if($filter){
            $query = parent::$connection->query("SELECT id, username, email, type, created_at FROM $this->table WHERE type = '$filter' ORDER BY id DESC");
        }
        return $query->fetch_all(MYSQLI_ASSOC);
    }

    /**
     * Reads a single user by their ID.
     *
     * @param int $id The user's ID.
     * @return array|null An associative array of the user's data, or null if not found.
     */
    public function readById($id)
    {
        $stmt = parent::$connection->prepare("SELECT id, username, email, type, created_at FROM $this->table WHERE id = ?");
        $stmt->bind_param("i", $id);
        $stmt->execute();
        return $stmt->get_result()->fetch_assoc();
    }

    /**
     * Reads a single user by their email. This is useful for login.
     *
     * @param string $email The user's email.
     * @return array|null An associative array of the user's data, or null if not found.
     */
    public function readByEmail($email)
    {
        $stmt = parent::$connection->prepare("SELECT id, username, email, password, type, created_at FROM $this->table WHERE email = ?");
        $stmt->bind_param("s", $email);
        $stmt->execute();
        return $stmt->get_result()->fetch_assoc();
    }

    /**
     * Updates a user's details.
     *
     * @param int $id The user's ID.
     * @param array $data An associative array with fields to update.
     * @return bool True on success, false on failure.
     */
    public function update($id, $data)
    {
        $sql = "UPDATE $this->table SET username = ?, email = ?, type = ? WHERE id = ?";
        $stmt = parent::$connection->prepare($sql);

        $stmt->bind_param(
            "sssi",
            $data['username'],
            $data['email'],
            $data['type'],
            $id
        );

        return $stmt->execute();
    }

    public function readApplication($u_id)
    {
        $stmt = parent::$connection->prepare("SELECT * FROM applications WHERE user_id = ?");
        $stmt->bind_param("i", $u_id);
        $stmt->execute();
        return $stmt->get_result()->fetch_assoc();
    }

    public function readRequestForm($u_id)
    {
        $stmt = parent::$connection->prepare("SELECT * FROM employee_req_form WHERE user_id = ?");
        $stmt->bind_param("i", $u_id);
        $stmt->execute();
        return $stmt->get_result()->fetch_assoc();
    }

    /**
     * Deletes a user from the database.
     *
     * @param int $id The user's ID.
     * @return bool True on success, false on failure.
     */
    public function delete($id)
    {
        $stmt = parent::$connection->prepare("DELETE FROM $this->table WHERE id = ?");
        $stmt->bind_param("i", $id);
        return $stmt->execute();
    }

    public function search($kw)
    {
        $kw = '%' . $kw . '%';
        $stmt = parent::$connection->prepare("
        SELECT id, username, email, type, created_at 
        FROM $this->table 
        WHERE username LIKE ? OR email LIKE ? 
        ORDER BY id DESC
    ");
        $stmt->bind_param('ss', $kw, $kw);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_all(MYSQLI_ASSOC);
    }


    /**
     * Handles user login by verifying the email and password.
     *
     * @param string $email The user's email.
     * @param string $password The user's plain-text password.
     * @return array|false The user's data if login is successful, otherwise false.
     */
    public function login($email, $password)
    {
        $user = $this->readByEmail($email);
        if ($user && password_verify($password, $user['password'])) {
            // Remove the hashed password before returning the user data
            unset($user['password']);
            return $user;
        }
        return false;
    }
}

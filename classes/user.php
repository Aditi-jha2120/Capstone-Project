<?php


class User
{
    private $db;

    public function __construct(PDO $conn)
    {
        $this->db = $conn;
    }

    public function create_user($data)
    {

        $first_name = $data["first_name"];
        $last_name = $data["last_name"];
        $email = $data["email"];

        // Hash Password

        $password = password_hash($data["password"], PASSWORD_BCRYPT);

        $stmt = $this->db->prepare("INSERT INTO users (first_name, last_name, email, password) VALUES (:first_name, :last_name, :email, :password)");
        $stmt->bindParam(':first_name', $first_name);
        $stmt->bindParam(':last_name', $last_name);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':password', $password);

        $stmt->execute();


        // Get the ID of the last inserted record
        $lastInsertedId = $this->db->lastInsertId();

        $stmt = $this->db->prepare("SELECT * FROM users WHERE id = :id");
        $stmt->bindParam(':id', $lastInsertedId);
        $stmt->execute();

        $user = $stmt->fetch();

        // 
        return $user;

    }



    public function find_user($data)
    {

        $email = $data["email"];
        $password = $data["password"];

        $stmt = $this->db->prepare("SELECT * FROM users WHERE email = :email");
        $stmt->bindParam(':email', $email);

        $stmt->execute();

        $user = $stmt->fetch();

        // User exists
        if (!$user) {
            return false;
        }

        // Password matches
        
        if (password_verify($password, $user['password'])) {
            return $user;
        }

        return false;

    }

    


}

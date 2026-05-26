<?php
require_once __DIR__ . '/../config/config.php';

class UserModel {

    private $pdo;

    public function __construct() {
        global $pdo;
        $this->pdo = $pdo;
    }

    public function register($nom, $prenom, $username, $password) {
        $hash = password_hash($password, PASSWORD_DEFAULT);
        $sql = "INSERT INTO users (nom, prenom, username, password)
                VALUES (:nom, :prenom, :username, :password)";
        $stmt = $this->pdo->prepare($sql);
        return $stmt->execute([
            'nom' => $nom,
            'prenom' => $prenom,
            'username' => $username,
            'password' => $hash
        ]);
    }

    public function getUserByUsername($username) {
        $sql = "SELECT * FROM users WHERE username = :username LIMIT 1";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute(['username' => $username]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
    
    public function addcontact($firstname, $lastname, $mail, $number) {
        $sql = "INSERT INTO contact(firstname, lastname, mail, number)
                VALUES (:firstname, :lastname, :mail, :number)";
        $stmt = $this->pdo->prepare($sql);
        return $stmt->execute([
            'firstname' => $firstname,
            'lastname' => $lastname,
            'mail' => $mail,
            'number' => $number]);


    }
    
    };
<?php

include_once ("Db.class.php");

class User{

    private $username;
    private $password;
    private $email;

    /**
     * @return mixed
     */
    public function getUsername()
    {
        return $this->username;
    }

    /**
     * @param mixed $username
     */
    public function setUsername($username)
    {
        $this->username = $username;
    }

    /**
     * @return mixed
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * @param mixed $password
     */
    public function setPassword($password)
    {
        if (strlen($password)<6) {
            throw new Exception('Password must be at least 6 characters long!');
        }

        $this->password = $password;
    }

    /**
     * @return mixed
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * @param mixed $email
     */
    public function setEmail($email)
    {
        $this->email = $email;
    }


    public function register(){

        $conn = Db::getInstance();

        $options = [
            'cost' => 12
        ];

        $statementCheck = $conn->prepare("SELECT * FROM users WHERE email = :email;");
        $statementCheck->bindValue(':email', $this->email);
        $statementCheck->execute();
        $statementCheck->fetch(PDO::FETCH_ASSOC);

        $statementCheck2 = $conn->prepare("SELECT * FROM users WHERE username = :username;");
        $statementCheck2->bindParam(':username', $this->username);
        $statementCheck2->execute();
        $statementCheck2->fetch(PDO::FETCH_ASSOC);

        if ($statementCheck->rowCount() !== 0) {
            throw new Exception('Email already used');
        }

        else if($statementCheck2->rowCount() !== 0){
            throw new Exception('Username already used');
        }

        else{
            $statement = $conn->prepare("insert into users (username, password, email) values (:username, :password, :email)");

            $hash = password_hash($this->password, PASSWORD_BCRYPT, $options);

            $statement->bindParam(":username", $this->username);
            $statement->bindParam(":email", $this->email);
            $statement->bindParam(":password", $hash);

            $statement->execute();

            session_start();
            header("Location: index.php");
        }



    }
}


?>
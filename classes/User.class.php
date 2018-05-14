<?php

include_once ("Db.class.php");

class User{

    protected $username;
    protected $password;
    protected $email;
    protected $firstname;
    protected $lastname;
    protected $imageUrl = "http://earthharmonyfestival.org/view/modules/imgoing/img/editor/empty-profile.jpg";

    /**
     * @return string
     */
    public function getImageUrl()
    {
        return $this->imageUrl;
    }

    /**
     * @param string $imageUrl
     */
    public function setImageUrl($imageUrl)
    {
        $this->imageUrl = $imageUrl;
    }

    /**
     * @return mixed
     */
    public function getFirstname()
    {
        return $this->firstname;
    }

    /**
     * @param mixed $firstname
     */
    public function setFirstname($firstname)
    {
        $this->firstname = $firstname;
    }

    /**
     * @return mixed
     */
    public function getLastname()
    {
        return $this->lastname;
    }

    /**
     * @param mixed $lastname
     */
    public function setLastname($lastname)
    {
        $this->lastname = $lastname;
    }

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
            $statement = $conn->prepare("insert into users (firstname, lastname, username, password, email) values (:firstname, :lastname, :username, :password, :email)");

            $hash = password_hash($this->password, PASSWORD_BCRYPT, $options);
            $statement->bindParam(":firstname", $this->firstname);
            $statement->bindParam(":lastname", $this->lastname);
            $statement->bindParam(":username", $this->username);
            $statement->bindParam(":email", $this->email);
            $statement->bindParam(":password", $hash);

            $statement->execute();

            session_start();
            $_SESSION['user'] = $this->getUsername();
            header("Location: index.php");
        }



    }

    public function Login(){
        $conn = Db::getInstance();

        $statement = $conn->prepare("select * from users where username = :username");
        $statement->bindValue(':username', $this->username);
        $statement->execute();

        $res = $statement->fetch();
        if (password_verify($this->getPassword(), $res['password'])) {
            session_start();
            $_SESSION['user'] = $this->getUsername();
            header("Location: index.php");
        } else {
            throw new Exception('Invalid username or password');
        }
    }

    public function getProfile(){
        $conn = Db::getInstance();

        $statement = $conn->prepare("SELECT * FROM users WHERE username = :username;");
        $statement->bindValue(':username', $this->username);
        $statement->execute();
        return $result = $statement->fetch(PDO::FETCH_ASSOC);
    }

    public function updateProfile($oldEmail){
        $conn = Db::getInstance();

        if (isset($this->password)) {
            $options = [
                'cost' => 12
            ];

            $hashpassword = password_hash($this->getPassword(), PASSWORD_DEFAULT, $options);

            $update = $conn ->prepare("UPDATE users SET username = :username, firstname = :firstname, lastname = :lastname,password = :password, email = :email WHERE email = :oldEmail");
            $update->bindValue(':firstname', $this->getFirstName());
            $update->bindValue(':lastname', $this->getLastName());
            $update->bindValue(':username', $this->getUsername());
            $update->bindValue(':password', $hashpassword);
            $update->bindValue(':email', $this->getEmail());
            $update->bindValue(':oldEmail', $oldEmail);
        }else {
            $update = $conn->prepare("UPDATE user SET username = :username, firstname = :firstname, lastname = :lastname, email = :email WHERE email = :oldEmail");
            $update->bindValue(':firstname', $this->getFirstName());
            $update->bindValue(':lastname', $this->getLastName());
            $update->bindValue(':username', $this->getUsername());
            $update->bindValue(':email', $this->getEmail());
            $update->bindValue(':oldEmail', $oldEmail);
        }

        return $update->execute();

    }

    public function changePicture(){
        $conn = Db::getInstance();

        $update = $conn->prepare("UPDATE users SET imageUrl = :imageUrl WHERE email = :email");
        $update->bindValue(':imageUrl', $this->imageUrl);
        $update->bindValue(':email', $this->email);
        return $update->execute();
    }
}


?>
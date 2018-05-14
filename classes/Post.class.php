<?php


class Post{

    protected $userID;
    protected $postImageUrl;
    protected $postDescription;

    /**
     * @return mixed
     */
    public function getUserID()
    {
        return $this->userID;
    }

    /**
     * @param mixed $userID
     */
    public function setUserID($userID)
    {
        $this->userID = $userID;
    }

    /**
     * @return mixed
     */
    public function getPostImageUrl()
    {
        return $this->postImageUrl;
    }

    /**
     * @param mixed $postImageUrl
     */
    public function setPostImageUrl($postImageUrl)
    {
        $this->postImageUrl = $postImageUrl;
    }

    /**
     * @return mixed
     */
    public function getPostDescription()
    {
        return $this->postDescription;
    }

    /**
     * @param mixed $postDescription
     */
    public function setPostDescription($postDescription)
    {
        $this->postDescription = $postDescription;
    }


    public function addPost(){
        $conn = Db::getInstance();

        $statementPosts = $conn->prepare("INSERT INTO posts (postImageUrl, postDescription, userID) VALUES (:postImageUrl, :postDescription, :userID)");

        $statementPosts->bindValue(":postImageUrl", $this->postImageUrl);
        $statementPosts->bindValue(":postDescription", $this->postDescription);
        $statementPosts->bindValue(":userID", $this->userID);

        $statementPosts->execute();
        header("Location: index.php");
    }

}
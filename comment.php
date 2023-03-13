<?php
session_start();
class comment
{
    private $name;
    private $message;
    private $date;
    function __construct($name, $message){
        $this->name = $name;
        $this->message = $message;
        $this->date = date("Y-m-d H:i:s");
    }
    function get_name(){
        return $this->name;
    }
    function get_message(){
        return $this->message;
    }
    function get_date(){
        return $this->date;
    }
    function __destruct(){ }

    public function addcomment($obj){
        try {
            $servername = "studentmysql.miun.se"; $username = "jojo2109"; $password = "svjyg9gn"; $dbname = "jojo2109";
            $conn = new PDO("mysql:host=$servername; dbname=$dbname", $username, $password);
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            echo "Connected successfully";

            // Prepare sql and bind parameters
            $stmt = $conn->prepare('INSERT INTO Comments (name, message, date) VALUES (:name, :message, :date)');
            $stmt->bindParam(':name', $new_user);
            $stmt->bindParam(':message', $new_message);
            $stmt->bindParam(':date', $lastlogin);

            // Insert row
            $new_user = $_REQUEST['namn'];
            $new_message = $_REQUEST['meddelande'];
            $lastlogin = date("Y-m-d H:i");
            $stmt->execute();

            // Close db connection and unset add
            $conn = null;
            unset($_REQUEST['submit']);
            header('Location: index.php');

        } catch (PDOException $e) {
            echo $e->getMessage();
        }

    }

    public function deleteComment($index)
    {
        try {
            $servername = "studentmysql.miun.se"; $username = "jojo2109"; $password = "svjyg9gn"; $dbname = "jojo2109";

            $conn = new PDO("mysql:host=$servername; dbname=$dbname", $username, $password);
            // Set PDO error mode to exception
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            // Prepare sql and bind parameters
            $stmt = $conn->prepare('DELETE FROM Comments WHERE id = :id');
            $postid = $index;
            $stmt->bindParam(':id', $postid);
            //$stmt = $conn->prepare('ALTER TABLE Comments AUTO_INCREMENT = 1;');
            $stmt->execute();
            unset($_REQUEST['radera']);
            // Close db connection and unset add
            $conn = NULL;

            header('Location: index.php');
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }


}
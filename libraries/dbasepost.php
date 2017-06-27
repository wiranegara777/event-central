<?php
class Database{
    public $host = DB_HOST;
    public $username = DB_USER;
    public $password = DB_PASS;
    public $db_name = DB_NAME;

    public $link;
    public $error;

    //Class Construct
    public function __construct(){
      //call Connect function
      $this->connect();
    }

    //connect
    private function connect(){
      $this->link = new mysqli($this->host,$this->username,$this->password,$this->db_name);
      if(!$this->link){
        $this->error = "Connection Failed: ".$this->link->connection_error;
        return false;
      }
    }

    //select
    public function select($query){
       $result = $this->link->query($query) or die($this->link->error.__LINE__);
       if($result->num_rows > 0){
         return $result;
       } else{
          return false;
       }
    }

    //Insert
    public function insert($query){
        $insert_row = $this->link->query($query) or die($this->link->error.__LINE__);

        //validate insert
        if($insert_row){
            $id = $_GET['id'];
            //echo '<a href="post.php?id='.$id.'">Berhasil</a>';
            echo'<div class="w3-panel w3-green w3-round">
              <center><h3><a style="text-decoration:none;" href="post.php?id='.$id.'">Anda telah terdaftar dalam Event ini! :)</a></h3>
              </center>
                </div>';
           echo '<img style="width:100%;" src="images/event2.jpg">' ;

            exit();
        } else {
            die('Error : ('. $this->link->error .')'. $this->link->error);
        }
    }

    //update
    public function update($query){
        $update_row = $this->link->query($query) or die($this->link->error.__LINE__);

        //validate insert
        if($update_row){
            header("Location: index.php?msg=".urlencode('Record Updated'));
            exit();
        } else {
            die('Error : ('. $this->link->error .')'. $this->link->error);
        }
    }

    //delete
    public function delete($query){
        $delete_row = $this->link->query($query) or die($this->link->error.__LINE__);

        //validate insert
        if($delete_row){
            header("Location: index.php?msg=".urlencode('Record Deleted'));
            exit();
        } else {
            die('Error : ('. $this->link->error .')'. $this->link->error);
        }
    }
}


 ?>

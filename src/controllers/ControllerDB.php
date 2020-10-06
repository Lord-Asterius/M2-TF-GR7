<?php

class ControllerDB {

    public $ip_server;
    public $user;
    public $password;
    public $db_name;
    public $cnx;

    function __construct() {
        $this->ip_server = "localhost";
        $this->user = "root";
        $this->password = "password";
        $this->db_name = "qui_est_la";
    }

    function connect() {

        $this->cnx = mysqli_connect($this->ip_server, $this->user, $this->password);

        if (mysqli_select_db($this->cnx, $this->db_name)) {
            //die("conected");
            return TRUE;
        } else{
          //  die("not conected");
            return FALSE;
        }            
    }

    function query($sql) {
              
        $result = mysqli_query($this->cnx, $sql);
     
        if(is_object($result))
            $result = $result->fetch_all(MYSQLI_ASSOC);

        return $result;
    }

    function get_last_id(){
        $id = mysqli_insert_id($this->cnx);

        return $id;
    }

    function close() {
        mysqli_close($this->cnx);
    }

}

?>
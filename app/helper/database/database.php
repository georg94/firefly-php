<?php
// - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -
//     _____ _           __ _             ____  _   _ ____      \\
//    |  ___(_)_ __ ___ / _| |_   _      |  _ \| | | |  _ \     \\
//    | |_  | | '__/ _ \ |_| | | | |_____| |_) | |_| | |_) |    \\
//    |  _| | | | |  __/  _| | |_| |_____|  __/|  _  |  __/     \\
//    |_|   |_|_|  \___|_| |_|\__, |     |_|   |_| |_|_|        \\
//                         |___/                                \\
//    -----------------------------------------------------     \\
//    Author: singh aka jba@derpunkt.de                         \\
//    Info: System Helper to manage database connections        \\
// - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -

class database {
    
    private $con ;
    
    public function connect() {
        $this->con = mysqli_connect(conf::get("__DB_HOST"), conf::get("__DB_USER"),conf::get("__DB_PWD")) or die(mysql_error());
        mysqli_select_db($this->con , conf::get("__DB_NAME")) or die(mysql_error());
        return true;
    }
    
    public function query($query,$arrInput = false) {
        //check for escapeable input
        if(is_array($arrInput)) {
            $arrQuery = explode("?",$query);
            if(count($arrQuery) == (count($arrInput)+1)) {
                $tmp="";
                for($i=0;$i<count($arrInput);$i++) {
                    $tmp.=$arrQuery[$i].mysqli_real_escape_string($arrInput[$i]);
                }
                $query=$tmp.$arrQuery[$i];
            } else {
                echo "~~sql qry form/param error~~";
                return false;
            }
        }
        return mysqli_query($query,$this->con);
    }
    
    public function fetch($result){
        if($result){
            $arrReturn = array();
            while($row = mysqli_fetch_array($result)){
                $arrReturn[] = $row;
            }
            return $arrReturn;
        } else {
            return false;
        }
    }
    
    public function getInsertId(){
        return mysqli_insert_id($this->con);
    }
    
    public function disconnect() {
        if($this->con) {
            mysqli_close($this->con);
        } else {
            echo "~~nothing to close here~~";
        }
    }
    
}

?>
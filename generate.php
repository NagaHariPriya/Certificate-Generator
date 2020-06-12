<?php
ob_start();
session_start();

if (isset($_POST['btnsubmit'])) {
    $email = strtolower(trim($_POST['email']));
	$event=strtolower(trim($_POST['event']));
//   echo $user . " - " . $user_type . " - " . $pass;
    if ($email != "" and $event != "") {
        require_once 'app/dbfile.php';
        $obj = new Database();
        $obj->connect();
        $table = "data";
         $where = "LCASE(email)='$email' AND LCASE(event)= '$event'";
        $obj->select($table, " * ",$where);
        $res = $obj->getResult();
        //id, uname, name, rno, passw, email, dob, phno, type, cdate, rec_status
        $a = 0;
       if ($res){
            $id = $res[$a]['id'];
			$event3=$res[$a]['event'];
         header("location: down?certificate=$id&attend=$event3");
        } 
        else {
            header("Location: index?sorry");
        }
    }
       else {
            header("Location: index?sorry=0&opt=1");
        }
   
}


?>

<?php
require_once ( __DIR__ . '/helper_functions.php');
require_once('db_con.php');
require_once('class.crud.php');

if(isset($_REQUEST['id'])) {

    if($db->deleteData($_REQUEST['id'],"student")){

    echo"Your Data Successfully Deleted";
}

}
?>



<?php
require_once ( __DIR__ . '/helper_functions.php');
require_once('db_con.php');
require_once('class.crud.php');
require_once 'header.php';
?>

    <div class="container-fluid">
    <div class="row">

        <h3 class="text-center">All Students List</h3>
        <hr>

    <div class="col-md-12">
    <table class="table table-bordered table-condensed">
    <thead>
    <tr class="success">
        <th>Name</th>
        <th>class</th>
        <th>date of birth</th>
        <th>subjects</th>
        <th>address</th>
        <th>department</th>
        <th>Action</th>
    </tr>
    </thead>
        <tbody>

    <?php
    $db = new CRUD();
    foreach($db->showData('student') as $value) {

        echo '<tr class="success">';
        echo '<td>'.$value['name'].'</td>';
        echo '<td>'.$value['class'].'</td>';
        echo '<td>'.$value['dob'].'</td>';
        // echo '<td>'.$value['id'].'</td>';
        $sID = $value['id'];


        echo '<td>';
        print_r(  getStudentSubjects( $sID ));
       
        echo '</td>';


        echo '<td>'.$value['address'].'</td>';
        echo '<td>'.$value['department'].'</td>';

        echo '<td><a href="update.php?id=' . $value['id'] . '" class="btn btn-info" style="width:70px;">Edit</a>
                      <a href="delete.php?id=' . $value['id'] . '" class="btn btn-danger" style="width:70px;">Delete</a></td>';
        echo '</tr>';

    }
    ?>
        </tbody>
</table>
    </div>
    </div>
    </div>

<?php
require_once 'footer.php';
?>
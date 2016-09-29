<?php 
require_once ( __DIR__ . '/vendor/autoload.php');
require_once ( __DIR__ . '/db.config.php');
require_once ('header.php');


use Illuminate\Database\Capsule\Manager as DB;
  $data  = DB::table('student')->update(['name' => 'a']);
  dd($data);
  exit;


if (isset($_POST['submit'])) {
    
    $name       = $_POST['s_name'];
    $class      = $_POST['class'];
    $dob        = $_POST['year'] .'-'. $_POST['month'] .'-'. $_POST['day'];
    $address    = $_POST['address'];
    $department = $_POST['department'];
    $subject    = $_POST['subjects'];

$student = [ 
    'user_id'   =>  1, 
    'name'      =>  $name, 
    'class'     =>  $class, 
    'dob'       =>  $dob, 
    'address'   =>  $address, 
    'department'=>  $department,
];

$studentID = save( 'student', $student);


$subjects =  [ 'studentID' => $studentID, 'subjectID' => $subject   ];

$data  = DB::table('subjects')->save(subjects => 'a']);
//save( 'subjects', $subjects);
}

?>

<div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <h3 class="text-center">
                    Student Registration Form
                </h3>
                <hr>

                <form class="form-horizontal" action="" method="post">
                    <fieldset>

                        <div class="form-group">

                            <!-- Text input-->
                            <label class="col-md-4 control-label" for="input01">Name</label>
                            <div class="col-md-4">
                                <input type="text" placeholder="" class="form-control input-md" name="s_name">
                                <p class="help-block"></p>
                            </div>
                        </div>

                        <div class="form-group">

                            <!-- Select Basic -->
                            <label class="col-md-4 control-label">Class</label>
                            <div class="col-md-4">
                                <select class="form-control input-md" name="class">
                                    <option>Enter</option>
                                    <option>Your</option>
                                    <option>Options</option>
                                    <option>Here!</option></select>
                            </div>

                        </div>


                        <div class="form-group">

                            <!-- Select Basic -->
                            <label class="col-md-4 control-label">DOB</label>
                            <div class='col-md-8'>
                                <div class="col-md-2">
                                    <select name="day" class="form-control input-md" name="day">
                                        <option>DD</option>
                                        <?php echo dropdown(1, 31); ?>
                                    </select>
                                </div>
                                <div class="col-md-2">
                                    <select class="form-control input-md" name="month">
                                        <option>MM</option>
                                        <?php echo dropdown(1, 12); ?>
                                    </select>
                                </div>

                                <div class="col-md-2">
                                    <select class="form-control input-md" name="year">
                                        <option>YYYY</option>
                                        <?php echo dropdown(1990, 2000, 1, 1997); ?>
                                    </select>
                                </div>

                            </div>

                        </div>

                        <div class="form-group">
                            <label class="col-md-4 control-label">Subjects</label>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <div class="checkbox">
                                        <?php echo subjects(); ?>
                                    </div>
                                </div>
                            </div>

                        </div>

                        <div class="form-group">

                            <!-- Textarea -->
                            <label class="col-md-4 control-label">Address</label>
                            <div class="col-md-4">
                                <div class="textarea">
                                    <textarea class="form-control" name="address"> </textarea>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">

                            <!-- Select Basic -->
                            <label class="col-md-4 control-label">Department</label>
                            <div class="col-md-4">
                                <select class="form-control input-md" name="department">
                                    <option>Enter</option>
                                    <option>Your</option>
                                    <option>Options</option>
                                    <option>Here!</option></select>
                            </div>

                        </div>
                        <br>
                        <input type="submit" name="submit" value="submit" style="width:100px; padding:10px;" class="btn btn-primary center-block">

                    </fieldset>
                </form>

            </div>
        </div>
    </div>
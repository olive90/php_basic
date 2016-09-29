<?php

// numeric_dropdown




function dropdown($i=0,$end=12,$incr=1,$selected=0){	
    $option = '';
    for($i; $i <= $end; $i+=$incr) {
            
            $option .= '<option';
            $option .= ( $selected == $i) ? ' selected' : '';
            $option .= '>'.  sprintf('%02d', $i ) .'</option>';	
    }
    return $option;
}


function subjects( $checked = [], $return_type = 'Checkbox'){	
    $subjects = [
        1 => 'English',
        2 => 'Bangla',
        3 => 'Math',
        4 => 'Account',
        5 => 'Physics'
    ];
    $checkbox = '';
    $comman = array();
    if($return_type == 'Comma'){
        foreach( $subjects as $key=>$subject ){
            if(in_array($key, $checked)) {
               $comman[]  =  $subject;
            } 
        }
    $checkbox  =  implode(', ', $comman);

    } else {
        foreach($subjects as $key=>$subject){
            $checkbox .= '<label class="checkbox">';
            $checkbox .= '<input type="checkbox" name="subjects[]" ';
            $checkbox .= (in_array($key, $checked)) ? 'checked="checked"' : '';
            $checkbox .= 'value="'. $key .' ">';
            $checkbox .= $subject . '</label>';
        }
    }


   
           
    return $checkbox;
}


function insertSubject($studentID = 0, $subjects = array()){
    
    if($studentID){
        foreach($subjects as $subjectID){
            //print_r( $subjectID );
            insertSingleSubject($studentID, $subjectID);
        }
    }   
}


function insertSingleSubject($studentID = 0, $subjectID = 0){
    
    if( $studentID == 0 or  $subjectID  == 0){
        return false;
    }
    
    $db = new CRUD();
    $db->query("INSERT INTO `subjects` SET"
            . "`studentID` = :studentID,"
            . "`subjectID` = :subjectID");
    
    $db->bind(':studentID', $studentID);
    $db->bind(':subjectID', $subjectID);
    $db->execute();  
    return true;
}


function getStudentSubjects($studentID = 0){
    
    if( $studentID == 0){
        return false;
    }
    
    $db = new CRUD();
    $data = $db->get_results("SELECT * FROM `subjects`  WHERE `studentID` = $studentID");        
    $array  = [];
    
    foreach($data as $row ){
        $array[] = $row->subjectID; 
   }
   return subjects( $array, 'Comma') ;
}


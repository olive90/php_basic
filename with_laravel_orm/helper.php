<?php

use Illuminate\Database\Capsule\Manager as DB;


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

function save($table = 'student', $array = array(), $primary_id = 0) {


    if (empty($array)) {
        return 'Invalide Array';
    } else {

        if ($primary_id) {
            return update($table, $array, $primary_id);
        } else {
            return insert($table, $array);
        }
    }
}

function insert($table, $data = array()) {

    if (count($data) == count($data, COUNT_RECURSIVE)) {
        $db = DB::table($table)->insertGetId($data);    
    } else {
        DB::table($table)->insert($data);          
        $db = true;
    }
    return $db;
}

function update($table, $data = array(), $primary_id = 0) {
    DB::table($table)
            ->where('id', $primary_id)
            ->update($data);
    return true;
}


function saveMailLog( $data = ''){        
    $file = __DIR__ . '/mail_log/'. date('Y-m-d-H-i-s_') . rand( 0, 1000 ) .'.txt';    
    file_put_contents($file, $data);        
}

<?php

//$rows=all('students',['dept'=>'3']);
//$row=find('students',10);
//$row=find('students',['dept'=>'1','graduate_at'=>'23']);
//$rows=all('students',['dept'=>'1','graduate_at'=>'23']);
//echo "<h3>相同條件使用find()</h3>";
//dd($row);
//echo "<hr>";;
//echo "<h3>相同條件使用all()</h3>";
//dd($rows);
//insert('dept',['code'=>'112','name'=>'織品系']);
//$up=update("students",'3',['dept'=>'16','name'=>'張明珠']);
//$up=update("students",['dept'=>2,'status_code'=>'001'],['dept'=>'99','name'=>'張明珠']);

//呼叫 del()函式，傳送資料表參數 $table='students'，
//傳送條件式參數($id)為陣列(所以用[]包住)，陣列的key='dept'、'status_code', 陣列的value=5、'001'
del('students',['dept'=>5,'status_code'=>'001']);

//dd($up);
function all($table=null,$where='',$other=''){
    $dsn="mysql:host=localhost;charset=utf8;dbname=school";
    $pdo=new PDO($dsn,'root','');
    $sql="select * from `$table` ";
    
    if(isset($table) && !empty($table)){

        if(is_array($where)){
            /**
             * ['dept'=>'2','graduate_at'=>12] =>  where `dept`='2' && `graduate_at`='12'
             * $sql="select * from `$table` where `dept`='2' && `graduate_at`='12'"
             */
            if(!empty($where)){
                foreach($where as $col => $value){
                    $tmp[]="`$col`='$value'";
                }
                $sql .= " where ".join(" && ",$tmp);
            }
        }else{
            $sql .=" $where";
        }

            $sql .=$other;
        echo 'all=>'.$sql;
        $rows=$pdo->query($sql)->fetchAll(PDO::FETCH_ASSOC);
        return $rows;
    }else{
        echo "錯誤:沒有指定的資料表名稱";
    }
}


function find($table,$id){
    $dsn="mysql:host=localhost;charset=utf8;dbname=school";
    $pdo=new PDO($dsn,'root','');
    $sql="select * from `$table` ";

    if(is_array($id)){
        foreach($id as $col => $value){
            $tmp[]="`$col`='$value'";
        }
        $sql .=" where ".join(" && ",$tmp);
    }else if(is_numeric($id)){
        $sql .= " where `id`='$id'";
    }else{
        echo "錯誤:參數的資料型態比須是數字或陣列";
    }
    echo 'find=>'.$sql;
    $row=$pdo->query($sql)->fetch(PDO::FETCH_ASSOC);
    return $row;
}

function update($table,$id,$cols){
    $dsn="mysql:host=localhost;charset=utf8;dbname=school";
    $pdo=new PDO($dsn,'root','');

    $sql="update `$table` set ";

    if(!empty($cols)){
        foreach($cols as $col => $value){
            $tmp[]="`$col`='$value'";
        }
    }else{
        echo "錯誤:缺少要編輯的欄位陣列";
    }

    $sql .= join(",",$tmp);
    $tmp=[];
    if(is_array($id)){
        foreach($id as $col => $value){
            $tmp[]="`$col`='$value'";
        }
        $sql .=" where ".join(" && ",$tmp);
    }else if(is_numeric($id)){
        $sql .= " where `id`='$id'";
    }else{
        echo "錯誤:參數的資料型態比須是數字或陣列";
    }
    echo $sql;
    return $pdo->exec($sql);
}

function insert($table,$values){
    $dsn="mysql:host=localhost;charset=utf8;dbname=school";
    $pdo=new PDO($dsn,'root','');

    $sql="insert into `$table` ";
    $cols="(`".join("`,`",array_keys($values))."`)";
    $vals="('".join("','",$values)."')";
    
    $sql=$sql . $cols ." values ".$vals;
    
    //echo $sql;

    return $pdo->exec($sql);
}

function del($table,$id){
    $dsn="mysql:host=localhost;charset=utf8;dbname=school";
    $pdo=new PDO($dsn,'root','');
    $sql="delete from `$table` where ";

    if(is_array($id)){
        foreach($id as $col => $value){
            $tmp[]="`$col`='$value'";
        }
        $sql.= join(" && ",$tmp);

    }else if(is_numeric($id)){
        $sql .= " `id`='$id'";
    }else{
        echo "錯誤:參數的資料型態比須是數字或陣列";
    }
    echo $sql;

    return $pdo->exec($sql);
}

 function dd($array){
     echo "<pre>";
     print_r($array);
     echo "</pre>";
 }
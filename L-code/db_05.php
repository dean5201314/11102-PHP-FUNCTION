<?php

$rows=all('students',['dept'=>'3']);
$row=find('students',10);
// $sql="select * from `$table` ";

echo 'find=>';
dd($row);
echo '<hr>';
echo 'all=>';
dd($rows);
function all($table=null,$where='',$other=''){
    $dsn="mysql:host=localhost;charset=utf8;dbname=school";
    $pdo=new PDO($dsn,'root','');
    // $sql="select * from `$table` ";
    
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
        //echo $sql;
        echo 'all=>'.$sql.'<br>';
        $rows=$pdo->query($sql)->fetchAll(PDO::FETCH_ASSOC);
        return $rows;
    }else{
        echo "錯誤:沒有指定的資料表名稱";
    }
}

function find($table,$id){
    $dsn="mysql:host=localhost;charset=utf8;dbname=school";
    $pdo=new PDO($dsn,'root','');
    // $sql="select * from `$table` where `id`='$id'";
    // $sql="select * from `$table`";

    if (is_array($id)) {
        foreach($id as $col => $value){
            $tmp[]="`$col`='$value'";
        }
        $sql .= " where ".join(" && ",$tmp);       
    } else if (is_numeric($id)) {
        $sql .= " where `id`='$id'";
    } else {
        echo "錯誤:錯誤的非數字參數";
    }
    echo 'find=>'.$sql.'<br>';
    $row=$pdo->query($sql)->fetch(PDO::FETCH_ASSOC);
    return $row;
}

//顯示取回的資料集
 function dd($array){
     echo "<pre>";
     print_r($array);
     echo "</pre>";
 }
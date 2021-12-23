<?php
    function dbConnect($host='', $user='', $pass='', $db=''){ 

        $host = "localhost";
        $user = "root";
        $pass = "";
        $db = "chat_with_me"; 

        $conn = new mysqli($host, $user, $pass, $db) or die(mysqli_connect_error($conn));

        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }
        
        return $conn;
    }

    function getTableColumns($table,$hidden=""){
        $restrict = "";

        $restricted = explode(",",$hidden);

        foreach($restricted as $h){
            $restrict .="'$h',";
        }

        $restrict = rtrim($restrict,",");

        $sql = "SHOW COLUMNS FROM $table WHERE FIELD NOT IN($restrict)";

        $conn = dbConnect();

        $result = $conn->query($sql);

        $i=0;
        
        foreach($result as $r){
            $columns[$i]['column'] = $r['Field'];
            $columns[$i]['type'] = $r['Type']; 
            $i++;
        }

        return $columns;
        // echo "<pre>".print_r($columns,true)."</pre>";
        
    }

    function fetch_db_array($array){
        foreach($array as $key=>$value){
            foreach($value as $keyD=>$valueD){

            }
        }
    }

    function updateData($sql){
        $conn = dbConnect();
        $result = $conn->query($sql);
        return $result;
        $conn->close();
    }

    function sqlINSERT($sql){
        $conn = dbConnect();
        $result = $conn->query($sql);
        return $result;
        $conn->close();
    }

    function exeSQL($sql){
        $conn = dbConnect();
        $result = $conn->query($sql);
        $results = array();

        if ($result->num_rows > 0) {
            $i=0;
            while($row = $result->fetch_assoc()) {
                foreach($row as $key=>$value){
                    $results[$i][$key] = $value;                   
                }
                $i++;
            }
        }

        return $results;
        $conn->close();
    }

    function exeINSERT($table){

        $columns = "";
        $values = "";

        foreach($_POST as $key=>$value){
            if($key=="saveNew"){
                
            }else if ($key=="table" || strpos($key,"checkbox")!==false){

            }else{
                $columns .= $key.",";
                $values .= "'".$value."',";
            }
        }

        $columns = rtrim($columns,",");
        $values = rtrim($values,",");

        $sql = "INSERT INTO $table($columns) VALUES($values)";
        // echo $sql;
        exeSQL($sql);
    };

    function getMax($table,$column,$where){

        $sql = "SELECT MAX($column) FROM $table WHERE $where";

        $result = exeSQL($sql);

        return $result[0]["MAX(".$column.")"];

    }

    function getMin($table,$column,$where){

        $sql = "SELECT MIN($column) FROM $table WHERE $where";

        $result = exeSQL($sql);

        return $result[0]["MIN(".$column.")"];

    }

    function getCount($table,$column,$where){
        $sql = "SELECT COUNT($column) FROM $table WHERE $where";

        $result = exeSQL($sql);

        return $result[0]["COUNT(".$column.")"];
    }

    function getSum($table,$column,$where){
        $sql = "SELECT SUM($column) FROM $table WHERE $where";

        $result = exeSQL($sql);

        return $result[0]["SUM(".$column.")"];
    }

    function getValues($table,$column,$where){
        $sql = "SELECT $column FROM $table WHERE $where";
        $result = exeSQL($sql);

        $result = $result[0][$column];

        return $result;



    }
?>
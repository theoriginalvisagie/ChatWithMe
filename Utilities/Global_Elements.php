<!-- <html>
    <script src="Script/js.js"></script>
</html> -->
<script>
    <?php require_once("Script/js.js");?>
</script>
<?php
    include_once("sqlClass.php");

    function dropDown($table,$column,$name){
        $dd = exeSQL("SELECT * FROM $table");
        // echo"<pre>";
        // print_r($dd);
        // echo"</pre>";
        echo "<select name='$name' id='$name'>";
        echo "<option></option>";
        foreach($dd as $key=>$value){
            echo "<option value='{$key}'>{$value[$column]}</option>";
        }
        echo "</select>";
    }

    function dropDownTag($table,$column,$name){
        $dd = exeSQL("SELECT * FROM $table");
        // echo "<pre>".print_r($dd,true)."</pre>";
        echo "<div>";
        echo "<select name='' id='dropDownTag' onchange='addToTags()'>";
        echo "<option></option>";
        
        foreach($dd as $key=>$value){
            echo "<option value='{$key}'>{$value[$column]}</option>";
        }
        echo "</select>";
    
        echo "<input type='hidden' value='' name='$name' id='dropDownTagInput'>";
        echo"<div id='dropDownTagDiv'></div>
        </div>";
    }

    function checkBox($table,$column,$name){
        $checkbox = exeSQL("SELECT * FROM $table");
        foreach($checkbox as $key=>$value){
            echo "<input type='checkbox' id='checkbox_$table' name='checkbox_$table' class='checkBoxClass_$table' value='$key' onchange='addCheckboxToList(this.value,\"$table\")'>
                    <label for='vehicle1'>$value[$column]</label><br>";
        }

        echo "<input type='hidden' name='$name' id='checkBoxList_$table' value='' >";
    }
?>
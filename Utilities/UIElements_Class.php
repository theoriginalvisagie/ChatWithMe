<?php
    class UIElementsClass{
        function __construct(){

        }

        function mainSideNav(){
            $sql = "SELECT * FROM modules";
            $modules = exeSQL($sql);
            $url = "http://localhost/Covid_results/admin/Models";

            echo "<main class='main'>
                    <aside class='sidebar'>
                    <nav class='nav'>
                        <ul>";

            foreach($modules as $module=>$data){
                $active = "";

                if(strpos($_SERVER['REQUEST_URI'],$data['model'])!==false)
                    $active = "active";

                echo"<li class='$active'><a href='$url/{$data['model']}/index.php'>{$data['name']}</a></li>";
            }
                            
             echo"</ul>
                    </nav>
                    </aside>
                </main>";//<img class='social' src='https://cdn1.iconfinder.com/data/icons/logotypes/32/twitter-128.png'>
        }

        function mainSideMenu(){
            $sql = "SELECT * FROM modules";

            echo "<ul class='nav flex-column' style='background-color:#000'>";

            $modules = exeSQL($sql);
            
            $url = "http://localhost/Covid_results/admin/Models";
            foreach($modules as $module=>$data){
                    echo "<li class='nav-item'>
                            <a class='nav-link'  href='$url/{$data['model']}/index.php' style='color:#fff;'><span class='{$data['icon']}'> {$data['name']}</span></a>
                        </li>";
                
            }

            echo "</ul>";
        }

        function displayTable($sql,$table,$tools=true,$columns="*",$showHidden=true){

            if($showHidden == true){
                $restrict = $columns;
            }

            $tableDisplay = getTableColumns($table,$restrict);
            // echo "<pre>".print_r($tableDisplay,true)."</pre>";
            $tableRow = exeSQL($sql);
            foreach($tableDisplay as $heading=>$row){                
                $th[] = $row['column'];                          
            }

            echo "<div style='width:70%'>
                    <div style='float:right'>  
                        <form method='post'>                
                        <input type='submit' class='btn btn-info' name='search' id='search' value='Seacrh'>
                        <input type='submit' class='btn btn-success' name='addNew' id='addNew' value='Add'>
                        <input type='hidden' name='db' id='db' value='$table'>
                        </form>
                    </div>";

            echo "<table class='table table-striped table-bordered' style='width:100%'>
                    <thead>
                        <tr>";

            foreach($th as $heading){
                echo "<th>".ucwords(str_replace("_"," ",$heading))."</th>";
            }
            echo "</tr></thead>";

            foreach($tableRow as $key=>$value){

                echo "<tr>";
                foreach($th as $heading){
                    echo "<td>{$value[$heading]}</td>";
                }
                if($tools){
                    echo "<td style='width:120px;'>
                            <button class='btn' type='submit' style='color:red;'><i class='far fa-times-circle'></i></button> |
                            <button class='btn' type='submit' style='color:black;'><i class='far fa-edit'></i></button>
                        </td>";
                }
                echo "</tr>";
            }
            echo "</table></div>";
        }

        function displayStatsCards(){
            echo "<div class='container' style='margin-top:20px;'><div class='row'>";
            for($i=0;$i<=3;$i++){
            echo "<div class='col-3'>
                    <div class='card text-center'>
                        <div class='card-header'>
                            Most Common Symptom
                        </div>
                        <div class='card-body'>
                            
                            <h5 class='card-text'>Nausea</h5>
                            <p class='card-text'>Cases: 16</p>
                        </div>
                        <div class='card-footer text-muted'>
                            2021-10-25 - 2021-10-30
                        </div>
                    </div>
                  </div>";
            }
                    
            echo "</div></div>";
        }
    }

?>
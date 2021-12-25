<?php
    session_start();
    class Home{
        function __construct(){}

        function init(){
            if(!empty($_SESSION['userID']) && !empty($_SESSION['access_rights']) && $_SESSION['logedIn']==="Yes"){
                $this->displayHome($_SESSION['userID']);
            }           
        }

        function displayHome($user){
            // echo "<div class='container no-gutters' style='margin:0; padding:0;'>";
                echo "<div class='row no-gutters'style='margin:0; padding:0; width:100%'>";

                    echo "<div class='col-2' style='background-color:red'>";
                    echo "YEYEYEYEYE";
                    echo "</div>";

                    echo "<div class='col-10' style='background-color:yellow'>";
                    $this->displaySettings();
                    echo "</div>";

                echo "</div>";//row
                echo "<div class='row no-gutters' style='margin:0; padding:0;'>";

                    echo "<div class='col-2' style='background-color:blue'>";
                    $this->displayContactChats($_SESSION['userID']);
                    echo "</div>";

                    echo "<div class='col-10' style='background-color:green'>";
                    echo "</div>";

                echo "</div>";//row
            // echo "</div>";//container
        }

        function displaySettings(){
            
            echo "<form method='post' style='float:right;'>
                    <button><i class='fas fa-cog'></i></button>
                    <input type='submit' class='btn btn-default' value='Logout' name='logout' id='logout'>
                  </form>";
        }

        function displayContactChats($user){
            echo "<ul class='nav nav-tabs'>
                    <li class='nav-item'>
                        <button class='nav-link active' aria-current='page' onclick='getChats($user)' name='getUserChat' id='getUserChat'>Chats</button>
                    </li>
                    <li class='nav-item'>
                        <button class='nav-link' onclick='getContacts($user)' name='getUserContacts' id='getUserContacts'>Contacts</button>
                    </li>                       
                </ul>";
        }
    }

    
?>
<?php

    session_start();
    include_once("../../../Utilities/sqlClass.php");
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
                echo "<div class='row no-gutters' style='margin:0; padding:0; height:96vh;'>";

                    echo "<div class='col-2' >";
                    $this->displayContactChats($_SESSION['userID']);
                    echo "</div>";

                    echo "<div class='col-10' style='background-color:green;'>";
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
            echo "<ul class='nav nav-tabs' id='myTab' role='tablist'>
                    <li class='nav-item'>
                        <button class='nav-link active' id='chats-tab' data-bs-toggle='tab' role='tab' aria-controls='chats' data-bs-target='#chats'aria-current='page' onclick='getChats($user)' name='getUserChat' id='getUserChat'>Chats</button>
                    </li>
                    <li class='nav-item'>
                        <button class='nav-link' id='contacts-tab' data-bs-toggle='tab' role='tab' aria-controls='contacts' data-bs-target='#contacts' onclick='getContacts($user)' name='getUserContacts' id='getUserContacts'>Contacts</button>
                    </li>                       
                </ul>";

                /*=====[Chats]=====*/
                echo "<div class='tab-pane fade' id='chats' role='tabpanel' aria-labelledby='profile-tab'>";
                echo "</div>";
                /*==========*/

                /*=====[Contacts]=====*/
                $sql = "SELECT id,first_name,last_name FROM users ORDER BY first_name ASC";
                $result = exeSQL($sql);

                foreach($result as $hasLetter){
                    $letters[] = substr($hasLetter['first_name'],0,1);
                }

                echo "<div class='tab-pane fade' id='contacts' role='tabpanel' aria-labelledby='profile-tab'>";
                echo "<div class='accordion' id='accordionExample'>";
                for ($i = 65; $i<=90; $i++){
                   
                    $letter = chr($i);
                    if(in_array($letter, $letters)){
                        echo "<div class='accordion-item'>
                                <h2 class='accordion-header' id='heading_$letter'>
                                <button class='accordion-button collapsed' type='button' data-bs-toggle='collapse' data-bs-target='#collapse_$letter' aria-expanded='false' aria-controls='collapse_$letter'>
                                    $letter
                                </button>
                                </h2>
                                <div id='collapse_$letter' class='accordion-collapse collapse' aria-labelledby='heading_$letter' data-bs-parent='#accordionExample'>
                                <div class='accordion-body'>";
                                foreach($result as $key){
                                    // echo $key['first_name'];
                                    if(substr($key['first_name'],0,1)==$letter){
                                        echo "<button name='' id='' class='btn btn-default'>{$key['first_name']} {$key['last_name']}</button>";
                                    }
                                }
                                    // <strong>This is the second item's accordion body.</strong> It is hidden by default, until the collapse plugin adds the appropriate classes that we use to style each element. These classes control the overall appearance, as well as the showing and hiding via CSS transitions. You can modify any of this with custom CSS or overriding our default variables. It's also worth noting that just about any HTML can go within the <code>.accordion-body</code>, though the transition does limit overflow.
                        echo "</div>
                                </div>
                            </div>";
                    }
                }
                echo "</div></div>";
                /*==========*/

        }
    }

    
?>
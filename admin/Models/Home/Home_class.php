<?php

    session_start();
    include_once(dirname(__FILE__,4)."/Utilities/sqlClass.php");
    require_once(dirname(__FILE__,4)."/admin/Models/Profile/User_profile.php");
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

                    echo "<div class='col-3' style='background-color:red'>";
                    echo "YEYEYEYEYE";
                    echo "</div>";

                    echo "<div class='col-9' style='background-color:yellow'>";
                    $this->displayToolBar($_SESSION['userID']);
                    echo "</div>";

                echo "</div>";//row
                echo "<div class='row no-gutters' style='margin:0; padding:0; height:96vh;'>";

                    echo "<div class='col-3' >";
                    $this->displayContactChats($_SESSION['userID']);
                    echo "</div>";

                    echo "<div class='col-9' style='background-color:white;'>";
                    $sql = "SELECT * FROM my_circle_1_christiaan_visagie m
                            LEFT JOIN users u ON u.id=m.user
                            LEFT JOIN users uu ON uu.id=m.contact";
                    $result = exeSQL($sql);
                    // $arr = getValues("my_circle_1_christiaan_visagie","contact","id='2'");
                    echo "<pre>".print_r($result,true)."</pre>";
                    if(isset($_GET['user']) && !empty($_GET['user'])){
                        $userProfile = new UserProfile();
                        $userProfile->myProfile();
                    }
                    echo "</div>";

                echo "</div>";//row
            // echo "</div>";//container
        }

        function displayToolBar($user){
            echo "<form method='post' style='float:right;'>                   
                    <button type='button'  data-bs-toggle='modal' data-bs-target='#publicContacts'>
                        <i class='fas fa-search'></i>
                    </button>
                    <a href='../Profile/index.php?user=$user' ><i class='fas fa-cog'></i></a>
                    <input type='submit' class='btn btn-default' value='Logout' name='logout' id='logout'>
                  </form>";

            /*=====['Modal']=====*/
            
            echo "<div class='modal fade' id='publicContacts' tabindex='-1' aria-labelledby='exampleModalLabel' aria-hidden='true'>
                    <div class='modal-dialog'>
                    <div class='modal-content'>
                        <div class='modal-header'>
                        <h5 class='modal-title' id='publicContacts'>Search Public Contacts</h5>
                        <button type='button' class='btn-close' data-bs-dismiss='modal' aria-label='Close'></button>
                        </div>
                        <div class='modal-body'>";
                        echo "<input type='text' class='form-control' placeholder='Search Contacts' name='seacrgPublicContacts' id='searchPublicContacts' onkeyup='searchPublicContact(this.value)'><br>";
                        echo "<div name='publicContactsModalContent' id='publicContactsModalContent'>";
                        $this->displayPublicContacts($user);
                        echo "</div>";

                    echo"</div>
                        <div class='modal-footer'>
                        <button type='button' class='btn btn-secondary' data-bs-dismiss='modal'>Close</button>
                        <button type='button' class='btn btn-primary'>Save changes</button>
                        </div>
                    </div>
                    </div>
                </div>";
            /*==========*/
        }

        function displayPublicContacts($user,$where=""){
            $userName = getValues("users","first_name","id='$user'")."_".getValues("users","last_name","id='$user'");
            $dontDisplayContact = array();
            $sql = "SELECT contact FROM my_circle_{$user}_{$userName} WHERE user='{$_SESSION['userID']}'";
            $result = exeSQL($sql);

            if($result){
                foreach($result as $key){
                    $dontDisplayContact[] = $key['contact'];
                }
    
                $dontDisplayContact = implode(",",$dontDisplayContact);
            }
            
            if(empty($where)){
                $where = "WHERE is_public='1'";
                if(!empty($dontDisplayContact)){
                    $where .= " AND id NOT IN($dontDisplayContact)";
                }
            }

            
            $sql = "SELECT id,first_name,last_name FROM users $where ORDER BY first_name ASC";
            $result = exeSQL($sql);

            if($result){
                foreach($result as $key){
                    echo "<input type='button' class='btn btn-default' name='{$key['id']}' id='{$key['id']}_{$key['last_name']}' onclick='addToMyCircle({$key['id']},\"{$key['last_name']}\")' value='{$key['first_name']} {$key['last_name']}'><br>";//</button>
                }
            }else{
                echo "<div class='alert alert-danger'>No Contacts To Display</div>";
            }
            
        }

        function displayContactChats($user){
            $userName = getValues("users","first_name","id='$user'")."_".getValues("users","last_name","id='$user'");

            echo "<nav>
                    <div class='nav nav-tabs' id='nav-tab' role='tablist'>
                        <button class='nav-link active' id='nav-chats-tab' data-bs-toggle='tab' data-bs-target='#nav-chats' type='button' role='tab' aria-controls='nav-chats' aria-selected='true'>Chats</button>
                        <button class='nav-link' id='nav-myCircle-tab' data-bs-toggle='tab' data-bs-target='#nav-myCircle' type='button' role='tab' aria-controls='nav-myCircle' aria-selected='false'>My Circle</button>
                        </div>
                </nav>";
                //<button class='nav-link' id='nav-publicContacts-tab' data-bs-toggle='tab' data-bs-target='#nav-publicContacts' type='button' role='tab' aria-controls='nav-publicContacts' aria-selected='false'>Public Contacts</button>
                    
              echo "<div class='tab-content' id='nav-tabContent'>";

                /*=====[Chats]=====*/
                echo "<div class='tab-pane fade show active' id='nav-chats' role='tabpanel' aria-labelledby='nav-chats-tab'>";
                echo "</div>";
                /*==========*/

                /*=====[My Contacts]=====*/
                $sql = "SELECT u.id,u.first_name,u.last_name FROM users u
                        LEFT JOIN my_circle_{$user}_{$userName} mc ON mc.contact=u.id
                        WHERE mc.user='$user'
                        ORDER BY first_name ASC";
                $result = exeSQL($sql);

                if($result){
                    foreach($result as $hasLetter){
                        $letters[] = substr($hasLetter['first_name'],0,1);
                    }
                }
                

                echo "<div class='tab-pane fade' id='nav-myCircle' role='tabpanel' aria-labelledby='nav-myCircle-tab'>";
                echo "<div class='accordion' id='accordionExample'>";
                if($result){
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
                                        if(substr($key['first_name'],0,1)==$letter){
                                            echo "<button name='' id='' class='btn btn-default'>{$key['first_name']} {$key['last_name']}</button>";
                                        }
                                    }
                            echo "</div>
                                    </div>
                                </div>";
                        }
                    }
                }else{
                    echo "<div class='alert alert-info'>Please Add Contacts to your circle</div>";
                }
                echo "</div></div>";
                /*==========*/

                /*=====[Public Contacts]=====*/
                /**
                 * Third Tab on Left menu for public contacts menu
                 */
                // echo "<div class='tab-pane fade' id='nav-publicContacts' role='tabpanel' aria-labelledby='nav-publicContacts-tab'>";
                // echo "<br><input type='text' class='form-control' placeholder='Search Contacts' name='seacrgPublicContacts' id='searchPublicContacts' onkeyup='searchPublicContact(this.value)'><br>";;
                // echo "<div id='contactsPublic'>";
                // $this->displayPublicContacts();
                // echo"</div>";
                // echo "</div>";
                /*==========*/

                echo "</div>";

        }
    }

    
?>
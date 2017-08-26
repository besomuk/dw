<?php
require ( "models/users_model.php");

class PageController extends MotherController
{
    private $user_model;
    
    public function __construct()  
    {  
        $this->user_model = new UsersModel();
    } 
    
    public function index()
    {
        return 0;
    }
    
    public function listUsers()
    {
        session_start ();            
        if ( isset($_SESSION['username']) )
        {
            $data['users']    = $this->user_model->getAllUsers();
            $data['title']    = "Back Office - User list";
            $data['username'] = $_SESSION['username'];   
            
            $this->view ( 'views/header.php', $data );
            $this->view ( 'views/menu.php', $data );
            $this->view ( 'views/users_list.php', $data );
            $this->view ( 'views/footer.php', $data );
        }
        else
        {
            echo "niste ulogovani...";
        }         
    }
}
?>
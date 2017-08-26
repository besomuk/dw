<?php
require ( "models/users_model.php");

class FormController extends MotherController
{
    private $user_model;
    
    public function __construct()  
    {  
        $this->user_model = new UsersModel();
    } 
    
    // 'landing' metoda, prikazi formu za login ili pusti korisnika u backend
    public function index()
    {
        session_start ();            
        if ( isset($_SESSION['username']) )
        {
            $this->autoLogin();
        }
        else
        {
            $title = "Log In";
            $data['title'] = "Login Forma";                        
            
            $this->view ( 'views/header.php', $data );
            $this->view ( 'views/login_form.php', $data);
            $this->view ( 'views/footer.php', $data);
        }        
    }
    
    // obradi formu
    public function doForm()
    {
        // uzmi podatke iz forme
        $username = $_REQUEST['username'];
        $password = $_REQUEST['password'];
        
        if(!isset($_SESSION))  session_start(); 
        
        // pitaj model jel dobar login
        $passwordOK = $this->user_model->checkUserPassword ( $username, $password );
        
        if ( $passwordOK ) // login ok, uloguj korisnika, podigni sesiju, itd...
        {
            $_SESSION['username'] = $_REQUEST['username'];   
            
            $data['title'] = "Back Office";
            $data['username'] = $_SESSION['username'];
            
            $this->view ( 'views/header.php', $data );
            $this->view ( 'views/menu.php', $data );
            $this->view ( 'views/login_ok.php', $data );
            $this->view ( 'views/footer.php', $data );
                        
        }
        else // login ne valja, vrati ga
        {
            $data['title'] = "Login Error";
            
            $this->view ( 'views/header.php', $data );
            $this->view ( 'views/login_fail.php', $data );
            $this->view ( 'views/footer.php', $data );            
        }
    }
    
    // vec smo ulogovani, daj mi back office
    public function autoLogin ()
    {
        if(!isset($_SESSION))  session_start(); 
        
        // prosledi podakte
        $data['username'] = $_SESSION['username'];
        $data['title']    = "Back Office";        
        
        $this->view ( 'views/header.php', $data);
        $this->view ( 'views/menu.php', $data);
        $this->view ( 'views/login_ok.php', $data);
        $this->view ( 'views/footer.php', $data);
    }
    
    // logout metoda
    public function logOut()
    {
        session_start();

        if( session_destroy() )
        {
            header("Location: index.php");
        }        
    }

    // register user metoda
    public function newUserForm ()
    {
        if (  isset ( $_REQUEST['submit'] ) ) // user je kliknuo submit, upisi u bazu sta treba
        {
            // uzmi podatke iz forme
            $username  = $_REQUEST['username'];
            $password  = $_REQUEST['password'];
            $password2 = $_REQUEST['password2'];
            $email     = $_REQUEST['email'];
            
            // pozovi kontroler i pitaj ga za rezultat operacije, na osnovu rezultata uradi sta treba
            $result = $this->user_model->writeNewUser( $username, $password, $password2, $email );
            $data['title']  = "Register User Results";
            
            $this->view ( 'views/header.php', $data );
            if ( $result == 0 )       // sve ok, registracija je uspesna
            {                
                $this->view ( 'views/register_ok.php', $data );           
            }
            else if ( $result == 1 )  // korisnik vec postoji
            {
                $this->view ( 'views/register_existing_user.php', $data );
            }
            else if ( $result == 2 )  // desila se neka greska sa bazom
            {
                $this->view ( 'views/register_db_error.php', $data );
            }
            else if ( $result == 3 ) // lozinke se ne slazu
            {
                $this->view ( 'views/register_password_error.php', $data );
            }            
            else                     // nepoznata greska
            {
                $this->view ( 'views/register_unknown.php', $data );
            }
            
            $this->view ( 'views/footer.php', $data );
            
        }
        else // user nista nije kliknuo, prikazi mu formu
        {
            $data['title'] = "New User Registration";
            
            $this->view ( 'views/header.php', $data );
            $this->view ( 'views/form_register.php', $data );
            $this->view ( 'views/footer.php', $data );
        }
    }
}
?>
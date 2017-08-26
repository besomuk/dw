<?php
class UsersModel extends MotherModel
{
    public function __construct()  
    {  
        $this->connect();
    }
    
    // metoda za listanje svih korisnika
    public function getAllUsers ()
    {
        $query = 'SELECT * FROM users';
        $run = $this->db->query( $query );
        
        $users = array();
        
        while($row = $run->fetch(PDO::FETCH_ASSOC))
        {
            array_push($users, array ( 'id' => $row['id'], 
                                       'username' => $row['username'], 
                                       'email' => $row['email'])
                                      );
        }        
            
        return $users;
    }
    
    // provera ispravnost kombinacije username/password i vraca true ako je ok
    public function checkUserPassword ( $username, $password )
    {
        $query = "SELECT username, password FROM users WHERE username='$username'";
        
        $run = $this->db->query( $query );
        $row = $run->fetch(PDO::FETCH_ASSOC);
            
        $hashedpassword = password_hash($password, PASSWORD_BCRYPT);
        
        if ( password_verify ( $password, $row['password']) )
        {
            return true;
        }
        else
        {
            return false;
        }  
    }
    
    // metoda za upis novog korisnika u bazu
    // rezultati:
    // 0 - sve je ok
    // 1 - postojeci korisnik
    // 2 - greska sa upisom u bazu
    // 3 - lozinke se ne slazu
    public function writeNewUser ( $username, $password, $password2, $email )
    {    
        // prvo proveri korisnika
        if ( !$this->existingUser( $username ) )
        {
            // proveri i lozinku, ako vec nisi uz pomoc jQuery na samoj formi
            if ( $password != $password2)
                return 3;
            
            $hashedpassword = password_hash($password, PASSWORD_BCRYPT);
            
            $query = "INSERT INTO users ( username, password, email )  VALUES ( '$username', '$hashedpassword', '$email' )";        
            try 
            {
                $run = $this->db->query( $query );
            }
            catch(PDOException $ex)
            {
                echo "<div id='greska'>Greska</div>";
                echo $ex->getMessage();
                return 2;
            }            
            return 0;
        }
        else
        {
            return 1;
        }
        
    }
    
    // privatna metoda za proveru da li korisnicko ime vec postoji
    private function existingUser ( $username )
    {
        $query = "SELECT username FROM users WHERE username='$username'";
        $run = $this->db->query( $query );

        if ( $run->rowCount() == 0 )
        {
            return false; // ne postoji
        }
        else
        {
            return true;  // postoji
        }
    }

}

?>
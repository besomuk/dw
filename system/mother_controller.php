<?php
class MotherController
{
    public function view ( $location, $vars )
    {
        // napravi imena varijabli od key-a niza
        $cnt = count ($vars);
        for ( $i = 0; $i<$cnt; $i++)
        {
            $temp_var = key($vars); 
            ${"$temp_var"} = $vars[$temp_var];
            //echo key($vars);
            next($vars);
            
        }
        
        require_once( $location );
    }
}

?>
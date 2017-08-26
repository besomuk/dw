<table class="paleBlueRows">
<thead>
<tr>
    <th>ID</th>
    <th>USERNAME</th>
    <th>EMAIL</th>
</tr>
</thead>
<tbody>
<?php
    //echo $users[1];
    foreach ( $users as $user )
    {
        echo "<tr>";
            echo "<td>";
                echo $user['id'] . "<br>";
            echo "</td>";        
            echo "<td>";
                echo $user['username'] . "<br>";
            echo "</td>";
            echo "<td>";
                echo $user['email'] . "<br>";
            echo "</td>";        
        echo "</tr>";
    }
?>
</tbody>    
</table>
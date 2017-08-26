<form action="index.php?controller=form&method=doForm" method="POST">
    <p>
        <label>Username</label>
        <input id="username" value="" name="username" type="text" required="required" /><br>
    </p>    
    <p>
        <label>Password</label>
        <input id="password" name="password" type="password" required="required" />
    </p>        
    <p>
        <button type="submit" class="green big" name="submit"><span>Login</span></button>
    </p>
</form>

<a href="index.php?controller=form&method=newUserForm">Register</a>
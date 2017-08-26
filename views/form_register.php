<form action="index.php?controller=form&method=newUserForm" method="POST">
    <p>
        <label>Username</label>
        <input id="username" value="" name="username" type="text" required="required" /><br>
    </p>    
    <p>
        <label>Password</label>
        <input id="password" name="password" type="password" required="required" />
    </p>    
    <p>
        <label>Repeat Password</label>
        <input id="password2" name="password2" type="password" required="required" />
    </p>    
    <p>
        <label>Email</label>
        <input id="email" value="" name="email" type="text" required="required" /><br>
    </p>        
    <p>
        <button type="submit" class="green big" name="submit"><span>Register</span></button>
    </p>
</form>
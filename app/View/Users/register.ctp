<div class="register">
<h3 class="text-center">Join Us</h3>

<form id="UserRegisterForm" method="post" action="register">

<input class="Input-text" name="data[User][first_name]" placeholder="Enter Your First name" id="UserFirstName">

<br>
<input class="Input-text" name="data[User][last_name]" placeholder="Enter Your Last name" id="UserLastName">

<br>
<input class="Input-text" name="data[User][username]" placeholder="Enter Username" id="UserUsername">

<br>
<input type="password" name="data[User][password]" class="Input-text" placeholder="Enter Password" id="UserPassword">

<br>
<select name="data[User][role]" id="UserRole">
<option>Select User Account Type</option>
<option value="author">I am an Author</option>
<option value="reader">I am just a Reader</option>

</select>
<br>
<br>
<button type="submit" value="submit" class="submit-btn" >Register</button>
<a class="pull-right" href="login">Already have an account?? Login</a>
</form>
</div>




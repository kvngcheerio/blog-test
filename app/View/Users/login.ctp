<!-- <div class="loginn">
<h3 class="text-center">Login Your Account</h3>
<?php echo $this->Session->flash('auth'); ?>

<form id="UserLoginForm" method="post" action="login">


<input class="Input-text" name="data[User][username]" placeholder="Enter Username" id="UserUsername">

<br>
<input type="password" name="data[User][password]" class="Input-text" placeholder="Enter Password" id="UserPassword">


<br>
<br>
<button type="submit" value="submit" class="submit-btn" >Login</button>
<a class="pull-right" href="register">Dont have and account?? Register</a>
</form>
</div> -->

<div class="users form">
<?php echo $this->Session->flash('auth'); ?>
<?php echo $this->Form->create('User'); ?>
    <fieldset>
        <legend><?php echo __('Please enter your username and password'); ?></legend>
        <?php echo $this->Form->input('username');
        echo $this->Form->input('password');
    ?>
    </fieldset>
<?php echo $this->Form->end(__('Login')); ?>
</div>

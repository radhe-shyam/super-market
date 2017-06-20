<div class="navbar" role="navigation" style='text-align: center;'>
  <div class="container-fluid">
    <div class="navbar-header">
      <a class="navbar-brand" href="#" style="margin-left: -30px"><img src="images/main_logo.png" style="width: 200px; height: 38px;" /></a>
    </div>
    <ul class="nav navbar-nav navbar-right">
      <li><a href="#">Explore Market</a></li>
      <li><a href="#" onclick="$('#Register').hide(100);$('#login').toggle(100);">Login</a></li>
      <li><a href="#" onclick="$('#login').hide(100);$('#Register').toggle(100)">Register</a></li>
    </ul>
  </div>
</div>
  <div id="login" style="display:none;">
    <form class="navbar-form navbar-right">
      <fieldset>
        <legend align="center">Login</legend>
        <input type="text" placeholder="Email address"  class="form-control">
        <input type="password" placeholder="Password" class="form-control">
        <input type="submit" class="btn btn-success" value="Login">
      </fieldset>
    </form>
  </div> 
  <div id="Register" style="display:none;">
    <form class="navbar-form navbar-right">
      <fieldset>
        <legend align="center">Register</legend>
        <input type="text" placeholder="Your Name"  class="form-control">
        <input type="email" placeholder="Email address" class="form-control"> 
        <input type="password" placeholder="Password"  class="form-control">
        <input type="submit" class="btn btn-success" value="Register">
      </fieldset>
    </form>
  </div> 
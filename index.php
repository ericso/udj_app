<?php
	require_once(dirname(__FILE__) . '/app/php/includes/global.inc.php');

	// login code
	$error = "";
	$username = "";
	$password = "";

	// check to see if they've submitted the login form
	if (isset($_POST['submit-login'])) {

	    $username = $_POST['username'];
	    $password = $_POST['password'];	

	    $logger->log('username: ' . $username);

	    $userTools = new UserTools();
	    if ($userTools->login($username, $password)) {
	        // successful login, redirect them to a page
	        header("Location: index.php");
	    } else {
	        $error = "Incorrect username or password. Please try again.";
	        $logger->log("Incorrect username or password. Please try again.", 3);
	    }
	}
?>

<!doctype html>

<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0 maximum-scale=1.0 user-scalable=0">
	<meta name="description" content="A simple app for requesting music to be played by a DJ.">
	
	<title>ReQuest Home</title>
	
	<link rel="icon" type="image/png" href="#">

	<!-- CSS -->
	<link href="assets/css/bootstrap.css" rel="stylesheet" type="text/css">
	<link href="assets/css/bootstrap-responsive.css" rel="stylesheet" type="text/css">
	<link href="assets/css/custom.css" rel="stylesheet" type="text/css">
	<link href="assets/css/main.css" rel="stylesheet" type="text/css">

	<!-- Javascript -->
	<script src="assets/js/jquery-1.8.3.js"></script>
	<script src="assets/js/bootstrap.js"></script>
	<script src="assets/js/custom.js"></script>
	
	<!-- App code -->
	<script src="app/js/gui.js"></script>
	<script src="app/js/global.js"></script>
	<script src="app/js/dj.js"></script>
	<script src="app/js/search.js"></script>
	<script src="app/js/songs.js"></script>
	<script src="app/js/queue.js"></script>

	<!-- HTML5 shim for IE backwards compatibility -->
	<!--[if lt IE 9]>
	  <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
	<![endif]-->
</head>

<body onload="setupApp()">
	<!-- PHP check to see if user is logged in -->
	<?php if (isset($_SESSION['logged_in'])) : ?>
		<?php $user = unserialize($_SESSION['user']); ?>
	<?php endif; ?>

	<!-- responsive layout for phone devices -->
	<div class="container-fluid">
		<nav class="row-fluid ">
			<div id="nav_bar" class="navbar">
				<div class="navbar-inner">
					<a class="brand active" href="javascript:void(0);" id="index_tab" >ReQuest</a>
					<ul class="nav pull-right">
						<!-- <div class="navbar-search input-prepend">
							<span class="add-on"><i class="icon-search"></i></span>
							<input id="song_search_input" type="text" class="input-small" placeholder="song/artist">
						</div> -->
						<li>
							<div class="navbar-search">
								<input id="song_search_input" type="text" class="navbar-form input-small" placeholder="Song/Artist">
								<a href="javascript:void(0);" id="search-icon" class="icon-search"></a>
							</div>
						</li> <!-- This icon could be an advanced search feature or used as the search "button" -->
	  					<li class="divider-vertical"></li>
				        
	  					<!-- PHP if the user isn't logged in, display login link -->
						<?php if (!isset($_SESSION['logged_in'])):
								$logger->log('session is not set', 3);
								$display_login_style = "display: block;";
								$display_logout_style = "display: none;";
							else:
								$logger->log('session is set', 3);
								$logger->log('username: ' . $user->username, 3);
								$display_login_style = "display: none;";
								$display_logout_style = "display: block;";
							endif;
						?>
				        <li class="dropdown" style="<?php echo $display_login_style; ?>">
				        	<a class="dropdown-toggle" href="#" data-toggle="dropdown">Sign In <strong class="caret"></strong></a>
				        	<div class="dropdown-menu" style="padding: 15px; padding-bottom: 0px;">
								<section class="row-fluid ">
							    <form action="index.php" method="post">
							        Username: <input type="text" name="username" value="" /><br/>
							        Password: <input type="password" name="password" value="" /><br/>
							        <input type="submit" value="Login" name="submit-login" class="btn btn-primary" />
							        <input id="signup_btn" value="Register" name="submit-signup" class="btn btn-success" />
							    </form>
								</section>
				            </div>
				        </li>

				        <li class="" style="<?php echo $display_logout_style; ?>">
				        	<a href="logout.php"><?php echo $user->username; ?></a>
				        </li>

	  					<li class="divider-vertical"></li>
  						<li class="dropdown">
    						<a href="#" class="dropdown-toggle" data-toggle="dropdown"><span class="icon-align-justify"></span></a>
    						<ul class="dropdown-menu">
    							<li id="queue_tab" class="pull-right"><a href="javascript:void(0)" ><strong>Queue  </strong><span class="icon-music"></span></a></li>
	  							<li id="search_tab" class="pull-right"><a href="javascript:void(0)"><strong>Results  </strong><span class="icon-search"></span></a></li>
    							<li id="help_tab" class="pull-right"><a href="javascript:void(0)"><strong>Help  </strong><span class="icon-question-sign"></span></a></li>
	  							<li id="share_tab" class="pull-right"><a href="javascript:void(0)"><strong>Share  </strong><span class="icon-share"></span></a></li>
	  							
    						</ul>
 						</li>
					</ul>
				</div>
			</div>
		</nav>

		<!-- For displaying Bootstrap style popup notifications -->
		<div class="row-fluid">
			<div id="alert-area" style="position:fixed;"></div>
		</div>

		<!-- Tabs -->
		<div id="index_tab_div" class="row-fluid ">
			<div class="page-header">
	  			<h1>Welcome!  <small>Ready to make a <strong>ReQuest</strong>?</small></h1>
			</div>
			<h4>Find your DJ</h4>
			<table id="dj_table" class="table well">
				<thead>
					<td>DJ</td>
					<td>Venue</td>
					<td></td>
				</thead>
				<tbody>
				</tbody>
			</table>
			<div class="well">
				<p><strong>ReQuest</strong> simplifies the interaction between DJs and their audience by giving them the power to handle requested music using the cloud and allowing the audience to vote on the music.</p>
			</div>
		</div>
		
		<div id="queue_tab_div" class="row-fluid " style="display: none;">
			<h4 id="dj_name_bill"></h4>
			<table id="queue_table" class="table well">
				<thead>
					<td></td>
					<td>Track</td>
					<td>Total</td>
					<td>Vote</td>
					<td></td>
				</thead>
				<tbody>
				</tbody>
			</table>
			<!-- <div class="pagination pagination-centered pagination-medium">
				<ul>
					<li class="active"><a href="#"><span class="icon-arrow-left"></span></a></li>
					<li><a href="#"><span class="icon-arrow-right"></span></a></li>
				</ul>
			</div> -->
		</div>

		<div id="search_tab_div" class="row-fluid " style="display: none;">			
			<div class="row-fluid ">
				<h3>Search Results  <small id="number_songs_found"></small></h3>
				<div id="search_results_list">
				</div>
			</div>
		</div>

		<div id="help_tab_div" class="row-fluid " style="display: none;">
			<dl>
				<dt>How do I request a song?</dt>
				<dd>Click the <strong>Search</strong> tab, type the title or artist in the box, click <strong>Search</strong>, then select the track.</dd>
				<dt>I requested a track but it hasn't played yet?</dt>
				<dd>The DJ may not have the track you have requested.</dd>
				<dt>I'm a DJ, how do I sign up for <strong>ReQuest</strong>?</dt>
				<dd>You can email us (email address).</dd>
				<dt>This is cool, how can I tell more people about it?</dt>
				<dd>Click the <span class="icon-share"></span> link and you can share with any popular social network.</dd>
			</dl>
		</div>

		<div id="share_tab_div" class="row-fluid " style="display: none;">
			<div class="row-fluid ">
				<h3>ReQuest Social<small><span> </span>Share</small></h3>
			</div>
			<section class="row-fluid ">
				<ul class="nav nav-tabs nav-stacked" style="text-align:center">
					<li><a href="sms:?body=Check%20out%20ReQuest%20http://theawkwardduck.com/">SMS Message</a></li>
					<li><a href="">Email</a></li>
					<li><a href="">Facebook</a></li>
					<li><a href="">Twitter</a></li>
					<li><a href="">Google+</a></li>
					<li><a href="">Pintrest</a></li>
				</ul>
				<ul class="nav nav-tabs nav-stacked" style="text-align:center">
					<li><a href="">Contact Us</a></li>
				</ul>
			</section>
		</div>

		<footer class="row-fluid ">
			<div class="muted">
				<p>By using this app, you are agreeing to the <a href="terms.html">Terms of Service</a>.<p>
			</div>
			<div>
				<p class="pull-right muted">&copy; 2012 @UDJ Interactive</p>
			</div>
		</footer>
	</div>

	<!-- responsive layout for all other devices -->
	<!-- <div class="container-fluid hidden-phone">
		<header class="row-fluid">
			<div class="alert alert-block">
	  			<button type="button" class="close" data-dismiss="alert">&times;</button>
	  			<h4>Opps!<small> </small></h4>
				<p>You must change your browser's window size to view the responsive mobile app layout. Please make your browser's window size less than 767 pixels wide.</p>
			</div>
		</header>

		<section class="row-fluid">
			<aside class="span#">
			</aside>
			<article class="span#">
			</article>
		</section>
	</div> -->
</body>
</html>
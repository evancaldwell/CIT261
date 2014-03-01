<?php

?>
<!DOCTYPE html>
<html>
	<head>
		<title>Nagger</title>
		<meta charset="utf-8" />
		<meta name="keywords" content="personal, productivity, task management, GTD">
		<meta name="description" content="Best personal productivity, task management app ever!">
		<link href="css/style.css" rel="stylesheet">

		<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
		<script src="https://code.jquery.com/jquery.js"></script>
		<!-- the main js file -->
		<script type="text/javascript" src="js/nagger.js"></script>
	</head>
	<body>
		<div id="container">
			<div class="header">
				<img class="logo-img" src="" alt="">
				<div class="logo-txt">
					<h1>Nagger</h1>
				</div>
				<button id="add-item-btn" class="btn btn-add-new">+</button>  <!-- TODO: this should ideally be an icon -->
			</div>
			<div id="main">
				<ul class="item-list main-item-list">
					<li>
						<img src="" alt="">
						<p>Dig a hole in the back yard</p>
					</li>
					<li>
						<img src="" alt="">
						<p>Pick up one of the kids from soccer</p>
					</li>
					<li>
						<img src="" alt="">
						<p class="dropdown">Finish CIT 261 project<span>&nbsp;&nbsp;&nbsp;></span></p>
						<ul class="sublist">
							<li>final design</li>
							<li>HTML/CSS</li>
							<li>JS</li>
						</ul>
					</li>
					<li>
						<img src="" alt="">
						<p>Eat the cake in the fridge</p>
					</li>
					<li>
						<img src="" alt="">
						<p>Integrate Br. Barney's face into the app design somehow</p>
					</li>
					<li>
						<img src="" alt="">
						<p>Become world's best developer</p>
					</li>
					<li>
						<img src="" alt="">
						<p>Think of another task to add</p>
					</li>
				</ul>
			</div>
			<div class="cloud-icon">
				<button class="btn btn-cloud"><img src="" alt="cloud"></button>
			</div>
		</div>

		<!-- ============= Hidden divs ============= -->
		<div id="login" class="overlay">
			<div>
				<img class="logo-img" src="" alt="">
				<div class="logo-txt">
					<h1>Nagger</h1>
				</div>
			</div>
			<div class="form form-auth">
				<input type="email" placeholder="Email" required><br>
				<input type="password" placeholder="Password" required><br>
				<button class="btn btn-default">Login</button>
			</div>
		</div>
		<div id="signup" class="overlay">
			<div>
				<img src="" alt="" class="logo-img">
				<div class="logo-txt">
					<h1>Nagger</h1>
				</div>
			</div>
			<div class="form form-auth">
				<input type="email" placeholder="Email" required><br>
				<input type="password" placeholder="Password" required><br>
				<input type="password" placeholder="Confirm Password" required><br>
				<input type="text" placeholder="First Name"><br>
				<input type="text" placeholder="Last Name"><br>
				<input type="text" placeholder="Phone Number"><br>
				<button class="btn btn-default">Sign Up</button>
			</div>
		</div>
		<div id="new-item" class="overlay">
			<textarea name="newItemInput" id="new-item-input" cols="30" rows="10" class="item-input"></textarea>
			<div class="done-o-meter">
				<img src="" alt="">
				<img src="" alt="">
				<div class="done-o-meter-bar">

				</div>
			</div>
			<div class="sublist">
				<p>Add a sub-item</p>
				<button class="btn btn-add-new">+</button>
			</div>
			<button>Add Another Item</button>
			<button>Save</button>
		</div>
		<div id="wordcloud" class="overlay">
			<p class="cloud-word">Family</p>
		</div>
	</body>
</html>
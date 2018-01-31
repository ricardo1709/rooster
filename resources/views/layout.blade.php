<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Moet ik vandaag naar Nederlands?</title>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<style type="text/css">
		
		*{
			margin: 0;
			padding: 0;
			text-align: center;
		}

		html{
			font-size: 25px;
			font-family: Arial, sans-serif;
		}

		.container{
			width: 100vw;
			height: 100vh;
			display: flex;
			justify-content: center;
			align-items: center;
		}

		h1{
			margin-bottom: .5rem;
			font-size: 2rem;
		}

		.schedule{
			background: rgba(0, 0, 0, .1);
			margin-top: 1rem;
			padding: .5rem;
		}

		.schedule div{
			margin: 1rem 0;
		}

		.schedule span{
			display: block;
		}

		.schedule span:first-child{
			font-weight: bold;
		}

		@media screen and (max-width: 600px)
		{
			html{
				font-size: 16px;
			}
		}

	</style>
</head>
<body>
	
	<div class="container">
		<div class="main">
			@yield('main')
		</div>
	</div>


</body>
</html>
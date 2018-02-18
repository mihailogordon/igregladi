<!DOCTYPE html>
<html>
<head>
	<link rel="stylesheet" type="text/css" href="css/style.css">
	<link rel="stylesheet" type="text/css" href="css/reset.css">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
	<title>Igre Gladi</title>
</head>
<body>
	<div class="wrapper">
		<div class="content">
			<div class="content_inner">
				<div class="container">
					<div class="container_inner">
						<div class="form">
							<input type="text" class="input_link input_field">
							<a href="#" class="input_link insert">Ubaci</a>
							<a href="#" class="input_link remove_all">Obrisi</a>
							<a href="#" class="input_link decide">Presudi</a>
							<a href="#" class="input_link back">Povratak</a>
							<a href="#" class="input_link input_current">Upisi trenutne</a>
						</div>
						<div class="result_wrapper">
							<div class="input_container">
							</div>
							<div class="result_container">
							</div>
						</div>
						<div class="columns_50_50 clearfix">
							<div class="column_left">
								<div class="forms_holder">
									<a class="input_link input_form_opener" href="#">Prikazi formu za unos</a>
									<div class="input_form">
										<form action="" method="">
											<input type="text" name="username" id="input_username" placeholder="Insert username"><br/>
											<input type="text" name="password" id="input_password" placeholder="Insert password"><br/>
											<textarea placeholder="Unesi zeljene predloge razdvojene zarezima" name="input_content" id="input_content"></textarea><br/>
											<a name="submit" class="input_link input_submit">Unesi</a>
											<div class="input_message_success">Uspesno ste uneli podatke</div>
											<div class="input_message_error">Doslo je do greske</div>
										</form>
									</div>
								</div>
								<div class="forms_holder">
									<a href="#" class="input_link load_form_opener">Ucitaj predefinisani predlog</a>
									<div class="load_form">
										<form action="" method="">
											<input type="text" name="username" id="load_username" placeholder="Insert username"><br/>
											<input type="text" name="password" id="load_password" placeholder="Insert password"><br/>
											<a name="submit" class="input_link load_submit">Ucitaj</a>
											<div class="load_message_success">Uspesno ste ucitali podatke</div>
											<div class="load_message_error">Doslo je do greske</div>
										</form>
									</div>
								</div>
							</div>

							<div class="column_right">
								<div class="forms_holder">
									<a href="#" class="input_link closest_form_opener">Otvori formu sa geolokacijom</a>
									<div class="closest_form">
										<form action="" method="" class="closest_form_inner">
											<input type="text" name="radius" id="closest_radius" placeholder="Insert radius in kilometers"><br/>
											<input type="text" name="price" id="closest_price" placeholder="Insert maximum price"><br/>
											<input type="text" name="food" id="closest_food" placeholder="Insert what you like to eat"><br/>
											<a name="submit" class="input_link closest_submit">Ucitaj</a>
											<div class="closest_message_success"></div>
											<div class="closest_message_error">Doslo je do greske</div>
										</form>
									</div>
								</div>
								<div class="forms_holder">
									<a href="#" class="input_link rest_form_opener">Pretraga po restoranima</a>
									<div class="rest_form">
										<form action="" method="" class="rest_form_inner">
											<div class="rest_message_success"></div>
											<div class="rest_message_error">Doslo je do greske</div>
											<div class="rest_menu_message_success"></div>
											<div class="rest_menu_message_error">Doslo je do greske</div>
										</form>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</body>
<script type="text/javascript" src="js/script.js"></script>
</html>

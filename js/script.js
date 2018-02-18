$(document).ready(function(){

	var input_field = $(".input_field");
	var input_container = $(".input_container");
	var result_container = $(".result_container");
	input_field.focus();

	$(".insert").click(function(){
		
		var input_value = input_field.val();

		if(input_value!=''){
			var input_text = '<p class="input_item"> <a class="remove_item" href="#"><i class="fa fa-times-circle"></i></a> <span class="input_item_value">' + input_value + '</span></p>';
			input_field.val('');
			input_container.append(input_text);
			input_container.addClass("appeared");
			result_container.removeClass("appeared");
		}

		else {
			window.alert("Invalid input! Please try again.");
		}

		input_field.focus();

		$(".remove_item").click(function(){
			$(this).parent(".input_item").remove();
		})
	})

	$('.input_field').keypress(function (e) {
		var key = e.which;
		if(key == 13){
			$('.insert').click();
		 	return false;  
		}
	});   

	$(".decide").click(function(){

		var values = [];
		var input_item = input_container.find(".input_item").each(function(){
			values.push($(this).html());
		});

		var n = values.length;

		if(n>0){
			
			result_container.addClass("appeared");
			input_container.removeClass("appeared");

			var i = 0;

			var decideRepeater = window.setInterval(function(){

				if(i<25){

					var result = '<p class="result_item">' + values[Math.floor(Math.random() * n)] + '</p>';
					result_container.html(result);
					i++;
				}

			},100);

			if(i>=15){
				window.clearInterval();
			}
		}

		else{
			window.alert("List is empty! First add some items in it please.");
		}

	})

	$(".remove_all").click(function(){
		input_container.html("");
		input_container.removeClass("appeared");
		result_container.removeClass("appeared");
		input_field.focus();
	})

	$(".back").click(function(){
		result_container.removeClass("appeared");
		input_container.addClass("appeared");
	})

	$(".input_form_opener").click(function(){
		if($(".load_form").hasClass("appeared")){
			$(".load_form").removeClass("appeared");
		}
		$(".input_form").toggleClass("appeared");
	})

	$(".load_form_opener").click(function(){
		if($(".input_form").hasClass("appeared")){
			$(".input_form").removeClass("appeared");
		}
		$(".load_form").toggleClass("appeared");
	})

	$(".input_form .input_submit").click(function(){

		var username = $("#input_username").val();
		var password = $("#input_password").val();
		var input_content = $("#input_content").val();

		$.ajax({
            type: "POST",
            url: "insert.php",
            data: {username:username,password:password,input_content:input_content},
            success: function(data) {
            	$(".input_message_success").html(data);
            	$(".input_message_success").addClass("appeared");
            },
            error: function(data) {
            	$(".input_message_error").addClass("appeared");
            }
        });

	})

	$(".load_form .load_submit").click(function(){

		var username = $("#load_username").val();
		var password = $("#load_password").val();

		$.ajax({
            type: "POST",
            url: "load.php",
            data: {username:username,password:password},
            success: function(data) {
            	input_container.addClass("appeared");
            	if(data == 'Nema registrovanog korinika sa unetim imenom i sifrom. Molimo vas prvo registrujte korisnika ili proverite unos.'){
            		$(".load_message_success").html(data);
            		$(".load_message_success").addClass("appeared");
            	}

            	else{
            		input_container.empty().append(data);
            		$(".load_message_success").addClass("appeared");
            	}

            	$(".remove_item").click(function(){
					$(this).parent(".input_item").remove();
				})
            },
            error: function(data) {
            	$(".load_message_error").addClass("appeared");
            }
        });

	})

	$(".input_current").click(function(){
		var values_array = [];
		var input_item = input_container.find(".input_item .input_item_value").each(function(){
			values_array.push($(this).html());
		});

		var values_string = values_array.join(', ');

		$(".input_form").addClass("appeared");
		$(".input_form textarea").val(values_string);
	})

	/*geolocation snippet - begin*/

	if (navigator.geolocation) { 

        navigator.geolocation.getCurrentPosition(showLocation); 

    } else { 

        $('#location').html('Geolocation is not supported by this browser.'); 

    }

    var latitude;

    var longitude;

    function showLocation(position) { 

	    latitude = position.coords.latitude; 
		
		longitude = position.coords.longitude;

	}

	/*geolocation snippet - end*/

	$(".closest_form_opener").click(function(){
		$(".closest_form").toggleClass("appeared");

		/*var form = $(".closest_form").find('.closest_form_inner');

		var hidden_lat = '<input type="hidden" name="latitude" class="hidden_input" value="' + latitude + '">';

		var hidden_lon = '<input type="hidden" name="longitude" class="hidden_input" value="' + longitude + '">';

		if(!(form.children(".hidden_input").length>0)){

			form.append(hidden_lat);
			form.append(hidden_lon);
		}*/

	})

	$(".closest_form .closest_submit").click(function(){

		var radius = $("#closest_radius").val();
		var price = $("#closest_price").val();
		var food = $("#closest_food").val();

		$.ajax({
            type: "POST",
            url: "closest.php",
            data: {radius:radius,price:price,food:food,latitude:latitude,longitude:longitude},
            success: function(data) {
            	$(".closest_message_success").addClass("appeared");
            	$(".closest_message_success").html(data);
            },
            error: function(data) {
            	$(".closest_message_error").addClass("appeared");
            }
        });
	})

	$(".rest_form_opener").click(function(){

		$.ajax({
			type: "POST",
			url: "rest.php",
			data: {},
			success: function(data) {
				var result_string = data;
				var result_array = result_string.split(";");
				var n = result_array.length - 1;
				var output  = '<select class="restaurants_select">';
				output += '<option value="">'+" "+'</option>';
				for(i=0;i<n;i++){
					output += '<option value="'+result_array[i]+'">'+result_array[i]+'</option>';
				}
				output += '</select>'
				$(".rest_message_success").html(output);
				$(".rest_message_success").addClass("appeared");

				$(".restaurants_select").change(function(){

					var restaurant = $(this).val();
					if(restaurant != ''){
						$.ajax({
							type: "POST",
							url: "fetch_rests_menu.php",
							data: {restaurant:restaurant,latitude:latitude,longitude:longitude},
							success: function(data) {
								$(".rest_menu_message_success").html(data);
								$(".rest_menu_message_success").addClass('appeared');
				            },
				            error: function(data) {
				            	$(".rest_menu_message_error").addClass('appeared');
				            }
						})
					}
					else{
						$(".rest_menu_message_success").removeClass('appeared');
					}
				})
            },
            error: function(data) {
            	$(".rest_message_error").addClass("appeared");
            }
		})

		$(".rest_form").toggleClass("appeared");
	})

});
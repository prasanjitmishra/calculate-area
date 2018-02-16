<!DOCTYPE html>
<html>
<head>
	<title>select</title>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
	<style type="text/css">
		body{
			font-size: 12px
		}
		.outer{
			border: 1px solid #CCC;
		    padding: 5px 20px 15px 20px;
		    border-radius: 10px;
		}
		.header{
			background: url('images/header_bg.gif');
		    background-repeat: no-repeat, repeat;
		    height: 60px;
		    width: 100%;
		    padding: 20px 20px;
		}
		.shapeType{
			text-transform: capitalize;
		}
		.row{
			margin-top: 50px
		}
		.custom-btn{
			font-weight: bold;color: #333;
		}
		.page-header{
			text-align: center;margin: 0
		}
	</style>
</head>
<body>
	<div class="container">
		<header class="header">
			<span style="font-size: 25px;">Shape Calculator</span>
		</header>
		<div class="row">
			<div class="col-md-6 col-xs-6 col-sm-6">
					<h4>
						Welcome to Shape Calculator
					</h4>
					<div style="font-weight: bold">
						Shape Calculator is an interactive web application. To the right you will
						find the 3 step application. Follow the instructions in each step.
						Clicking cancel will take you back to step 1. Enjoy!
					</div>
					<br>
					<div>
						A small river named Duden flows by their place and supplies it with the
						necessary regelialia. It is a paradisematic country, in which roasted parts of
						sentences fly into your mouth.
					</div>
					<br>
					<div>
						Even the all-powerful Pointing has no control about the blind texts it is an
						almost unorthographic life One day however a small line of blind text by the
						name of Lorem Ipsum decided to leave for the far World of Grammar. The
						Big Oxmox advised her not to do so, because there were thousands of bad
						Commas.			
					</div>
			</div>
			<div class="col-md-4 col-xs-4 col-sm-4">
				<div class="outer">
				<!-- page 1-->
					<div class="common" id="page1">
						<h3 class="page-header">
							Step 1 : Select your shape
						</h3>
						<br>
						<div>
							Please select the shape that you would like to calculate the area of and press the button "Go to step 2"
						</div>
						<div class="radio">
						  <label><input type="radio" name="optradio" value="rectangle">Rectangle</label>
						</div>
						<div class="radio">
						  <label><input type="radio" name="optradio" value="circle">Circle</label>
						</div>
						<div class="radio">
						  <label><input type="radio" name="optradio" value="square">Square</label>
						</div>
						<div class="radio">
						  <label><input type="radio" name="optradio" value="Ellipse">Ellipse</label>
						</div>
						<button type="button" class="btn next-btn" style="font-weight:bold">
							Go to step 2
						</button>
						<a href="/shapes/public/shapes"  class="btn cancel-btn custom-btn">Start over</a>
					</div>
					<!--page 2 -->
					<div class="common hidden" id="page2">
						<h3 class="page-header">
							Step 2 : Insert your values
						</h3>
						<br>
						<div>
							You have selected a 
							<span class="shapeType">
								circle	
							</span>
							, please input
							the required variables.
						</div>
						<br>
						<div class="selection">
							
						</div>
						
						<button type="button" class="btn next-btn" style="font-weight:bold">Go to step 3</button>
						<a href="/shapes/public/shapes"  class="btn cancel-btn custom-btn">or Cancel</a>
					</div>
					<!--page 3 -->
					<div class="common hidden" id="page3">
						<h3 class="page-header">
							Step 3 : Your results
						</h3>
						<br>
						<div class="result">
							
						</div>
						<a href="/shapes/public/shapes"  class="btn cancel-btn custom-btn" style="border: 1px solid #ccc;">Start over</a>
					</div>
				</div>
			</div>
				
			<div class="col-md-2 col-xs-2 col-sm-2">
				<div style="background: #545454;height: 240px;width: 120px;margin: 0 auto;">
					
				</div>
			</div>
			</div>

		</div>
</body>
<!-- jQuery library -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script type="text/javascript" src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>	
<script type="text/javascript">
	$(document).ready(function(){
		var currentState;
		var selectedShape;
		var peroperties;
		var area;
		init();

		function init() {
			currentState = 1;
			selectedShape = '';
			peroperties =[];
			area = undefined;
			currentPage();
		}

		function currentPage() {
			$(".common").addClass("hidden");
			$("#page"+currentState).removeClass("hidden");
		}

		$(".next-btn").click(function(){
			if (currentState == 1) {
	            var radioValue = $("input[name='optradio']:checked").val();
	            if(radioValue){
	                selectedShape = radioValue;
					$(".shapeType").html(selectedShape);
	                $.get('shapes/property/'+selectedShape)
		            .then(function(result){
						properties = result.data;
						if (result.data != null) {
							bindAttributes(result.data);
			            	currentState++;
							currentPage();
						} else {
							alert('no attributes found, select other.');
						}
		            });
	            } else {
	            	alert("Please select one shape.");
	            }
			} else if (currentState == 2) {
				var data = {};
				var err = [];
				for (var i=0;i<properties.length;i++){
					if (isNaN($("#"+properties[i]).val())) {
						err.push('please enter a number for '+properties[i]);	
					} else {
						data[properties[i]] = $("#"+properties[i]).val();
					}
				}

				if (err.length > 0) {
					alert(err.join());
				} else {
					$.get('shapes/area/'+selectedShape, data)
	            	.then(function(result){
						if (result.status == 1) {
							var html = "You have calculated the area of a <b>"+
									   "<span style='text-transform:capitalize'>"+selectedShape+
									   "</span></b> with ";
							for (var i=0;i<properties.length;i++){
								if (i > 0) {
									html += " and ";
								}
								html += properties[i] + " of " + data[properties[i]];
							}

							html += ". Below is your result:"+"<br><br>";
							html += "<h3 style='text-align:center'>The Area is "+result.data+"</h3><br><br>";

							$(".result").html(html);
							currentState++;
							currentPage();
						} else {
							alert(result.data);
						}
		            });
				}
			} else if (currentState == 3) {

			} else {
				alert('state not found.');
			}

			function getAttributes()
			{
				return $.get('shapes/property/'+selectedShape)
				.then(function(result){
					return result;
				})
			}

			function bindAttributes(properties)
			{	
				var html="";
				$(".selection").empty();
				for (var i=0;i<properties.length;i++){
					html += '<div class="form-group">'+
							  	'<label for="'+properties[i]+'" style="text-transform:capitalize">'+properties[i]+'</label>'+
							  	'<input type="text" class="form-control" id="'+properties[i]+'">'+
							'</div>';
				}
				$(".selection").append(html);
			}

        });

        $(".cancel-btn").click(function(){
			init();
        });
	});
</script>
</html>
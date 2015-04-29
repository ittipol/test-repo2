<?php

	session_start();

	if($_SESSION['ID'] == '')
		redirect("index.php?page=main");

?>

<style type="text/css">

	body {
	    background: #2d2d2d;
	}

	.loading {
	    position: fixed;
	    top: 50%;
	    left: 50%;
	    margin: -14px 0 0 -42px;
	    padding: 10px;
	    background: rgba(20, 20, 20, 0.9);
	  
	    -webkit-border-radius: 5px;
	    -moz-border-radius: 5px;
	    border-radius: 5px;
	  
	    -webkit-box-shadow: inset 0 0 5px #000, 0 1px 1px rgba(255, 255, 255, 0.1);
	    -moz-box-shadow: inset 0 0 5px #000, 0 1px 1px rgba(255, 255, 255, 0.1);
	    -ms-box-shadow: inset 0 0 5px #000, 0 1px 1px rgba(255, 255, 255, 0.1);
	    -o-box-shadow: inset 0 0 5px #000, 0 1px 1px rgba(255, 255, 255, 0.1);
	    box-shadow: inset 0 0 5px #000, 0 1px 1px rgba(255, 255, 255, 0.1);
	}

	.loading-dot {
	    float: left;
	    width: 8px;
	    height: 8px;
	    margin: 0 4px;
	    background: white;
	  
	    -webkit-border-radius: 50%;
	    -moz-border-radius: 50%;
	    border-radius: 50%;
	  
	    opacity: 0;
	  
	    -webkit-box-shadow: 0 0 2px black;
	    -moz-box-shadow: 0 0 2px black;
	    -ms-box-shadow: 0 0 2px black;
	    -o-box-shadow: 0 0 2px black;
	    box-shadow: 0 0 2px black;
	  
	    -webkit-animation: loadingFade 1s infinite;
	    -moz-animation: loadingFade 1s infinite;
	    animation: loadingFade 1s infinite;
	}

	.loading-dot:nth-child(1) {
	    -webkit-animation-delay: 0s;
	    -moz-animation-delay: 0s;
	    animation-delay: 0s;
	}

	.loading-dot:nth-child(2) {
	    -webkit-animation-delay: 0.1s;
	    -moz-animation-delay: 0.1s;
	    animation-delay: 0.1s;
	}

	.loading-dot:nth-child(3) {
	    -webkit-animation-delay: 0.2s;
	    -moz-animation-delay: 0.2s;
	    animation-delay: 0.2s;
	}

	.loading-dot:nth-child(4) {
	    -webkit-animation-delay: 0.3s;
	    -moz-animation-delay: 0.3s;
	    animation-delay: 0.3s;
	}

	@-webkit-keyframes loadingFade {
	    0% { opacity: 0; }
	    50% { opacity: 0.8; }
	    100% { opacity: 0; }
	}

	@-moz-keyframes loadingFade {
	    0% { opacity: 0; }
	    50% { opacity: 0.8; }
	    100% { opacity: 0; }
	}

	@keyframes loadingFade {
	    0% { opacity: 0; }
	    50% { opacity: 0.8; }
	    100% { opacity: 0; }
	}

</style>

<img id="payment-logo" src="assets/img/bank/gateway_creditcard.jpg" />

<div class="loading">
	<div class="loading-dot"></div>
	<div class="loading-dot"></div>
	<div class="loading-dot"></div>
    <div class="loading-dot"></div>
</div>

<script type="text/javascript">

	window.onload = function(){

	 	var winH = window.innerHeight;
	 	var winW = window.innerWidth; 
		var e = document.getElementById("payment-logo");
		var eH = e.clientHeight;
		var eW = e.clientWidth;
		// alert(e.clientHeight);

		e.style.position = "absolute";
		e.style.top = (winH-eH)/2;
		e.style.left = (winW-eW)/2;

		setTimeout(function(){
			window.location = "index.php?page=paid&nID=<?php echo $_GET['nID']; ?>";
		},3000);

	};

</script>
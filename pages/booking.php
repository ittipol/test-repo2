<?php

?>

<div id="content">
	<div class="container">
		<div>
	        <div id="main">
				<div id="page-message" style="font-size:40px; text-align:center;">Service is unavilable now</div>
			</div>
		</div>
	</div>
</div>

<script type="text/javascript">
	
	window.onload = function(){

		var wH = window.innerHeight;
		var h = 90 + 130;
		var hh = wH - h;
	
		var elem = document.getElementById("page-message");
		elem.style.height = hh+"px";
		elem.style.lineHeight = hh+"px";

	}

</script>
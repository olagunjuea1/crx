<script type="text/javascript">
	setInterval(() => {
		$.ajax({
			url: "../includes/__getnotif.php",
			method: "POST",
			success: function (e) {
				if (e == 1) {
					$("#notifcounter").show();
				}
				else{
					$("#notifcounter").hide();
				}
			}
		})
	}, 1000);
</script>



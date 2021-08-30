<head>
<link rel="stylesheet" type="text/css" href="jquery.autocomplete.css" />
<script type="text/javascript" src="jquery.js"></script>
<script type="text/javascript" src="jquery.autocomplete.js"></script>
<script>
$(document).ready(function(){
 $("#tag").autocomplete("management/add-leave/autocomplete/autocomplete.php", {
		selectFirst: true
	});
});
</script>
</head>

<body>
    <label>Tag:</label>
    <input name="tag" type="text" id="tag" size="20"/>
</body>

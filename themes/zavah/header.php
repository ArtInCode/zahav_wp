<html>
<head>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta charset="UTF-8">
	<title><?php if(is_home()) { echo bloginfo("name"); echo " | "; echo bloginfo("description"); } else { echo wp_title(" | ", false, right); echo bloginfo("name"); } ?></title>
	<?php wp_head(); ?>
</head>
<body>


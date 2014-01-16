<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="<?php echo $ENCODING; ?>" />
		<title>CIFACOM API DEV</title>
		<base href="<?php echo $SCHEME.'://'.$HOST.':'.$PORT.$BASE.'/'; ?>" />
		<link rel="stylesheet" href="view/css/base.css" type="text/css" />
		<link rel="stylesheet" href="view/css/theme.css" type="text/css" />
		<link rel="stylesheet" href="core/code.css" type="text/css" />
	</head>
	<body>
		<?php echo $this->render(Base::instance()->get('content')); ?>
	</body>
</html>

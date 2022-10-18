<!doctype html>
<html lang="de">
<head>
	<meta charset="utf-8" />
	<link rel="icon" href="<?php echo URL; ?>favicon.ico" />
	<script> let SITE_URL = '<?php echo URL; ?>';</script>
	<link rel="stylesheet" href="<?php echo URL . CSS_DIR; ?>fonts.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
	<link rel="stylesheet" href="<?php echo URL . PUBLIC_DIR; ?>fonts/font-icons/css/font-awesome.min.css">
	<?php
	if (isset($this->js)) {
		foreach ($this->js as $js) {
			echo '<script src="' . URL . MODULES . $js . '"></script>' . "\n";
		}
	}
	if (isset($this->css)) {
		foreach ($this->css as $css) {
			echo '<link rel="stylesheet" href="' . URL . MODULES . $css . '" />' . "\n";
		}
	}
	?>
	<title><?php echo !empty($this->page_title) ? $this->page_title : 'Fehler 404'; ?></title>
</head>
<body>
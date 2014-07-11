<!doctype html>
<html>
	<head>
		<title>CodeMirror: HTML5 preview</title>
		<meta charset="utf-8"/>

		<link rel="stylesheet" href="css/normalize.css">
		<link href='http://fonts.googleapis.com/css?family=Ubuntu+Mono:400,700,400italic,700italic' rel='stylesheet' type='text/css'>
		<link rel="stylesheet" href="css/codemirror/codemirror.css">
		<link rel="stylesheet" href="css/codemirror/theme/monokai.css">
		<link rel="stylesheet" href="css/editor.css">
		<script src="js/codemirror/codemirror.js"></script>
		<script src="js/codemirror/mode/xml/xml.js"></script>
		<script src="js/codemirror/mode/javascript/javascript.js"></script>
		<script src="js/codemirror/mode/css/css.js"></script>
		<script src="js/codemirror/mode/htmlmixed/htmlmixed.js"></script>
	</head>
	<body>

		<header id="header">
			<h1>Emailer</h1>
			<ul id="tabs">
				<li class="active"><a href="#ide_panel_main">HTML</a></li>
				<li><a href="#ide_panel_css">CSS</a></li>
				<li><a href="#ide_panel_variables">Variables</a></li>
				<li><a href="#ide_panel_images">Images</a></li>
				<li><a href="#ide_panel_css_reset">CSS Reset</a></li>
			</ul>
			<div id="tabs_bottom"></div>
		</header>

		<article>

			<div id="ide_panels">
				<div id="ide_panel_main" class="tab-panel active">
					<textarea id="code" name="code"><?=$template?></textarea>
				</div>
				<div id="ide_panel_css" class="tab-panel">
					Aquí el CSS<br>
					<textarea id="css_val" rows="10" cols="40"><?=$this->load->view('css/custom_view', '', TRUE)?></textarea>
				</div>
				<div id="ide_panel_variables" class="tab-panel">
					Aquí las variables<br>
					<textarea id="variable_list" rows="10" cols="40">
{
	"test"	: "MYTEST",
	"word"	: "MYWORD",
	"derp"	: "A veeer"
}
					</textarea>
				</div>
				<div id="ide_panel_css_reset" class="tab-panel">
					Aquí el CSS<br>
					<textarea id="css_reset_val" rows="10" cols="40"><?=$this->load->view('css/reset_view', '', TRUE)?></textarea>
				</div>
			</div>

			<div id="preview_wrapper"><iframe id="preview"></iframe></div>
		</article>

		<script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
		<script src="js/script.js"></script>
	</body>
</html>
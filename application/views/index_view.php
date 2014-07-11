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
					Aquí el CSS
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
			</div>

			<iframe id="preview"></iframe>
		</article>

		<script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
		<script>

			var tabs		= $('#tabs');
			var tab			= tabs.find('a');
			var ide_panels	= $('#ide_panels');
			var ide_panel	= ide_panels.find('.tab-panel');

			var variable_list	= $('#variable_list');

			tab.on('click', function () {

				tabs.find('.active').removeClass('active');
				$(this).parent().addClass('active');

				var panel	= $(this).attr('href').replace('#', '');
				ide_panel.hide();
				$('#' + panel).show();

			});

			var delay;
			var editor = CodeMirror.fromTextArea(document.getElementById('code'), {
				mode: 'text/html',
				theme	: 'monokai'
			});
			editor.on("change", function() {
				clearTimeout(delay);
				delay = setTimeout(updatePreview, 300);
			});
			variable_list.on("input propertychange", function() {
				clearTimeout(delay);
				delay = setTimeout(updatePreview, 300);
			});


			function template(html,data){
				return html.replace(/%(\w*)%/g,function(m,key){return data.hasOwnProperty(key)?data[key]:"<strong style=\"color: #ff0000\">%" + key + "%</strong>";});
			}

			function updatePreview() {
				var previewFrame		= document.getElementById('preview');
				var preview 			= previewFrame.contentDocument ||  previewFrame.contentWindow.document;

				try {
					var variable_list_val	= $.parseJSON(variable_list.val());
					var html	= template(editor.getValue(), variable_list_val);
				} catch(err) {
					console.log('error en la lista de variables');
					var html	= editor.getValue();
				}

				preview.open();
				preview.write(html);
				preview.close();
			}
			setTimeout(updatePreview, 300);
	    </script>
	</body>
</html>
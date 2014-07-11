<!doctype html>
<html>
	<head>
		<title>CodeMirror: HTML5 preview</title>
		<meta charset="utf-8"/>

		<link rel="stylesheet" href="css/codemirror/codemirror.css">
		<link rel="stylesheet" href="css/codemirror/theme/monokai.css">
		<script src="js/codemirror/codemirror.js"></script>
		<script src="js/codemirror/mode/xml/xml.js"></script>
		<script src="js/codemirror/mode/javascript/javascript.js"></script>
		<script src="js/codemirror/mode/css/css.js"></script>
		<script src="js/codemirror/mode/htmlmixed/htmlmixed.js"></script>
		<style type=text/css>
			body {
				margin: 0;
				padding: 0;
			}
		  .CodeMirror {
		    float: left;
		    width: 50%;
		  }
		  iframe {
		    width: 50%;
		    float: left;
		    height: 300px;
		    border: 0;
		  }
		</style>
	</head>
	<body>

		<article>
		<h2>Emailer</h2>

		    <textarea id="code" name="code"><?=$template?></textarea>
		    <iframe id="preview"></iframe>
		    <script>
				var delay;
				var editor = CodeMirror.fromTextArea(document.getElementById('code'), {
					mode: 'text/html',
					theme	: 'monokai'
				});
				editor.on("change", function() {
					clearTimeout(delay);
					delay = setTimeout(updatePreview, 300);
				});

				function template(html,data){
					return html.replace(/%(\w*)%/g,function(m,key){return data.hasOwnProperty(key)?data[key]:"<strong style=\"color: #ff0000\">%" + key + "%</strong>";});
				}

				function updatePreview() {
					var previewFrame = document.getElementById('preview');
					var preview =  previewFrame.contentDocument ||  previewFrame.contentWindow.document;
					var html	= template(editor.getValue(), {
						test	: "MYTEST",
						word	: "MYWORD"
					});
					preview.open();
					preview.write(html);
					preview.close();
				}
				setTimeout(updatePreview, 300);
		    </script>
		  </article>
	</body>
</html>
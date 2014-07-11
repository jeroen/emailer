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
$('#css_val, #variable_list').on("input propertychange", function() {
	clearTimeout(delay);
	delay = setTimeout(updatePreview, 300);
});


function template(html, data){
	return html.replace(/%(\w*)%/g, function (m,key) {
		if (data.hasOwnProperty(key)) {
			return data[key];
		} else {
			return "<strong style=\"color: #ff0000\">%" + key + "%</strong>";
		}
	});
}

function updatePreview() {
	var previewFrame		= document.getElementById('preview');
	var preview 			= previewFrame.contentDocument ||  previewFrame.contentWindow.document;
	var css_val				= $('#css_val').val();
	var css_reset_val		= $('#css_reset_val').val();
	var static_vars 		= {
		'css'		: css_val,
		'css_reset'	: css_reset_val
	};

	try {
		var variable_list_val	= $.parseJSON(variable_list.val());
	} catch(err) {
		console.log('error en la lista de variables');
	}

	var html	= template(editor.getValue(), $.extend(static_vars, variable_list_val));

	preview.open();
	preview.write(html);
	preview.close();
}
setTimeout(updatePreview, 300);
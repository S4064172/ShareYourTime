function addInputField(id) 
{
	return function() {
		var form = document.getElementById('ratingsForm');
		var field = document.createElement('input');
		field.setAttribute('name', 'IdJob');
		field.setAttribute('value', id);
		field.setAttribute('style', 'display: none');
		form.append(field);
	};
}

function addEventToEvalModal(idJob) 
{
	$('#evalOk').unbind('click').click(addInputField(idJob));
}

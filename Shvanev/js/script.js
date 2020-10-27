"use strict"

document.addEventListener('DOMContentLoaded', function(){
	var form = document.getElementById('form');
	form.addEventListener('submit', formSend);

	async function formSend(e) {
		e.preventDefault();
		
		let error = formValidate(form);
		let formData = new FormData(form);

		if (error === 0) {
			form.classList.add('sending');
			let response = await fetch('mail.php', {
				method: 'POST',
				body: formData
			});
			if (response.ok) {
				let result = await response.json();
				alert(result.message);
				form.reset();
				form.classList.remove('sending');
			} else {
				alert('Ошибка');
				form.classList.remove('sending');
			}
		} 
	}

	function formValidate(form){
		let error = 0;
		let formReq = document.querySelectorAll('.req');

		for (let index = 0; index < formReq.length; index++) {
			var input = formReq[index];
		formRemoveError(input);

		if (input.classList.contains('user-phone')){
			if (phoneTest(input)){
				formAddError(input);
				error++;
			}
		}else {
			if(input.value === '') {
				formAddError(input);
				error++;
			}
		}
 
		}
		return error;

	}
	function formAddError(input) {
		input.parentElement.classList.add('error');
		input.classList.add('error');
	}

	function formRemoveError(input) {
		input.parentElement.classList.remove('error');
		input.classList.remove('error');
	}
	function phoneTest(input) {
		 return !/^(\+7|7|8)?[\s\-]?\(?[489][0-9]{2}\)?[\s\-]?[0-9]{3}[\s\-]?[0-9]{2}[\s\-]?[0-9]{2}$/.test(input.value);
	}
});


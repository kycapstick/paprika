const addErrorMessage = (input, message) => {
	const error_input = document.querySelector(`#${input.name}_error`);
	if (error_input) {
		error_input.innerText = message;
		input.classList.add("error__active");
		input.addEventListener("focus", (e) => {
			input.classList.remove("error__active");
		});
	}
};

const checkForEmptyInput = (value) => {
	return /[a-zA-Z]+/gi.test(value);
};

const checkEmailValidity = (value) => {
	const emailRegEx = /(^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.(?:[a-zA-Z]{2}|com|org|net|edu|gov|mil|biz|info|mobi|name|aero|asia|jobs|museum)$)/gi;
	return emailRegEx.test(value);
};

const validateInputs = (inputs) => {
	let valid = true;
	const data = {};
	inputs.forEach((input) => {
		data[input.name] = input.value;
		let allClear;
		if (input.type === "text") {
			allClear = checkForEmptyInput(input.value);
			if (allClear === false) {
				addErrorMessage(input, "This field is required");
				valid = false;
			}
		} else if (input.type === "email") {
			allClear = checkEmailValidity(input.value);
			if (allClear === false) {
				addErrorMessage(input, "This requires a valid email");
				valid = false;
			}
		}
	});
	if (valid === false) {
		return false;
	}
	return data;
};

const submitForm = (action, formData) => {
	const url = `/wp-admin/admin-ajax.php?action=${action}`;
	const data = formData;
	console.log(data);
	jQuery.ajax({
		url,
		data,
		method: "POST",
		success: function (resp) {
			const response = jQuery.parseJSON(resp);
			if (response.status === "OK") {
				console.log(response);
			}
			console.log(response);
		},
	});
};

const handleSubmit = (itemId) => {
	const form = document.getElementById(itemId);
	if (form) {
		form.addEventListener("submit", (e) => {
			e.preventDefault();
			const requiredInputs = form.querySelectorAll("[required]");
			console.log(requiredInputs);
			if (requiredInputs.length > 0) {
				const data = validateInputs(requiredInputs);
				if (data) {
					data["nonce"] = form.dataset.nonce;
					data["list_id"] = form.dataset.list;
					submitForm("mailchimp_subscribe", data);
				}
			}
		});
	}
};

const init = () => {
	handleSubmit("footer__form");
};

export default init;

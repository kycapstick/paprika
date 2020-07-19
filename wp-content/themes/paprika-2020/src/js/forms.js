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
		if (input.type === "text" || input.type === "textarea") {
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

const submitForm = (action, formData, form) => {
	return new Promise((resolve, reject) => {
		const url = `/wp-admin/admin-ajax.php?action=${action}`;
		const data = formData;
		jQuery.ajax({
			url,
			data,
			method: "POST",
			success: function (data) {
				resolve(data);
			},
			error: function (data) {
				reject(data);
			},
		});
	});
};

const handleResponse = (form, response) => {
	const resp = JSON.parse(response);
	console.log(resp);
	if (resp.status === "OK") {
		form.classList.add("form__success");
		return;
	}
	form.classList.add("form__submission__error");
};

const handleDataSubmission = async (formId, form, data) => {
	if (formId === "footer__form") {
		data["nonce"] = form.dataset.nonce;
		data["list_id"] = form.dataset.list;
		const response = await submitForm("mailchimp_subscribe", data);
		handleResponse(form, response);
		return;
	}
	if (formId === "contact__form") {
		data["nonce"] = form.dataset.nonce;
		const response = await submitForm("contact_form", data);
		handleResponse(form, response);
		return;
	}
};

const handleSubmit = (itemId) => {
	const form = document.getElementById(itemId);
	if (form) {
		form.addEventListener("submit", (e) => {
			e.preventDefault();
			const requiredInputs = form.querySelectorAll("[required]");
			if (requiredInputs.length > 0) {
				const data = validateInputs(requiredInputs);
				if (data) {
					handleDataSubmission(itemId, form, data);
				}
			}
		});
	}
};

const init = () => {
	const forms = ["footer__form", "contact__form"];
	forms.forEach((form) => {
		handleSubmit(form);
	});
};

export default init;

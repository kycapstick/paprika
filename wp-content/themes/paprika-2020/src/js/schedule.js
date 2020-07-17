const clearCurrentDate = () => {
	const $activeDates = document.querySelectorAll(".schedule__active");
	if ($activeDates.length > 0) {
		$activeDates.forEach(($date) => {
			$date.classList.remove("schedule__active");
		});
	}
};

const activateNewDate = (date) => {
	const $newDates = document.querySelectorAll(`.schedule__date--${date}`);
	if ($newDates.length > 0) {
		$newDates.forEach(($date) => {
			$date.classList.add("schedule__active");
		});
	}
};

const handleDateChange = () => {
	const $scheduleToggles = document.querySelectorAll(
		".schedule__toggle__single"
	);
	if (!$scheduleToggles.length) {
		return;
	}
	$scheduleToggles.forEach((element) => {
		element.addEventListener("change", (e) => {
			clearCurrentDate();
			const date = e.target.value;
			activateNewDate(date);
		});
	});
};

const init = () => {
	handleDateChange();
};

export default init;

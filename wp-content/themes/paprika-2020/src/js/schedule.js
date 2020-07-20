import { data } from "autoprefixer";

const clearCurrentDate = () => {
	const $activeDates = document.querySelectorAll(".schedule__active");
	if ($activeDates.length > 0) {
		$activeDates.forEach(($date) => {
			$date.classList.remove("schedule__active");
		});
	}
};

const fadeOutRemaining = (date) => {
	const inactiveDates = document.querySelectorAll(
		`.schedule__list__item:not(.schedule__active):not(.schedule__list__item--hidden)`
	);
	if (inactiveDates.length > 0) {
		inactiveDates.forEach((date) => {
			date.classList.add("fade-out");
		});
	}
};

const fadeInAll = () => {
	const allHidden = document.querySelectorAll(
		".schedule__list__item--hidden"
	);
	if (allHidden.length > 0) {
		allHidden.forEach((item) => {
			item.classList.add("fade-in");
			item.classList.remove("schedule__list__item--hidden");
		});
	}
};

const activateNewDate = (date) => {
	const $newDates = document.querySelectorAll(`.schedule__date--${date}`);
	if ($newDates.length > 0) {
		$newDates.forEach(($date, index) => {
			const count = $newDates.length - 1;
			if ($date.classList.contains("schedule__card")) {
				const ancestor = $date.closest(".schedule__list__item");
				ancestor.classList.add("schedule__active");
				if (
					ancestor.classList.contains("schedule__list__item--hidden")
				) {
					ancestor.classList.add("fade-in");
					ancestor.classList.remove("schedule__list__item--hidden");
				}
			} else {
				$date.classList.add("schedule__active");
			}
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
			if (e.target.value === "all") {
				fadeInAll();
				return;
			}
			const date = e.target.value;
			activateNewDate(date);
			fadeOutRemaining(date);
		});
	});
};

const handleFadeOut = () => {
	const scheduleItems = document.querySelectorAll(".schedule__list__item");
	if (scheduleItems.length) {
		scheduleItems.forEach((item) => {
			item.addEventListener("animationend", (e) => {
				if (e.target.classList.contains("fade-out")) {
					e.target.classList.add("schedule__list__item--hidden");
					e.target.classList.remove("fade-out");
					e.target.classList.remove("fade-in");
					return;
				}
				if (e.target.classList.contains("fade-in")) {
					e.target.classList.remove("fade-in");
					e.target.classList.remove("fade-out");
				}
			});
		});
	}
};

const init = () => {
	handleDateChange();
	handleFadeOut();
};

export default init;

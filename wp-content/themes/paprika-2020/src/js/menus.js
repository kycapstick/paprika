const addTrapFocusListeners = (first, last) => {
	first.addEventListener("keydown", (e) => {
		if (
			e.keyCode === 9 &&
			e.shiftKey &&
			e.target.classList.contains("header__trigger--active")
		) {
			e.preventDefault();
			last.focus();
		}
	});
	last.addEventListener("keydown", (e) => {
		if (e.keyCode === 9 && !e.shiftKey) {
			e.preventDefault();
			first.focus();
		}
	});
};

const trapFocus = (menu, firstElement) => {
	const activeItems = [
		...menu.querySelectorAll('button, a, [tabindex]:not([tabindex="-1"])'),
	];
	const lastElement = activeItems.pop();
	addTrapFocusListeners(firstElement, lastElement);
};

const addFocusTrapping = () => {
	const headerMenu = document.querySelector(".header-menu");
	const firstElement = document.querySelector(".header__trigger");
	trapFocus(headerMenu, firstElement);
	allowEscKey(headerMenu);
};

// MAIN MENU
const activateMenu = () => {
	const menu = document.querySelector(".header-menu");
	menu.classList.toggle("header-menu--active");
	document.body.classList.toggle("noscroll");
};

const allowEscKey = () => {
	const headerMenu = document.querySelector(".header-menu");
	const menuTrigger = document.querySelector(".header__trigger");
	headerMenu.addEventListener("keyup", (e) => {
		if (!headerMenu.classList.contains("header-menu--active")) {
			return;
		}
		if (e.keyCode === 27) {
			menuTrigger.classList.toggle("header__trigger--active");
			activateMenu();
		}
	});
};

const handleMenuTriggerClick = () => {
	const menuTrigger = document.querySelector(".header__trigger");
	menuTrigger.addEventListener("click", (e) => {
		activateMenu();
		if (e.target.classList.contains("header__trigger__bar")) {
			e.target.parentNode.classList.toggle("header__trigger--active");
			return;
		}
		e.target.classList.toggle("header__trigger--active");
	});

	menuTrigger.addEventListener("keyup", (e) => {
		if (!e.target.classList.contains("header__trigger--active")) {
			return;
		}
		if (e.keyCode === 27) {
			e.target.classList.toggle("header__trigger--active");
			activateMenu();
		}
	});
};

const clearActiveMenu = () => {
	const activeMenuItem = document.querySelector(".menu-item--active");
	if (activeMenuItem) {
		activeMenuItem.classList.remove("menu-item--active");
	}
};

const activateSubmenu = (item) => {
	const target = item.tagName === "A" ? item.parentNode : item;
	if (target.classList.contains("menu-item--active")) {
		target.classList.remove("menu-item--active");
		return;
	}
	clearActiveMenu();
	target.classList.add("menu-item--active");
};

const handleTopLevelMenuItemClick = () => {
	const topLevelMenuItems = document.querySelectorAll(
		"#menu-main > .menu-item-has-children > a"
	);
	if (topLevelMenuItems.length > 0) {
		topLevelMenuItems.forEach((menuItem) => {
			menuItem.addEventListener("click", (e) => {
				e.preventDefault();
				activateSubmenu(e.target);
			});
			menuItem.addEventListener("keypress", (e) => {
				if (e.keyCode === 32) {
					activateSubmenu(e.target);
				}
			});
		});
	}
};

const init = () => {
	handleMenuTriggerClick();
	handleTopLevelMenuItemClick();
	addFocusTrapping();
	allowEscKey();
};

export default init;

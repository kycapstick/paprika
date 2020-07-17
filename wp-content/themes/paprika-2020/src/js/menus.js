// MAIN MENU
const activateMenu = () => {
	const menu = document.querySelector(".header-menu");
	menu.classList.toggle("header-menu--active");
};

const handleMenuTriggerClick = () => {
	const menuTrigger = document.querySelector(".header__trigger");
	menuTrigger.addEventListener("click", (e) => {
		activateMenu();
		document.body.classList.toggle("noscroll");
		if (e.target.classList.contains("header__trigger__bar")) {
			e.target.parentNode.classList.toggle("header__trigger--active");
			return;
		}
		e.target.classList.toggle("header__trigger--active");
	});
};

const clearActiveMenu = () => {
	const activeMenuItem = document.querySelector(".menu-item--active");
	if (activeMenuItem) {
		activeMenuItem.classList.remove("menu-item--active");
	}
};

const handleTopLevelMenuItemClick = () => {
	const topLevelMenuItems = document.querySelectorAll(
		"#menu-main > .menu-item-has-children > a"
	);
	if (topLevelMenuItems.length > 0) {
		topLevelMenuItems.forEach((menuItem) => {
			menuItem.addEventListener("click", (e) => {
				e.preventDefault();
				const target =
					e.target.tagName === "A" ? e.target.parentNode : e.target;
				if (target.classList.contains("menu-item--active")) {
					target.classList.remove("menu-item--active");
					return;
				}
				clearActiveMenu();
				target.classList.add("menu-item--active");
			});
		});
	}
};

const init = () => {
	handleMenuTriggerClick();
	handleTopLevelMenuItemClick();
};

export default init;

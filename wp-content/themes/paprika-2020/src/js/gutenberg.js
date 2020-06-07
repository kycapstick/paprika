//Component Blocks
import cardTitleBlock from "./blocks/reusable/card-title";
import cardTitleCopyBlock from "./blocks/reusable/card-title-copy";
import artistSelectBlock from "./blocks/reusable/select-artist";
import newsSelectBlock from "./blocks/reusable/select-news";
import finePrintBlock from "./blocks/reusable/fine-print";
import donorTitleBlock from "./blocks/reusable/donor-title";

// General Blocks
import ctaBlock from "./blocks/cta";
import twoUpCardsBlock from "./blocks/two-up-cards";

// Image Blocks
import fwImageBlock from "./blocks/full-width-image";
import masonBlock from "./blocks/mason";
import reverseMasonBlock from "./blocks/reverse-mason";
import masonThreeUpBlock from "./blocks/mason-three-up";
import masonEvenSplitBlock from "./blocks/mason-even-split";

// Homepage Blocks
import homepageCardsBlock from "./blocks/homepage-cards";

// Post Blocks
import artistBlock from "./blocks/artist";
import newsBlock from "./blocks/news";

// Donor Blocks
import donorTwoUp from "./blocks/donor-two-up";
import donorFW from "./blocks/donor-fw";

// Init Component Blocks
cardTitleBlock();
cardTitleCopyBlock();
artistSelectBlock();
newsSelectBlock();
finePrintBlock();
donorTitleBlock();

// Init General Blocks
ctaBlock();
twoUpCardsBlock();

// Init Image Blocks
fwImageBlock();
masonBlock();
reverseMasonBlock();
masonEvenSplitBlock();
masonThreeUpBlock();

// Init Homepage Blocks
homepageCardsBlock();

// Init Post Blocks
newsBlock();
artistBlock();

// Init Donor Blocks
donorTwoUp();
donorFW();

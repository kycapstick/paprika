//Component Blocks
import cardTitleBlock from "./blocks/reusable/card-title";
import cardTitleCopyBlock from "./blocks/reusable/card-title-copy";
import artistSelectBlock from "./blocks/reusable/select-artist";
import newsSelectBlock from "./blocks/reusable/select-news";
import finePrintBlock from "./blocks/reusable/fine-print";
import donorTitleBlock from "./blocks/reusable/donor-title";
import mediaTitleCopy from "./blocks/reusable/media-title-copy";
import alumnusBlock from "./blocks/reusable/alumnus-block";

// Layout Blocks
import ctaBlock from "./blocks/cta";
import twoUpCardsBlock from "./blocks/two-up-cards";
import alumniBlock from "./blocks/alumni-block";

import fwImageBlock from "./blocks/full-width-image";
import masonBlock from "./blocks/mason";
import reverseMasonBlock from "./blocks/reverse-mason";
import masonThreeUpBlock from "./blocks/mason-three-up";
import masonEvenSplitBlock from "./blocks/mason-even-split";
import homepageCardsBlock from "./blocks/homepage-cards";
import mediaQuoteBlock from "./blocks/media-quote";
import imageTextBlock from "./blocks/image-text-block";

// Post Blocks
import artistBlock from "./blocks/artist";
import newsBlock from "./blocks/news";

// Donor Blocks
import donorTwoUp from "./blocks/donor-two-up";
import donorFW from "./blocks/donor-fw";

// Show Blocks
import showBlock from "./blocks/show-block";
import teamMember from "./blocks/reusable/team-member";

// Init Component Blocks
cardTitleBlock();
cardTitleCopyBlock();
artistSelectBlock();
newsSelectBlock();
finePrintBlock();
donorTitleBlock();
mediaTitleCopy();
alumnusBlock();

// Init Layout Blocks
ctaBlock();

homepageCardsBlock();
twoUpCardsBlock();
mediaQuoteBlock();
alumniBlock();

fwImageBlock();
masonBlock();
reverseMasonBlock();
masonEvenSplitBlock();
masonThreeUpBlock();

imageTextBlock();

// Init Donor Blocks
donorTwoUp();
donorFW();

// Init Post Blocks
newsBlock();
artistBlock();

// Init Show Blocks
showBlock();
teamMember();

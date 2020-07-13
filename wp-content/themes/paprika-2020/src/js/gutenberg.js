//Component Blocks
import cardTitleBlock from "./blocks/reusable/card-title";
import cardTitleCopyBlock from "./blocks/reusable/card-title-copy";
import artistSelectBlock from "./blocks/reusable/select-artist";
import locationSelectBlock from "./blocks/reusable/selection-location";
import newsSelectBlock from "./blocks/reusable/select-news";
import finePrintBlock from "./blocks/reusable/fine-print";
import donorTitleBlock from "./blocks/reusable/donor-title";
import mediaTitleCopy from "./blocks/reusable/media-title-copy";
import alumnusBlock from "./blocks/reusable/alumnus-block";
import columnBlock from "./blocks/reusable/single-column";

// Layout Blocks
import ctaBlock from "./blocks/cta";
import twoUpCardsBlock from "./blocks/two-up-cards";
import alumniBlock from "./blocks/alumni-block";
import twoUpColumnsBlocks from "./blocks/two-up-text";

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
import artistReverseBlock from "./blocks/artist-reverse";
import newsBlock from "./blocks/news";
import locationBlock from "./blocks/location";

// Donor Blocks
import donorsBlock from "./blocks/donor-container";
import donorTwoUp from "./blocks/reusable/donor-two-up";
import donorFW from "./blocks/donor-fw";

// Show Blocks
import showBlock from "./blocks/show-block";
import teamMember from "./blocks/reusable/team-member";

// Form Blocks
import contactFormBlock from "./blocks/contact-form";
import scheduleBlock from "./blocks/schedule";
import participantBlock from "./blocks/participants";

// Init Component Blocks
cardTitleBlock();
cardTitleCopyBlock();
artistSelectBlock();
locationSelectBlock();
newsSelectBlock();
finePrintBlock();
donorTitleBlock();
mediaTitleCopy();
alumnusBlock();
columnBlock();

// Init Layout Blocks
ctaBlock();

homepageCardsBlock();
twoUpCardsBlock();
mediaQuoteBlock();
alumniBlock();
twoUpColumnsBlocks();

fwImageBlock();
masonBlock();
reverseMasonBlock();
masonEvenSplitBlock();
masonThreeUpBlock();

imageTextBlock();

// Init Donor Blocks
donorsBlock();
donorTwoUp();
donorFW();

// Init Post Blocks
newsBlock();
artistBlock();
artistReverseBlock();
locationBlock();

// Init Show Blocks
showBlock();
teamMember();

// Init Form Blocks
contactFormBlock();
scheduleBlock();
participantBlock();

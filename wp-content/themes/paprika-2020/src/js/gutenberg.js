//Component Blocks
import cardTitleBlock from "./blocks/reusable/card-title";
import cardTitleCopyBlock from "./blocks/reusable/card-title-copy";
import artistSelectBlock from "./blocks/reusable/select-artist";

// General Blocks
import ctaBlock from "./blocks/cta";
import twoUpCardsBlock from "./blocks/two-up-cards";
import artistBlock from "./blocks/artist";

// Image Blocks
import fwImageBlock from "./blocks/full-width-image";
import masonBlock from "./blocks/mason";
import reverseMasonBlock from "./blocks/reverse-mason";
import masonThreeUpBlock from "./blocks/mason-three-up";
import masonEvenSplitBlock from "./blocks/mason-even-split";

// Homepage Blocks
import homepageCardsBlock from "./blocks/homepage-cards";

// Post Blocks

import newsBlock from "./blocks/news";

// Init Component Blocks
cardTitleBlock();
cardTitleCopyBlock();
artistSelectBlock();

// Init General Blocks
ctaBlock();
twoUpCardsBlock();
artistBlock();

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

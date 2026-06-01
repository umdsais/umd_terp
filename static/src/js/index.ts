// Import main styles
// @ts-ignore
import "@universityofmaryland/web-styles-library/css/web-components.min.css";
import "@universityofmaryland/web-styles-library/css/accessibility.min.css";
import "@universityofmaryland/web-styles-library/css/animation.min.css";
import "@universityofmaryland/web-styles-library/css/element.min.css";
import "@universityofmaryland/web-styles-library/css/layout.min.css";
import "@universityofmaryland/web-styles-library/css/typography.min.css";
import "../css/index.css";;

import { initializeBundle } from "@universityofmaryland/web-components-library/bundle";
import initSubnav from "../components/subnav/subnav";
import initTableStack from "../components/table/table";

document.addEventListener("DOMContentLoaded", () => {
  try { initializeBundle(); } catch (e) { console.error('initializeBundle error:', e); }
  try { initSubnav(); } catch (e) { console.error('initSubnav error:', e); }
  try { initTableStack(); } catch (e) { console.error('initTableStack error:', e); }
});

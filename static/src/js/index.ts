// Import main styles
// @ts-ignore
import "../css/index.css";

import { initializeBundle } from "@universityofmaryland/web-components-library/bundle";
import * as Styles from "@universityofmaryland/web-styles-library";
import Tablesaw from "../components/table/table";
import initSubnav from "../components/subnav/subnav";

document.addEventListener("DOMContentLoaded", () => {
  initializeBundle();
  initSubnav();
  Tablesaw.init();

  async function createStyleSheet() {
    try {
      // Styles to load after the body - classes for layout and elements
      Styles.postRenderCss.then((css) => {
        const styleSheet = document.createElement("style");
        styleSheet.innerHTML = `${css}`;
        document.head.appendChild(styleSheet);
      });
    } catch (error) {
      console.error("error " + error);
      throw error;
    }
  }

  createStyleSheet();
});

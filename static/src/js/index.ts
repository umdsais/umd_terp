import LoadUmdComponents from "@universityofmaryland/web-components-library";
import * as Styles from "@universityofmaryland/web-styles-library";
import Tablesaw from "../components/table/table";
import initSubnav from "../components/subnav/subnav";

document.addEventListener("DOMContentLoaded", () => {
  LoadUmdComponents();
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

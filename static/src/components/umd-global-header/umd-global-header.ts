export class UMDGLobalHeader {
  private element: HTMLElement;
  private searchTrigger: HTMLButtonElement;
  private searchFormInputs: NodeListOf<HTMLInputElement>;
  private searchVisible: boolean = false;

  constructor(element: HTMLElement) {
    if (!!element) {
      this.element = element;
      this.searchTrigger = this.element.querySelector(
        'button[aria-controls="search-form"]'
      );
      this.searchFormInputs = this.element.querySelectorAll(
        "#search-form input"
      );
      this.init();
    }
  }

  private init() {
    this.searchFormInputs.forEach((input: HTMLInputElement) => {
      input.setAttribute("tabindex", "-1");
    });
    const toggleSearch = () => {
      this.searchVisible = !this.searchVisible;
      this.searchTrigger.removeAttribute("aria-hidden");
      this.searchFormInputs.forEach((input: HTMLInputElement) => {
        this.searchVisible
          ? input.removeAttribute("tabindex")
          : input.setAttribute("tabindex", "-1");
      });
    };
    this.searchTrigger.addEventListener("click", () => {
      toggleSearch();
    });
    document.addEventListener("click", (event: MouseEvent) => {
      if (this.searchVisible && !this.element.contains(event.target as Node)) {
        toggleSearch();
      }
    });
    document.addEventListener("keydown", (event) => {
      const key = event.key || event.keyCode;
      if (key === "Escape" || key === "Esc" || key === 27) {
        if (this.searchVisible) {
          toggleSearch();
        }
      }
    });
  }
}

export default function umdGlobalHeaderInit() {
  const umdGlobalHeader = document.querySelector(
    "#umdheader-main"
  ) as HTMLElement;

  new UMDGLobalHeader(umdGlobalHeader);
}

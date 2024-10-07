// Already-Made Interfaces
interface Document {
  /** Create a event listener for shortcuts */
  bindShortcut(shortcut: Shortcut, callback: (event: KeyboardEvent) => void): void;
  cookies: number
}

interface Window {
  /** Create a event listener for shortcuts */
  bindShortcut(shortcut: Shortcut, callback: (event: KeyboardEvent) => void): void;
}

interface HTMLElement {
  /** Create a event listener for shortcuts */
  bindShortcut(shortcut: Shortcut, callback: (event: KeyboardEvent) => void): void;
}

interface JQuery {
  in(timeInSecs: number): JQuery;
  scrollTo(offset?: number): JQuery;
  hasAttr(attrName: string): bool;
  isVisible(): bool;
  toHTMLElement(this: JQuery<HTMLElement>): HTMLElement | null;

  exists: bool;
  id: string | undefined,
  class: string | undefined
}

// Extended interfaces
interface NamedFunction extends Function {
  name: string; // Ensure that the function has a name
}
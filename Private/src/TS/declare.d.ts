type integer = number;
type int     = number;
type bool    = boolean;
type common  = string | int | bool | object | Array<string | int | bool>;

type ModifierKey = 'ctrl' | 'alt' | 'shift' | 'meta' | 'control' | 'windows' | 'command' | 'search';

type RegularKey = 'a' | 'b' | 'c' | 'd' | 'e' | 'f' | 'g' | 'h' | 'i' | 'j' | 'k' | 'l' | 'm' | 'n' | 'o' | 'p' | 'q' | 'r' | 's' | 't' | 'u' | 'v' | 'w' | 'x' | 'y' | 'z' | '0' | '1' | '2' | '3' | '4' | '5' | '6' | '7' | '8' | '9' | 'f1' | 'f2' | 'f3' | 'f4' | 'f5' | 'f6' | 'f7' | 'f8' | 'f9' | 'f10' | 'f11' | 'f12' | 'escape' | 'enter' | 'tab' | 'backspace' | 'delete' | 'insert' | 'home' | 'end' | 'pageup' | 'pagedown' | 'arrowup' | 'arrowdown' | 'arrowleft' | 'arrowright' | 'space' | 'plus' | 'minus' | 'equal' | 'bracketleft' | 'bracketright' | 'backslash' | 'semicolon' | 'quote' | 'comma' | 'period' | 'slash';

type Shortcut  = `${ModifierKey}+${RegularKey}` | `${ModifierKey}+${ModifierKey}+${RegularKey}` | `${ModifierKey}+${ModifierKey}+${ModifierKey}+${RegularKey}`

type MediaRules =
  | 'width'
  | 'min-width'
  | 'max-width'
  | 'height'
  | 'min-height'
  | 'max-height'
  | 'aspect-ratio'
  | 'min-aspect-ratio'
  | 'max-aspect-ratio'
  | 'orientation'
  | 'resolution'
  | 'min-resolution'
  | 'max-resolution'
  | 'color'
  | 'min-color'
  | 'max-color'
  | 'color-index'
  | 'min-color-index'
  | 'max-color-index'
  | 'monochrome'
  | 'min-monochrome'
  | 'max-monochrome'
  | 'scan'
  | 'grid'
  | 'update-frequency'
  | 'pointer'
  | 'hover'
  | 'any-pointer'
  | 'any-hover'
  | 'light-level'
  | 'prefers-color-scheme'
  | 'prefers-reduced-motion'
  | 'inverted-colors'
  | 'forced-colors'
  | 'display-mode';
type MediaValues =
  | string // For lengths (e.g., '800px'), ratios (e.g., '16/9'), resolutions (e.g., '300dpi')
  | number // For integers (e.g., color bits)
  | 'portrait'
  | 'landscape'
  | 'progressive'
  | 'interlace'
  | 'dim'
  | 'normal'
  | 'washed'
  | 'light'
  | 'dark'
  | 'no-preference'
  | 'reduce'
  | 'none'
  | 'inverted'
  | 'active'
  | 'fullscreen'
  | 'standalone'
  | 'minimal-ui'
  | 'browser'
  | 'hover'
  | 'slow'
  | 'fast'
  | 'fine'
  | 'coarse';
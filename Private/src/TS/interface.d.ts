interface Button {
  buttonText: string;
  buttonFunction: () => void;
}

interface NotificationText {
  header: string;
  message: string;
}

interface NotificationButton {
  buttonText: string;
  buttonFunction: () => any;
}

interface NotificationOptions {
  time?: number;
  width?: string;
  height?: string;
  position?: {
    top?: string;
    left?: string;
    right?: string;
    bottom?: string;
  };
}

interface Styles {
  [key: string]: string | number;
}

interface ClassData {
  code: string | null;
  subject?: string;
  link?: string;
}

interface Classes {
  [key: string]: string;
}

interface Button {
  location: string;
  text: string;
}

interface cookieString {
  link: string;
  subject: string;
  code: string;
}

interface Shortcut {
  key: string;
  action: ShortcutAction;
}

interface Date { toDayString(): string }

interface ClassJSON {
  code: string
  subject: string,
  link: string
}

declare interface Settings {
  BaseColor: string,
  Notifications: integer,
  Tooltips: boolean,
  DarkMode: boolean,
  Buttons: { [key in keyof typeof Codes]: boolean }
}
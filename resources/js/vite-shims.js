// vite-shims.js

import { Buffer } from "buffer";
// Define 'global' for packages that rely on it
if (typeof global === "undefined") {
  window.global = window;
}
if (typeof process === "undefined") {
  window.process = {
    env: {
      NODE_ENV: import.meta.env.MODE,
      // Add other required environment variables if needed
    },
  };
}
if (typeof Buffer === "undefined") {
  window.Buffer = Buffer;
}

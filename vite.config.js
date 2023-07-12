import { defineConfig } from "vite"
import laravel from "laravel-vite-plugin"
import { Buffer } from "buffer"
import { NodeGlobalsPolyfillPlugin } from "@esbuild-plugins/node-globals-polyfill"
import fs from "fs"
import path from "path"

// Define 'global' for packages

// Function to get all files from a directory
const getFiles = (dirPath, fileList = []) => {
  fs.readdirSync(dirPath).forEach((file) => {
    const absolutePath = path.join(dirPath, file)
    if (fs.statSync(absolutePath).isDirectory()) {
      fileList = getFiles(absolutePath, fileList)
    } else {
      fileList.push(absolutePath)
    }
  })
  return fileList
}

// Get all .scss and .js files
const files = getFiles("resources").filter((file) => file.endsWith(".scss") || file.endsWith(".js"))

export default defineConfig({
  assetsInclude: ["**/*.html"],
  plugins: [
    laravel({
      //  product 👇
      input: files,
      // input:[
      //   "resourcec/css/**",
      //   "resourcec/js/**"
      // ],
      refresh: true,
    }),
  ],
  optimizeDeps: {
    esbuildOptions: {
      // Node.js global to browser globalThis
      define: {
        global: "globalThis",
      },
      // Enable esbuild polyfill plugins
      plugins: [
        NodeGlobalsPolyfillPlugin({
          buffer: true,
        }),
      ],
    },
  },
})

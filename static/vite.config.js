import { defineConfig } from "vite";

export default defineConfig({
  build: {
    outDir: "./build",
    emptyOutDir: true,

    rollupOptions: {
      input: "src/js/index.ts",
      output: {
        entryFileNames: "js/index.js",
        assetFileNames: (assetInfo) => {
          if (assetInfo.name && assetInfo.name.endsWith(".css")) {
            return "css/index.css";
          }

          if (assetInfo.name) {
            if (/\.(woff|woff2|eot|ttf|otf)$/.test(assetInfo.name)) {
              return `fonts/[name].[ext]`;
            }
            if (/\.(png|jpe?g|svg|gif|webp)$/.test(assetInfo.name)) {
              return `img/[name].[ext]`;
            }
          }

          return `assets/[name].[ext]`;
        },
      },
    },
  },

  resolve: {
    alias: {
      "~bootstrap": "./node_modules/bootstrap",
      "~": "./node_modules",
    },
  },

  server: {
    open: true,
    port: 3000,
  },
});

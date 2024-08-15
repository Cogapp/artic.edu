import { defineConfig } from 'vite';
import commonjs from '@rollup/plugin-commonjs';
import { babel } from '@rollup/plugin-babel';
import path from 'path';

export default defineConfig({
  build: {
    target: 'modules',
    rollupOptions: {
      treeshake: false,
      input: [

        path.resolve(__dirname, 'frontend/js/app.js'),
        path.resolve(__dirname, 'frontend/js/blocks3D.js'),
        path.resolve(__dirname, 'frontend/js/blocks360.js'),
        path.resolve(__dirname, 'frontend/js/collectionSearch.js'),
        path.resolve(__dirname, 'frontend/js/head.js'),
        // path.resolve(__dirname, 'frontend/js/interactiveFeatures.js'),
        path.resolve(__dirname, 'frontend/js/layeredImageViewer.js'),
        path.resolve(__dirname, 'frontend/js/mirador.js'),
        path.resolve(__dirname, 'frontend/js/myMuseumTourBuilder.js'),
        path.resolve(__dirname, 'frontend/js/recaptcha.js'),
        path.resolve(__dirname, 'frontend/js/videojs.js'),
        path.resolve(__dirname, 'frontend/js/virtualTour.js'),
        path.resolve(__dirname, 'frontend/scss/app.scss'),
        path.resolve(__dirname, 'frontend/scss/html4css.scss'),
        path.resolve(__dirname, 'frontend/scss/mirador-kiosk.scss'),
        path.resolve(__dirname, 'frontend/scss/my-museum-tour-pdf.scss'),
        path.resolve(__dirname, 'frontend/scss/print.scss'),
        path.resolve(__dirname, 'frontend/scss/setup.scss'),
      ],
      output: {
        dir: 'public/dist',
        entryFileNames: 'scripts/[name].js',
        chunkFileNames: 'scripts/[name].js',
        assetFileNames: ({ name }) => {
          if (name.endsWith('.css')) {
            return 'styles/[name].[ext]';
          }

          return 'scripts/[name].[ext]';
        },
      },
    },
  },
  // Note that the order of these plugins is important.
  plugins: [
    // CommonJS was necesseary to wrap imports that were not
    // ESM compliant (i.e. didn't have any export e.g. openseadragon).
    // A more verbose (but not always practical) solution
    // for this issue would be to always use ESM.
    commonjs({
      exclude: 'node_modules/**',
    }),
    babel({
      exclude: 'node_modules/**',
      babelHelpers: 'bundled'
    }),
  ],
});

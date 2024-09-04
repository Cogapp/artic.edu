import { defineConfig } from 'vite';
import commonjs from '@rollup/plugin-commonjs';
import { babel } from '@rollup/plugin-babel';
import path from 'path';

export default defineConfig({
  build: {
    target: 'modules',
    copyPublicDir: false,
    rollupOptions: {
      treeshake: false,
      input: [
        path.resolve(__dirname, 'frontend/js/app.js'),
        path.resolve(__dirname, 'frontend/js/blocks3D.js'),
        path.resolve(__dirname, 'frontend/js/blocks360.js'),
        path.resolve(__dirname, 'frontend/js/collectionSearch.js'),
        path.resolve(__dirname, 'frontend/js/head.js'),
        path.resolve(__dirname, 'frontend/js/interactiveFeatures.js'),
        path.resolve(__dirname, 'frontend/js/layeredImageViewer.js'),
        path.resolve(__dirname, 'frontend/js/mirador.js'),
        path.resolve(__dirname, 'frontend/js/myMuseumTourBuilder.js'),
        path.resolve(__dirname, 'frontend/js/recaptcha.js'),
        path.resolve(__dirname, 'frontend/js/videojs.js'),
        path.resolve(__dirname, 'frontend/js/virtualTour.js'),
      ],
      output: {
        dir: 'public/dist/scripts',
        entryFileNames: '[name].js',
        chunkFileNames: '[name].js',
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
    // TODO: Determine if needed
    // babel({
    //   exclude: 'node_modules/**',
    //   babelHelpers: 'bundled'
    // }),
  ],
});

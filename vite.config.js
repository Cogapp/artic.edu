import { defineConfig } from 'vite';
import path from 'path';

export default defineConfig({
  build: {
    rollupOptions: {
      // treeshake: false,
      input: {
        js_app: path.resolve(__dirname, 'frontend/js/app.js'),
        // js_blocks3D: path.resolve(__dirname, 'frontend/js/blocks3D.js'),
        // js_blocks360: path.resolve(__dirname, 'frontend/js/blocks360.js'),
        // js_collectionSearch: path.resolve(__dirname, 'frontend/js/collectionSearch.js'),
        // js_head: path.resolve(__dirname, 'frontend/js/head.js'),
        // js_interactiveFeatures: path.resolve(__dirname, 'frontend/js/interactiveFeatures.js'),
        // js_layeredImageViewer: path.resolve(__dirname, 'frontend/js/layeredImageViewer.js'),
        // js_mirador: path.resolve(__dirname, 'frontend/js/mirador.js'),
        // js_recaptcha: path.resolve(__dirname, 'frontend/js/recaptcha.js'),
        // js_videojs: path.resolve(__dirname, 'frontend/js/videojs.js'),
        // js_virtualTour: path.resolve(__dirname, 'frontend/js/virtualTour.js'),
        css_app: path.resolve(__dirname, 'frontend/scss/app.scss'),
        css_html4css: path.resolve(__dirname, 'frontend/scss/html4css.scss'),
        css_miradorKiosk: path.resolve(__dirname, 'frontend/scss/mirador-kiosk.scss'),
        css_myMuseumTourPdf: path.resolve(__dirname, 'frontend/scss/my-museum-tour-pdf.scss'),
        css_print: path.resolve(__dirname, 'frontend/scss/print.scss'),
        css_setup: path.resolve(__dirname, 'frontend/scss/setup.scss'),
      },
      output: {
        entryFileNames: 'newbuild/js/[name].js',
        chunkFileNames: 'newbuild/js/[name].js',
        assetFileNames: ({ name }) => {
          if (name.endsWith('.css')) {
            return 'newbuild/css/[name].[ext]';
          }

          return 'newbuild/js/[name].[ext]';
        },
        // manualChunks: false,
        // preserveModules: true,
        // inlineDynamicImports: true,
      },
    },
  },
});

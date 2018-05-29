/*******************************
        Release Settings
*******************************/

// release settings
module.exports = {

  // path to components for repos
  source     : './dist/components/',

  // modified asset paths for component repos
  paths: {
    source : '../themes/default/assets/',
    output : 'assets/'
  },

  templates: {
    bower    : './tasks/Config/admin/templates/bower.json',
    composer : './tasks/Config/admin/templates/composer.json',
    package  : './tasks/Config/admin/templates/package.json',
    meteor   : {
      css       : './tasks/Config/admin/templates/css-package.js',
      component : './tasks/Config/admin/templates/component-package.js',
      less      : './tasks/Config/admin/templates/less-package.js',
    },
    readme : './tasks/Config/admin/templates/README.md',
    notes  : './RELEASE-NOTES.md'
  },

  org         : 'Semantic-Org',
  repo        : 'Semantic-UI',

  // files created for package managers
  files: {
    composer : 'composer.json',
    config   : 'semantic.json',
    npm      : 'package.json',
    meteor   : 'package.js'
  },

  // root name for distribution repos
  distRepoRoot      : 'Semantic-UI-',

  // root name for single component repos
  componentRepoRoot : 'UI-',

  // root name for package managers
  packageRoot          : 'semantic-ui-',

  // root path to repos
  outputRoot  : '../repos/',

  homepage    : 'http://www.semantic-ui.com',

  // distributions that get separate repos
  distributions: [
    'LESS',
    'CSS'
  ],

  // components that get separate repositories for bower/npm
  components : [
    'accordion',
    'ad',
    'api',
    'breadcrumb',
    'button',
    'card',
    'checkbox',
    'comment',
    'container',
    'dimmer',
    'divider',
    'dropdown',
    'embed',
    'feed',
    'flag',
    'form',
    'grid',
    'header',
    'icon',
    'image',
    'input',
    'item',
    'label',
    'list',
    'loader',
    'menu',
    'message',
    'modal',
    'nag',
    'popup',
    'progress',
    'rail',
    'rating',
    'reset',
    'reveal',
    'search',
    'segment',
    'shape',
    'sidebar',
    'site',
    'statistic',
    'step',
    'sticky',
    'tab',
    'table',
    'transition',
    'visibility'
  ]
};

import './bootstrap';

import.meta.glob([
    '/resources/img/**',
    '/resources/demo_img/**',
    '/resources/fonts/**',
  ]);


import '/resources/css/bootstrap.min.css';
import '/resources/css/style.css';
import '/resources/css/responsive.css';


import '/resources/js/jquery-3.2.1.min.js';
import '/resources/js/jquery.sticky-kit.min.js';
import '/resources/js/custom.js';
import '/resources/js/bootstrap.min.js';
import '/resources/js/imagesloaded.pkgd.min.js';
import '/resources/js/grid-blog.min.js';
import '/resources/js/smooth-scroll.min.js';

import Alpine from 'alpinejs';

window.Alpine = Alpine;

Alpine.start();

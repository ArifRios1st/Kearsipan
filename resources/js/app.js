require('./bootstrap');

import Alpine from 'alpinejs';
window.Alpine = Alpine;
Alpine.start();

//Datatables
require( 'datatables.net/js/jquery.dataTables.js' );
require('datatables.net-bs4/js/dataTables.bootstrap4.js');
require( 'datatables.net-buttons-bs4/js/buttons.bootstrap4.js');
require( 'datatables.net-select-bs4/js/select.bootstrap4.js');
require( 'datatables.net-buttons/js/buttons.flash.js' );
require( 'datatables.net-buttons/js/buttons.html5.js' );
require( 'datatables.net-buttons/js/buttons.print.js' );
require( 'datatables.net-buttons/js/buttons.colVis.js' );
require( '../../node_modules/pdfmake/build/pdfmake.min.js' );
require( '../../node_modules/pdfmake/build/vfs_fonts.js' );
require( '../../node_modules/jszip/dist/jszip.min.js' );

// //AdminLTE
// require('admin-lte');

//Select2
require('select2');

//Bootstrap Datepicker
require('bootstrap-datetimepicker-npm');

require('./main.js');

//AdminLTE
require('./adminlte.js');

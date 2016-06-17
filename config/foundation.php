<?php

return [

    'site' => [
        // Name of the site
        'name' => '<span class="text-orange">INO</span>Plate',

        // Short version of site name
        'short_name' => 'INO',
    ],
    'assets' => [
        'collections' => [
            'datatables' => [
                'vendor/inoplate-adminutes/vendor/datatables/css/dataTables.bootstrap.min.css',
                'vendor/inoplate-adminutes/vendor/datatables/js/jquery.dataTables.min.js',
                'vendor/inoplate-adminutes/vendor/datatables/js/dataTables.bootstrap.min.js',
                'vendor/inoplate-adminutes/vendor/datatables/extensions/buttons/js/dataTables.buttons.min.js',
                'vendor/inoplate-adminutes/vendor/datatables/extensions/select/js/dataTables.select.min.js',
                'vendor/inoplate-foundation/js/datatables.extended.js',
            ],
            'default_non_ajax' => [
                'vendor/inoplate-adminutes/vendor/pace/themes/red/pace-theme-minimal.css',
                'vendor/inoplate-adminutes/vendor/bootstrap/css/bootstrap.min.css',
                'vendor/inoplate-adminutes/vendor/font-awesome/css/font-awesome.min.css',
                'vendor/inoplate-adminutes/vendor/Ionicons/css/ionicons.min.css',
                'vendor/inoplate-adminutes/vendor/iCheck/square/blue.css',
                'vendor/inoplate-adminutes/vendor/sweetalert/sweetalert.css',
                'vendor/inoplate-adminutes/vendor/select2/select2.min.css',
                'vendor/inoplate-adminutes/css/adminutes.css',
                'vendor/inoplate-adminutes/css/skins/_all-skins.css',
                'vendor/inoplate-adminutes/vendor/pace/pace.min.js',
                'vendor/inoplate-adminutes/vendor/jQuery/jQuery-2.1.4.min.js',
                'vendor/inoplate-adminutes/vendor/bootstrap/js/bootstrap.min.js',
                'vendor/inoplate-adminutes/vendor/slimScroll/jquery.slimscroll.min.js',
                'vendor/inoplate-adminutes/vendor/fastclick/fastclick.js',
                'vendor/inoplate-adminutes/vendor/sweetalert/sweetalert.min.js',
                'vendor/inoplate-adminutes/vendor/select2/select2.js',
                'vendor/inoplate-adminutes/vendor/iCheck/icheck.min.js',
                'vendor/inoplate-adminutes/vendor/jquery-validation/jquery.validate.min.js',
                'vendor/inoplate-adminutes/vendor/jquery-validation/additional-methods.min.js',
                'vendor/inoplate-adminutes/vendor/moment/min/moment-with-locales.min.js',
                'vendor/inoplate-adminutes/vendor/moment-timezone/moment-timezone-with-data.min.js',
                'vendor/inoplate-adminutes/vendor/remarkable-bootstrap-notify/bootstrap-notify.min.js',
                'vendor/inoplate-adminutes/js/adminlte.min.js',
                'vendor/inoplate-adminutes/js/adminutes.js',
                'vendor/inoplate-foundation/js/inoplate.js'
            ]
        ],
    ],
    'ping' => 300000, // ping interval in mili seconds
];
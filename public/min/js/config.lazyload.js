// lazyload config

angular.module('app')
    /**
   * jQuery plugin config use ui-jq directive , config the js and css files that required
   * key: function name of the jQuery plugin
   * value: array of the css js file located
   */
  .constant('JQ_CONFIG', {
      easyPieChart:   [   '/public/min/libs/jquery/jquery.easy-pie-chart/dist/jquery.easypiechart.fill.js'],
      sparkline:      [   '/public/min/libs/jquery/jquery.sparkline/dist/jquery.sparkline.retina.js'],
      plot:           [   '/public/min/libs/jquery/flot/jquery.flot.js',
                          '/public/min/libs/jquery/flot/jquery.flot.pie.js', 
                          '/public/min/libs/jquery/flot/jquery.flot.resize.js',
                          '/public/min/libs/jquery/flot.tooltip/js/jquery.flot.tooltip.min.js',
                          '/public/min/libs/jquery/flot.orderbars/js/jquery.flot.orderBars.js',
                          '/public/min/libs/jquery/flot-spline/js/jquery.flot.spline.min.js'],
      moment:         [   '/public/min/libs/jquery/moment/moment.js',
                          '/public/min/libs/jquery/moment/moment-with-locales.js',
                          '/public/min/libs/jquery/moment/moment-use-zhcn.js'],
      screenfull:     [   '/public/min/libs/jquery/screenfull/dist/screenfull.min.js'],
      slimScroll:     [   '/public/min/libs/jquery/slimscroll/jquery.slimscroll.min.js'],
      sortable:       [   '/public/min/libs/jquery/html5sortable/jquery.sortable.js'],
      nestable:       [   '/public/min/libs/jquery/nestable/jquery.nestable.js',
                          '/public/min/libs/jquery/nestable/jquery.nestable.css'],
      filestyle:      [   '/public/min/libs/jquery/bootstrap-filestyle/src/bootstrap-filestyle.js'],
      slider:         [   '/public/min/libs/jquery/bootstrap-slider/bootstrap-slider.js',
                          '/public/min/libs/jquery/bootstrap-slider/bootstrap-slider.css'],
      chosen:         [   '/public/min/libs/jquery/chosen/chosen.jquery.min.js',
                          '/public/min/libs/jquery/chosen/bootstrap-chosen.css'],
      TouchSpin:      [   '/public/min/libs/jquery/bootstrap-touchspin/dist/jquery.bootstrap-touchspin.min.js',
                          '/public/min/libs/jquery/bootstrap-touchspin/dist/jquery.bootstrap-touchspin.min.css'],
      wysiwyg:        [   '/public/min/libs/jquery/bootstrap-wysiwyg/bootstrap-wysiwyg.js',
                          '/public/min/libs/jquery/bootstrap-wysiwyg/external/jquery.hotkeys.js'],
      dataTable:      [   '/public/min/libs/jquery/datatables/media/js/jquery.dataTables.min.js',
                          '/public/min/libs/jquery/plugins/integration/bootstrap/3/dataTables.bootstrap.js',
                          '/public/min/libs/jquery/plugins/integration/bootstrap/3/dataTables.bootstrap.css'],
      vectorMap:      [   '/public/min/libs/jquery/bower-jvectormap/jquery-jvectormap-1.2.2.min.js', 
                          '/public/min/libs/jquery/bower-jvectormap/jquery-jvectormap-world-mill-en.js',
                          '/public/min/libs/jquery/bower-jvectormap/jquery-jvectormap-cn-mill-en.js',
                          '/public/min/libs/jquery/bower-jvectormap/jquery-jvectormap-us-aea-en.js',
                          '/public/min/libs/jquery/bower-jvectormap/jquery-jvectormap.css'],
      footable:       [   '/public/min/libs/jquery/footable/v3/js/footable.js',
                          '/public/min/libs/jquery/footable/v3/css/footable.bootstrap.min.css'],
      fullcalendar:   [   '/public/min/libs/jquery/moment/moment.js',
                          '/public/min/libs/jquery/fullcalendar/dist/fullcalendar.min.js',
                          '/public/min/libs/jquery/fullcalendar/dist/fullcalendar.css',
                          '/public/min/libs/jquery/fullcalendar/dist/fullcalendar.theme.css'],
      daterangepicker:[   '/public/min/libs/jquery/moment/moment.js',
                          '/public/min/libs/jquery/moment/moment-with-locales.js',
                          '/public/min/libs/jquery/bootstrap-daterangepicker/daterangepicker.js',
                          '/public/min/libs/jquery/bootstrap-daterangepicker/daterangepicker-bs3.css'],
      tagsinput:      [   '/public/min/libs/jquery/bootstrap-tagsinput/dist/bootstrap-tagsinput.js',
                          '/public/min/libs/jquery/bootstrap-tagsinput/dist/bootstrap-tagsinput.css']
                      
    }
  )
  .constant('MODULE_CONFIG', [
      {
          name: 'ngGrid',
          files: [
              '/public/min/libs/angular/ng-grid/build/ng-grid.min.js',
              '/public/min/libs/angular/ng-grid/ng-grid.min.css',
              '/public/min/libs/angular/ng-grid/ng-grid.bootstrap.css'
          ]
      },
      {
          name: 'ui.grid',
          files: [
              '/public/min/libs/angular/angular-ui-grid/ui-grid.min.js',
              '/public/min/libs/angular/angular-ui-grid/ui-grid.min.css',
              '/public/min/libs/angular/angular-ui-grid/ui-grid.bootstrap.css'
          ]
      },
      {
          name: 'ui.select',
          files: [
              '/public/min/libs/angular/angular-ui-select/dist/select.min.js',
              '/public/min/libs/angular/angular-ui-select/dist/select.min.css'
          ]
      },
      {
          name:'angularFileUpload',
          files: [
            '/public/min/libs/angular/angular-file-upload/angular-file-upload.js'
          ]
      },
      {
          name:'ui.calendar',
          files: ['/public/min/libs/angular/angular-ui-calendar/src/calendar.js']
      },
      {
          name: 'ngImgCrop',
          files: [
              '/public/min/libs/angular/ngImgCrop/compile/minified/ng-img-crop.js',
              '/public/min/libs/angular/ngImgCrop/compile/minified/ng-img-crop.css'
          ]
      },
      {
          name: 'angularBootstrapNavTree',
          files: [
              '/public/min/libs/angular/angular-bootstrap-nav-tree/dist/abn_tree_directive.js',
              '/public/min/libs/angular/angular-bootstrap-nav-tree/dist/abn_tree.css'
          ]
      },
      {
          name: 'toaster',
          files: [
              '/public/min/libs/angular/angularjs-toaster/toaster.js',
              '/public/min/libs/angular/angularjs-toaster/toaster.css'
          ]
      },
      {
          name: 'textAngular',
          files: [
              '/public/min/libs/angular/textAngular/dist/textAngular-sanitize.min.js',
              '/public/min/libs/angular/textAngular/dist/textAngular.min.js'
          ]
      },
      {
          name: 'vr.directives.slider',
          files: [
              '/public/min/libs/angular/venturocket-angular-slider/build/angular-slider.js',
              '/public/min/libs/angular/venturocket-angular-slider/build/angular-slider.css'
          ]
      },
      {
          name: 'com.2fdevs.videogular',
          files: [
              '/public/min/libs/angular/videogular/videogular.min.js'
          ]
      },
      {
          name: 'com.2fdevs.videogular.plugins.controls',
          files: [
              '/public/min/libs/angular/videogular-controls/controls.min.js'
          ]
      },
      {
          name: 'com.2fdevs.videogular.plugins.buffering',
          files: [
              '/public/min/libs/angular/videogular-buffering/buffering.min.js'
          ]
      },
      {
          name: 'com.2fdevs.videogular.plugins.overlayplay',
          files: [
              '/public/min/libs/angular/videogular-overlay-play/overlay-play.min.js'
          ]
      },
      {
          name: 'com.2fdevs.videogular.plugins.poster',
          files: [
              '/public/min/libs/angular/videogular-poster/poster.min.js'
          ]
      },
      {
          name: 'com.2fdevs.videogular.plugins.imaads',
          files: [
              '/public/min/libs/angular/videogular-ima-ads/ima-ads.min.js'
          ]
      },
      {
          name: 'xeditable',
          files: [
              '/public/min/libs/angular/angular-xeditable/dist/js/xeditable.min.js',
              '/public/min/libs/angular/angular-xeditable/dist/css/xeditable.css'
          ]
      },
      {
          name: 'smart-table',
          files: [
              '/public/min/libs/angular/angular-smart-table/dist/smart-table.min.js'
          ]
      },
      {
          name: 'angular-skycons',
          files: [
              '/public/min/libs/angular/angular-skycons/angular-skycons.js'
          ]
      }
    ]
  )
  // oclazyload config
  .config(['$ocLazyLoadProvider', 'MODULE_CONFIG', function($ocLazyLoadProvider, MODULE_CONFIG) {
      // We configure ocLazyLoad to use the lib script.js as the async loader
      $ocLazyLoadProvider.config({
          debug:  false,
          events: true,
          modules: MODULE_CONFIG
      });
  }])
;

<!doctype html>

<html lang="en">
   <head>
      <meta charset="utf-8"/>
      <meta name="viewport" content="width=device-width, initial-scale=1, viewport-fit=cover"/>
      <meta http-equiv="X-UA-Compatible" content="ie=edge"/>
      <title>@yield('title')</title>
      <link rel="icon" href="{{asset('img/logo/harbour.png')}}" type="image/x-icon"/>
      <!-- CSS files -->
      <link href="{{asset('tabler/css/tabler.min.css')}}" rel="stylesheet"/>
      <link href="{{asset('tabler/css/tabler-flags.min.css')}}" rel="stylesheet"/>
      <link href="{{asset('tabler/css/tabler-payments.min.css')}}" rel="stylesheet"/>
      <link href="{{asset('tabler/css/tabler-vendors.min.css')}}" rel="stylesheet"/>
      <link href="{{asset('tabler/css/demo.min.css')}}" rel="stylesheet"/>
      {{-- <link rel="stylesheet" href="{{asset('css/azzara.min.css')}}"> --}}
      <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />

      {{-- <link href="{{asset('css/bootstrap.min.css')}}" rel="stylesheet"/> --}}
      <link rel="stylesheet" href="https://cdn.datatables.net/1.13.2/css/dataTables.bootstrap4.min.css" rel="stylesheet">
      <link href='https://api.mapbox.com/mapbox-gl-js/v2.0.0/mapbox-gl.css' rel='stylesheet' />
      <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/2.3.2/css/dataTables.dataTables.min.css">
      
   </head>
   <body class="bg-white">
      <div class="wrapper" >
         <div class="sticky-top">
            <header class="navbar navbar-expand-md navbar-light sticky-top d-print-none">
               <div class="px-2 py-1">
                  <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbar-menu">
                     <span class="navbar-toggler-icon"></span>
                  </button>
                  {{-- navbar-brand-autodark  --}}
                  {{-- <h2 class="font-weight-bold font-italic text-primary">MY ENC</h2> --}}
                  <button type="button" class="btn btn-light" onclick="javascript:window.print();">
                     <!-- Download SVG icon from http://tabler-icons.io/i/printer -->
                     <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                        <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                        <path d="M17 17h2a2 2 0 0 0 2 -2v-4a2 2 0 0 0 -2 -2h-14a2 2 0 0 0 -2 2v4a2 2 0 0 0 2 2h2" />
                        <path d="M17 9v-4a2 2 0 0 0 -2 -2h-6a2 2 0 0 0 -2 2v4" />
                        <rect x="7" y="13" width="10" height="8" rx="2" />
                     </svg>
                     Print / Save to PDF
                  </button>
               </div>
            </header>
         </div>
         

         <div class="page-wrapper" style="min-height: 100vh">
            @yield('content')
            
            <footer class="footer footer-transparent d-print-none">
               <div class="container-xl">
                  <div class="row text-center align-items-center flex-row-reverse">
                     <div class="col-lg-auto ms-lg-auto">
                     <ul class="list-inline list-inline-dots mb-0">
                        <li class="list-inline-item"><a href="./docs/index.html" class="link-secondary">MY ENC v1.0.0-beta</a></li>
                        
                     </ul>
                     </div>
                     <div class="col-12 col-lg-auto mt-3 mt-lg-0">
                     <ul class="list-inline list-inline-dots mb-0">
                        <li class="list-inline-item">
                           Copyright &copy; 2023
                           <a href="." class="link-secondary">ENC Development</a>.
                           All rights reserved.
                        </li>
                        
                     </ul>
                     </div>
                  </div>
               </div>
            </footer>
         </div>
      </div>

      <script src="{{asset('js/core/jquery.3.2.1.min.js')}}"></script>
      <script src="{{asset('tabler/js/datatables/datatables.min.js')}}"></script>
       <!--   Core JS Files   -->
      <script src="{{asset('js/core/jquery.3.2.1.min.js')}}"></script>
      <script src="{{asset('js/core/popper.min.js')}}"></script>
      <script src="{{asset('js/core/bootstrap.min.js')}}"></script>

      <!-- jQuery UI -->
      <script src="{{asset('js/plugin/jquery-ui-1.12.1.custom/jquery-ui.min.js')}}"></script>
      <script src="{{asset('js/plugin/jquery-ui-touch-punch/jquery.ui.touch-punch.min.js')}}"></script>

      
      <!-- Libs JS -->
      <script src="{{asset('tabler/libs/apexcharts/dist/apexcharts.min.js')}}"></script>
      <!-- Tabler Core -->
      <script src="{{asset('tabler/js/tabler.min.js')}}"></script>
      <script src="{{asset('tabler/js/demo.min.js')}}"></script>
      <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
      <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

      <script src='https://api.mapbox.com/mapbox-gl-js/v2.0.0/mapbox-gl.js'></script>
      <script src="https://unpkg.com/supercluster@7.1.2/dist/supercluster.min.js"></script>
      


      <!-- Moment JS -->
      <script src="{{asset('js/plugin/moment/moment.min.js')}}"></script>

      <!-- Chart JS -->
      <script src="{{asset('js/plugin/chart.js/chart.min.js')}}"></script>

      <!-- jQuery Sparkline -->
      <script src="{{asset('js/plugin/jquery.sparkline/jquery.sparkline.min.js')}}"></script>
      <!-- Datatables -->
      <script src="{{asset('js/plugin/datatables/datatables.min.js')}}"></script>

      <!-- Chart Circle -->
      <script src="{{asset('js/plugin/chart-circle/circles.min.js')}}"></script>
      <script >


         $(document).ready(function() {

            $(document).ready( function () {
               $('#myTable').DataTable();
            } );
            
            $('.select2').select2({});
            $('.select2b').select2({});
            $('.js-example-basic-multiple').select2();
            $('#material_usage').select2({});
            // $('.select2b').select2({});
            $('.js-example-basic-single').select2({});
            $('.example-select2').select2({});

            $('#employee_abs').select2({
               dropdownParent: $('#modal-report-absensi-karyawan'),
               width: '100%',
               minimumResultsForSearch: 0 // force search appear
            });

            $('#employee_spkl').select2({
               dropdownParent: $('#modal-report-spkl-karyawan'),
               width: '100%',
               minimumResultsForSearch: 0 // force search appear
            });

            $('#employee_allowance').select2({
               dropdownParent: $('#modal-add-allowance-employee-kompensasi'),
               width: '100%',
               minimumResultsForSearch: 0 // force search appear
            });

            $('#employee_allowance_b').select2({
               dropdownParent: $('#modal-add-allowance-employee-duka'),
               width: '100%',
               minimumResultsForSearch: 0 // force search appear
            });

            $('#employee_allowance_c').select2({
               dropdownParent: $('#modal-add-allowance-employee-lahir'),
               width: '100%',
               minimumResultsForSearch: 0 // force search appear
            });

            $('.basic-datatables-plain').DataTable( {
               "lengthMenu": [[5,8, 10, 15, 25, 50, 100 , -1], [5,8, 10, 15, 25, 50, 100, "All"]],
               "pageLength": 10,
               "ordering": false
              
            });

            $('.basic-datatables-plain-b').DataTable( {
               "lengthMenu": [[5,8, 10, 15, 25, 50, 100 , -1], [5,8, 10, 15, 25, 50, 100, "All"]],
               "pageLength": -1,
               "order": [
                  [1, 'asc']
               ],
              
            });


            $('.basic-datatables').DataTable( {
               "lengthMenu": [[5,8, 10, 15, 25, 50, 100 , -1], [5,8, 10, 15, 25, 50, 100, "All"]],
               "pageLength": 10,
               "ordering": true,
              
            });


            $('.datatables-14').DataTable( {
               "lengthMenu": [[5,8, 10, 15, 25, 50, 100 , -1], [5,8, 10, 15, 25, 50, 100, "All"]],
               "pageLength": 10,
               "ordering": true,
               "order": [
                  [13, 'desc']
               ],
              
            });
            $('.datatables-abs').DataTable( {
               "lengthMenu": [[5,8, 10, 15, 25, 50, 100 , -1], [5,8, 10, 15, 25, 50, 100, "All"]],
               "pageLength": 10,
               "ordering": true,
               "order": [
                  [4, 'desc']
               ],
            
            });

            $('.datatables-spkl').DataTable( {
               "lengthMenu": [[5,8, 10, 15, 25, 50, 100 , -1], [5,8, 10, 15, 25, 50, 100, "All"]],
               "pageLength": 10,
               "ordering": true,
               "order": [
                  [4, 'desc']
               ],
            
            });

            $('.datatables-11').DataTable( {
               "lengthMenu": [[5,8, 10, 15, 25, 50, 100 , -1], [5,8, 10, 15, 25, 50, 100, "All"]],
               "pageLength": 10,
               "ordering": true,
               "order": [
                  [11, 'desc']
               ],
               
            });

            $('.datatables-10').DataTable( {
               "lengthMenu": [[5,8, 10, 15, 25, 50, 100 , -1], [5,8, 10, 15, 25, 50, 100, "All"]],
               "pageLength": 10,
               "ordering": true,
               "order": [
                  [2, 'asc'],[10, 'asc']
               ],
               
            });

            $('.datatables-5').DataTable( {
               "lengthMenu": [[5,8, 10, 15, 25, 50, 100 , -1], [5,8, 10, 15, 25, 50, 100, "All"]],
               "pageLength": 10,
               "ordering": true,
               "order": [
                  [5, 'desc']
               ],
            
            });

            $('.datatables-8').DataTable( {
               "lengthMenu": [[5,8, 10, 15, 25, 50, 100 , -1], [5,8, 10, 15, 25, 50, 100, "All"]],
               "pageLength": 10,
               "ordering": true,
               "order": [
                  [8, 'desc']
               ],
            
            });

            $('.datatables-7').DataTable( {
               "lengthMenu": [[5,8, 10, 15, 25, 50, 100 , -1], [5,8, 10, 15, 25, 50, 100, "All"]],
               "pageLength": 10,
               "ordering": true,
               "order": [
                  [7, 'desc']
               ],
            
            });

            $('.datatables-6').DataTable( {
               "lengthMenu": [[5,8, 10, 15, 25, 50, 100 , -1], [5,8, 10, 15, 25, 50, 100, "All"]],
               "pageLength": 10,
               "ordering": true,
               "order": [
                  [6, 'desc']
               ],
            
            });


            $('.datatables-4').DataTable( {
               "lengthMenu": [[5,8, 10, 15, 25, 50, 100 , -1], [5,8, 10, 15, 25, 50, 100, "All"]],
               "pageLength": 10,
               "ordering": true,
               "order": [
                  [4, 'desc']
               ],
            
            });

            $('.datatables-3').DataTable( {
               "lengthMenu": [[5,8, 10, 15, 25, 50, 100 , -1], [5,8, 10, 15, 25, 50, 100, "All"]],
               "pageLength": 10,
               "ordering": true,
               "order": [
                  [3, 'desc']
               ],
            
            });

            $('.datatables-2').DataTable( {
               "lengthMenu": [[5,8, 10, 15, 25, 50, 100 , -1], [5,8, 10, 15, 25, 50, 100, "All"]],
               "pageLength": 10,
               "ordering": true,
               "order": [
                  [2, 'desc']
               ],
            
            });

            $('.datatables-1').DataTable( {
               "lengthMenu": [[5,8, 10, 15, 25, 50, 100 , -1], [5,8, 10, 15, 25, 50, 100, "All"]],
               "pageLength": 10,
               "ordering": true,
               "order": [
                  [1, 'asc']
               ],
            
            });

            $('.basic-datatables-14').DataTable( {
               "lengthMenu": [[5,8, 10, 15, 25, 50, 100 , -1], [5,8, 10, 15, 25, 50, 100, "All"]],
               "pageLength": 10,
               "ordering": true,
               "order": [
                  [14, 'desc']
               ],
            
            });


            $('.datatables-0').DataTable( {
               "lengthMenu": [[5,8, 10, 15, 25, 50, 100 , -1], [5,8, 10, 15, 25, 50, 100, "All"]],
               "pageLength": 10,
               "ordering": true,
               "order": [
                  [0, 'desc']
               ],
            
            });

            

            // Add Row
            $('#add-row').DataTable({
               "pageLength": 5,
            });

            var action = '<td> <div class="form-button-action"> <button type="button" data-toggle="tooltip" title="" class="btn btn-link btn-primary btn-lg" data-original-title="Edit Task"> <i class="fa fa-edit"></i> </button> <button type="button" data-toggle="tooltip" title="" class="btn btn-link btn-danger" data-original-title="Remove"> <i class="fa fa-times"></i> </button> </div> </td>';

            $('#addRowButton').click(function() {
               $('#add-row').dataTable().fnAddData([
                     $("#addName").val(),
                     $("#addPosition").val(),
                     $("#addOffice").val(),
                     action
                     ]);
               $('#addRowModal').modal('hide');

            });
         });
      </script>
      
      @stack('js_footer')
   </body>
</html>
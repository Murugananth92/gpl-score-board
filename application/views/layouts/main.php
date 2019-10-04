<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>GPL</title>
        <!-- Tell the browser to be responsive to screen width -->
        <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
        <!-- Bootstrap 3.4.1 -->
        <link rel="stylesheet" href="<?php echo site_url('resources/css/bootstrap.min.css');?>">
        <!-- Font Awesome -->
        <link rel="stylesheet" href="<?php echo site_url('resources/css/font-awesome.min.css');?>">
        <!-- Ionicons -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">
        <!-- Datetimepicker -->
        <link rel="stylesheet" href="<?php echo site_url('resources/css/bootstrap-datetimepicker.min.css');?>">
        <!-- Theme style -->
		<link rel="stylesheet" href="<?php echo site_url('resources/css/AdminLTE.min.css');?>">
		<!-- Theme style -->
        <link rel="stylesheet" href="<?php echo site_url('resources/select2/dist/css/select2.min.css');?>">	
        <!-- AdminLTE Skins. Choose a skin from the css/skins
             folder instead of downloading all of them to reduce the load. -->
        <link rel="stylesheet" href="<?php echo site_url('resources/css/_all-skins.min.css');?>">
        <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.20/css/dataTables.bootstrap.min.css">

        <link rel="stylesheet" href="<?php echo site_url('resources/css/chosen.css');?>">
      
    </head>
    
    <body class="hold-transition skin-blue sidebar-mini">
         <!-- jQuery 3.4.1 -->
         <script src="<?php echo site_url('resources/js/jquery.min.js');?>"></script>
        
        <div class="wrapper">
            <header class="main-header">
                <!-- Logo -->
                <a href="" class="logo">
                    <!-- mini logo for sidebar mini 50x50 pixels -->
                    <span class="logo-mini">GPL</span>
                    <!-- logo for regular state and mobile devices -->
                    <span class="logo-lg">GPL</span>
                </a>
                <!-- Header Navbar: style can be found in header.less -->
                <nav class="navbar navbar-static-top">
                    <!-- Sidebar toggle button-->
                    <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </a>

                    <div class="navbar-custom-menu">
                        <ul class="nav navbar-nav">
                        <!-- User Account: style can be found in dropdown.less -->
                            <li class="dropdown user user-menu">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                    <img src="<?php echo site_url('resources/img/user2-160x160.jpg');?>" class="user-image" alt="User Image">
                                    <span class="hidden-xs">Alexander Pierce</span>
                                </a>
                                <ul class="dropdown-menu">
                                    <!-- User image -->
                                    <li class="user-header">
                                        <img src="<?php echo site_url('resources/img/user2-160x160.jpg');?>" class="img-circle" alt="User Image">

                                    <p>
                                        Alexander Pierce - Web Developer
                                        <small>Member since Nov. 2012</small>
                                    </p>
                                    </li>
                                    <!-- Menu Footer-->
                                    <li class="user-footer">
                                        <div class="pull-left">
                                            <a href="#" class="btn btn-default btn-flat">Profile</a>
                                        </div>
                                        <div class="pull-right">
											<form action="<?=site_url('logout')?>" method="POST">
											<a><button class="btn btn-default btn-flat" type="submit">Sign out</button></a>
											</form>
                                        </div>
                                    </li>
                                </ul>
                            </li>
                        </ul>
                    </div>
                </nav>
            </header>
            <!-- Left side column. contains the logo and sidebar -->
            <aside class="main-sidebar">
                <!-- sidebar: style can be found in sidebar.less -->
                <section class="sidebar">
                    <!-- Sidebar user panel -->
                    <div class="user-panel">
                        <div class="pull-left image">
                            <img src="<?php echo site_url('resources/img/user2-160x160.jpg');?>" class="img-circle" alt="User Image">
                        </div>
                        <div class="pull-left info">
                            <p>Alexander Pierce</p>
                            <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
                        </div>
                    </div>
                    <!-- sidebar menu: : style can be found in sidebar.less -->
                    <ul class="sidebar-menu">
                        <li class="header">NAVIGATION MENU</li>
                        <li>
                            <a href="<?php echo site_url('dashboard')?>">
                                <i class="fa fa-dashboard"></i> <span>Dashboard</span>
                            </a>
						</li>
						<li>
                            <a href="<?php echo site_url('start_match')?>">
                                <i class="fa fa-tasks"></i> <span>Start Match</span>
                            </a>
						</li>
						<li>
                            <a href="<?php echo site_url('player/index');?>"><i class="fa fa-list-ul"></i>Player Listing</a>
                        </li>
						<li>
                            <a href="<?php echo site_url('user/index');?>"><i class="fa fa-list-ul"></i>User Listing</a>
                        </li>
                        <li>
                            <a href="<?php echo site_url('team/index');?>"><i class="fa fa-list-ul"></i>Team Listing</a>
                        </li>
                        <li>
                            <a href="<?php echo site_url('tournament/index');?>"><i class="fa fa-list-ul"></i>tournament Listing</a>
                        </li>
                        <li>
                            <a href="<?php echo site_url('tournament_team/index');?>"><i class="fa fa-list-ul"></i>tournament team Listing</a>
                        </li>
                        <li>
                            <a href="<?php echo site_url('tournament_player/index');?>"><i class="fa fa-list-ul"></i>tournament players Listing</a>
                        </li>
                        <li>
                            <a href="<?php echo site_url('group/index');?>"><i class="fa fa-list-ul"></i>group Listing</a>
                        </li>
                        <li>
                            <a href="<?php echo site_url('group_point/index');?>"><i class="fa fa-list-ul"></i>group_points Listing</a>
                        </li>
                    </ul>
                </section>
                <!-- /.sidebar -->
            </aside>

            <!-- Content Wrapper. Contains page content -->
            <div class="content-wrapper">
                <!-- Main content -->
                <section class="content">
                    <?php                    
                    if(isset($_view) && $_view)
                        $this->load->view($_view);
                    ?>                    
                </section>
                <!-- /.content -->
            </div>
            <!-- /.content-wrapper -->
            <footer class="main-footer">
                <strong>GPL <a>@CG-Vak India Ltd</a></strong>
            </footer>

            <!-- Control Sidebar -->
            <aside class="control-sidebar control-sidebar-dark">
                <!-- Create the tabs -->
                <ul class="nav nav-tabs nav-justified control-sidebar-tabs">
                    
                </ul>
                <!-- Tab panes -->
                <div class="tab-content">
                    <!-- Home tab content -->
                    <div class="tab-pane" id="control-sidebar-home-tab">

                    </div>
                    <!-- /.tab-pane -->
                    <!-- Stats tab content -->
                    <div class="tab-pane" id="control-sidebar-stats-tab">Stats Tab Content</div>
                    <!-- /.tab-pane -->
                    
                </div>
            </aside>
            <!-- Add the sidebar's background. This div must be placed
            immediately after the control sidebar -->
            <div class="control-sidebar-bg"></div>
        </div>

       
        <!-- Bootstrap 3.4.1 -->
        <script src="<?php echo site_url('resources/js/bootstrap.min.js');?>"></script>
        <!-- FastClick -->
        <script src="<?php echo site_url('resources/js/fastclick.js');?>"></script>
        <!-- AdminLTE App -->
        <script src="<?php echo site_url('resources/js/app.min.js');?>"></script>
        <!-- AdminLTE for demo purposes -->
        <script src="<?php echo site_url('resources/js/demo.js');?>"></script>
        <!-- DatePicker -->
        <script src="<?php echo site_url('resources/js/moment.js');?>"></script>
		<script src="<?php echo site_url('resources/js/bootstrap-datetimepicker.min.js');?>"></script>
		<script src="<?php echo site_url('resources/select2/dist/js/select2.min.js');?>"></script>
        <script src="<?php echo site_url('resources/js/global.js');?>"></script>
        <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script>
        <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.20/js/dataTables.bootstrap.min.js"></script>
        <script src="<?php echo site_url('resources/js/chosen.jquery.js');?>"></script>

        
        
        <script>
            var max_selected_options_val = 15;
                var $chosen = $('.chosen-select').chosen({
                max_selected_options: max_selected_options_val
                });

                $chosen.change(function () {
                var $this = $(this);
                var chosen = $this.data('chosen');
                var search = chosen.search_container.find('input[type="text"]');
                
                search.prop('disabled', $this.val() !== null);
                
                if (chosen.active_field) {
                    search.focus();
                }
                });



                $(document).ready( function () {

                $('#dataTable').dataTable( {
                    "columnDefs": [ {
                    "targets": 'no-sort',
                    "orderable": false,
                } ]
            } );

            } );
        </script>
    </body>
</html>

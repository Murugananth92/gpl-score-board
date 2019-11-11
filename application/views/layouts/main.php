<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>GPL</title>
	<meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
	<link rel="stylesheet" href="<?php echo site_url('resources/css/bootstrap.min.css');?>">
	<link rel="stylesheet" href="<?php echo site_url('resources/css/font-awesome.min.css');?>">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">
	<link rel="stylesheet" href="<?php echo site_url('resources/css/bootstrap-datetimepicker.min.css');?>">
	<link rel="stylesheet" href="<?php echo site_url('resources/css/AdminLTE.min.css');?>">
	<link rel="stylesheet" href="<?php echo site_url('resources/select2/dist/css/select2.min.css');?>">
	<link rel="stylesheet" href="<?php echo site_url('resources/css/_all-skins.min.css');?>">
	<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.20/css/dataTables.bootstrap.min.css">
	<link rel="stylesheet" href="<?php echo site_url('resources/css/chosen.css');?>">
	<link rel="stylesheet" type="text/css" href="<?php echo site_url('resources/css/style.css');?>">
	<link rel="stylesheet" type="text/css" href="<?php echo site_url('resources/css/sweetalert2.css');?>">
	<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/responsive/1.0.4/css/dataTables.responsive.css">
	<!-- disableing the browser back button -->
	<script type="text/javascript">
		history.pushState(null, null, location.href);
		window.onpopstate = function () {
			history.go(1);
		};
		document.addEventListener('contextmenu', event => event.preventDefault());// prevent right click
	</script>
</head>
<body class="hold-transition skin-blue sidebar-mini">
<script src="<?php echo site_url('resources/js/jquery.min.js');?>"></script>

<div class="wrapper">
	<header class="main-header">
		<a href="javascript:;" class="logo hidden-xs">
			<span class="logo-mini">GPL</span>
			<span class="logo-lg">GPL</span>
		</a>
		<nav class="navbar navbar-static-top">
			<a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
				<span class="sr-only">Toggle navigation</span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
			</a>
			<div class="navbar-custom-menu">
				<ul class="nav navbar-nav">
					<li class="dropdown user user-menu">
						<a href="#" class="dropdown-toggle" data-toggle="dropdown">
							<img src="<?php echo site_url('resources/img/user.jpeg');?>" class="user-image" alt="User Image">
							<span class="hidden-xs">Administrator</span>
						</a>
						<ul class="dropdown-menu">
							<li class="user-header">
								<img src="<?php echo site_url('resources/img/user.jpeg');?>" class="img-circle" alt="User Image">
								<p>
									Administrator
									<small>GreatMindz Premier League</small>
								</p>
							</li>
							<li class="user-footer">
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
	<aside class="main-sidebar">
		<section class="sidebar">
			<div class="user-panel">
				<div class="pull-left image">
					<img src="<?php echo site_url('resources/img/user.jpeg');?>" class="img-circle" alt="User Image">
				</div>
				<div class="pull-left info">
					<p>Administrator</p>
					<a href="#"><i class="fa fa-circle text-success"></i> Online</a>
				</div>
			</div>
			<ul class="sidebar-menu">
				<li class="header">NAVIGATION MENU</li>
				<li>
					<a href="<?php echo site_url('dashboard')?>">
						<i class="fa fa-dashboard"></i> <span>Dashboard</span>
					</a>
				</li>
				<li>
					<a href="<?php echo site_url('livescore_display')?>">
						<i class="fa fa-th"></i> <span>Live score</span>
					</a>
				</li>
				<li>
					<a href="<?php echo site_url('matches')?>">
						<i class="fa fa-th"></i> <span>Matches</span>
					</a>
				</li>
				<li>
					<a href="<?php echo site_url('player');?>"><i class="fa fa-male"></i><span>Players</span></a>
				</li>
				<li>
					<a href="<?php echo site_url('user');?>"><i class="fa fa-user"></i><span>Users</span></a>
				</li>
				<li>
					<a href="<?php echo site_url('team');?>"><i class="fa fa-user-o"></i><span>Teams</span></a>
				</li>
				<li>
					<a href="<?php echo site_url('tournament');?>"><i class="fa fa-calendar-o"></i><span>Tournaments</span></a>
				</li>
				<li>
					<a href="<?php echo site_url('tournament_team');?>"><i class="fa fa-th-large"></i><span>Tournament Teams</span></a>
				</li>
				<li>
					<a href="<?php echo site_url('tournament_player');?>"><i class="fa fa-vcard-o"></i><span>Tournament Players</span></a>
				</li>
				<li>
					<a href="<?php echo site_url('group');?>"><i class="fa fa-users"></i><span>Groups</span></a>
				</li>
				<li>
					<a href="<?php echo site_url('group_point');?>"><i class="fa fa-bar-chart"></i><span>Group Points</span></a>
				</li>
			</ul>
		</section>
	</aside>
	<div class="content-wrapper">
		<section class="content">
			<?php
			if(isset($_view) && $_view)
				$this->load->view($_view);
			?>
		</section>
	</div>
	<footer class="main-footer">
		<strong>GPL <a>@CG-Vak Software & Exports Ltd</a></strong>
	</footer>
	<aside class="control-sidebar control-sidebar-dark">
		<ul class="nav nav-tabs nav-justified control-sidebar-tabs">
		</ul>
		<div class="tab-content">
			<div class="tab-pane" id="control-sidebar-home-tab">
			</div>
			<div class="tab-pane" id="control-sidebar-stats-tab">Stats Tab Content</div>
		</div>
	</aside>
	<div class="control-sidebar-bg"></div>
</div>
<script src="<?php echo site_url('resources/js/bootstrap.min.js');?>"></script>
<script src="<?php echo site_url('resources/js/fastclick.js');?>"></script>
<script src="<?php echo site_url('resources/js/app.min.js');?>"></script>
<script src="<?php echo site_url('resources/js/demo.js');?>"></script>
<script src="<?php echo site_url('resources/js/sweetalert2.min.js');?>"></script>
<script src="<?php echo site_url('resources/js/moment.js');?>"></script>
<script src="<?php echo site_url('resources/js/bootstrap-datetimepicker.min.js');?>"></script>
<script src="<?php echo site_url('resources/select2/dist/js/select2.min.js');?>"></script>
<script src="<?php echo site_url('resources/js/global.js');?>"></script>
<script src="<?php echo site_url('resources/js/common.js');?>"></script>
<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/responsive/1.0.4/js/dataTables.responsive.js"></script>
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

		/*$('#dataTable').dataTable( {
			"columnDefs": [ {
			"targets": 'no-sort',
			"orderable": false,
			"responsive": true
		} ]

	} );*/

		$('#dataTable').DataTable( {
			responsive: true
		} );

		var groupColumn = 0;
		var table = $('#gplDataTable').DataTable({
			dom: 'Bfrtip',
			"columnDefs": [
				{ "visible": false, "targets": groupColumn}
			],
			"order": [[ groupColumn, 'asc' ]],
			"responsive": true,
			"drawCallback": function ( settings ) {
				var api = this.api();
				var rows = api.rows({ page: 'current' }).nodes();
				var last=null;

				api.column(groupColumn, { page:'current' } ).data().each( function ( group, i ) {
					if ( last !== group ) {
						$(rows).eq( i ).before(
							'<tr class="group"><td colspan="15" style="font-family:Arial, Helvetica, sans-serif; font-size: 130%; font-weight:bold;">'+group+'</td></tr>'
						);

						last = group;
					}
				} );
			}
		});

	} );
</script>
</body>
</html>

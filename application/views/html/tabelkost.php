<html>

<!-- include another html page -->
<!-- include another html page,, cara makenya: -->
<!-- <div w3-include-html="h1.html"></div>  -->

<head>
	<style>
			html, body, #container {
			  height: 100%;
			  width: 100%;
			  overflow-x: hidden;
			  overflow-y: auto;
			  padding-top: 50px;
			}
			body {
			  padding-top: 50px;
			}
			input[type="radio"], input[type="checkbox"] {
			  margin: 0;
			}

			td.details-control {
				background: url('<?php echo base_url() ?>assets/html/img/icon/pl.png') no-repeat center center;
				cursor: pointer;
			}
			tr.shown td.details-control {
				background: url('<?php echo base_url() ?>assets/html/img/icon/mn.png') no-repeat center center;
			}

			@font-face { font-family: sshh; src: url('../aset/fonts/sshh.ttf'); } 
			h1 {font-family: sshh}

	</style>
	<meta charset=utf-8 />
	<title>Kost Putri EDUMEDIA</title>
	<meta name='viewport' content='initial-scale=1,maximum-scale=1,user-scalable=no' />

	<!-- Bootstrap Core CSS -->
	<link href="<?php echo base_url() ?>vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

	<!-- MetisMenu CSS -->
	<link href="<?php echo base_url() ?>vendor/metisMenu/metisMenu.min.css" rel="stylesheet">

	<!-- DataTables CSS -->
	<link href="<?php echo base_url() ?>vendor/datatables-plugins/dataTables.bootstrap.css" rel="stylesheet">

	<!-- DataTables Responsive CSS -->
	<link href="<?php echo base_url() ?>vendor/datatables-responsive/dataTables.responsive.css" rel="stylesheet">

	<!-- Custom CSS -->
	<link href="<?php echo base_url() ?>dist/css/sb-admin-2.css" rel="stylesheet">
	<link href="<?php echo base_url() ?>dist/css/datatable.min.css" rel="stylesheet">

	<!-- Custom Fonts -->
	<link href="<?php echo base_url() ?>vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">

	<link rel="icon" type="image/x-icon" href="<?php echo base_url() ?>favicon.ico">
	<link rel="stylesheet" href="<?php echo base_url() ?>aset/font-awesome.min.css" />
	<link rel="stylesheet" href="<?php echo base_url() ?>aset/ResilientMaps.css" />
	<!-- <link rel="stylesheet" href="<?php echo base_url() ?>aset/bootleaf/app.css" /> -->
	

<!--     <link rel="icon" type="image/x-icon" href="<?php echo base_url() ?>favicon.ico">
	<link rel="stylesheet" href="<?php echo base_url() ?>aset/bootstrap.min.css" />
	<link rel="stylesheet" href="<?php echo base_url() ?>aset/font-awesome.min.css" />
	<link rel="stylesheet" href="<?php echo base_url() ?>aset/bootleaf/leaflet.groupedlayercontrol.css" />
	<link rel="stylesheet" href="<?php echo base_url() ?>aset/ResilientMaps.css" />
	<link rel="stylesheet" href="<?php echo base_url() ?>aset/bootleaf/app.css" />
	<link rel="stylesheet" href="<?php echo base_url() ?>aset/leaflet102/leaflet.css" />
	<link rel="stylesheet" href="<?php echo base_url() ?>aset/MarkerCluster.css" />
	<link rel="stylesheet" href="<?php echo base_url() ?>aset/MarkerCluster.Default.css" />
	<link rel="stylesheet" href="<?php echo base_url() ?>aset/L.Control.BetterScale.css" />
	<link rel="stylesheet" href="<?php echo base_url() ?>aset/leafletdraw/leaflet.draw.css"/>
	<link rel="stylesheet" href="<?php echo base_url() ?>aset/leaflet-search.css" />
	<link rel="stylesheet" href="<?php echo base_url() ?>aset/leaflet-measure-path.css" />
	<link rel="stylesheet" href="<?php echo base_url() ?>aset/wind-js-leaflet.css" /> -->
</head>

<body>
	<div class="navbar navbar-inverse navbar-fixed-top" role="navigation">
		<div class="container-fluid">
			<div class="navbar-header" style="vertical-align:middle;"">
				<!-- <img class="pull-left" style="width:41px;height:41px;margin-top:5px;z-index:999;" src="<?php echo base_url() ?>aset/img/1.png"> -->
				<img class="pull-left" style="vertical-align:middle; width:30px;height:30px;margin-top:5px;z-index:999;" src="<?php echo base_url() ?>aset/img/1.png">
				<!-- <a class="navbar-brand" style="font-family:sshh;font-size:30;font-weight: normal;margin-top:0px;" href="#" data-toggle="collapse" data-target=".navbar-collapse.in" id="sidebar-legend-btn">&nbsp;Kost Putri EDUMEDIA</a> -->
				<a class="navbar-brand" style="color:white; vertical-align:middle; font-family:sshh;font-size:20;font-weight: normal;margin-top:0px;" href="#" data-toggle="collapse" data-target=".navbar-collapse.in" id="sidebar-legend-btn">&nbsp;Kost Putri EDUMEDIA&nbsp;</a>
				<ul class="nav navbar-nav pull-center">
					<li class="btn-group btn-group-sm" style="vertical-align:middle; margin-top:10px;" role="group">
						<button type="button" class="btn btn-success" id="peta"><i class="fa fa-map"></i>  Peta</button>
						<button type="button" class="btn btn-primary" id="tabel"><i class="fa fa-table"></i>  Tabel</button>
						<button type="button" class="btn btn-warning" id="about"><i class="fa fa-info-circle"></i> About</button>
					</li>
				</ul>
			</div>
			<ul class="pull-right">
				<i style="vertical-align:middle; font-family:'Arial'; color:white;  font-size:15; font-weight:normal; margin-top:8px">Welcome <?php if ($username) echo $username ?>&nbsp;</i>
				<li class="btn-group btn-group-sm" style="vertical-align:middle; margin-top:10px;" role="group">
					
<?php if ($permission) { ?>
					<button type="button" class="btn btn-info" id="backend"><i class="fa fa-gears"></i>  Halaman Admin</button>
					<button type="button" class="btn btn-danger" id="logout" onclick="location.href='http://google.com';"><i class="fa fa-sign-out"></i>  Logout</button>
<?php } else { ?>       
					<button type="button" class="btn btn-info" id="login"><i class="fa fa-gears"></i>  Login</button>
<?php } ?> 
				</li>
			</ul>
				
			<!-- </div> /.navbar-collapse  -->
		</div>
	</div>

	<div id="container" >
		<!-- overflow-y: scroll; overflow-x: hidden; -->
		<div class="row" style="max-height: 100%; max-width: 100%; overflow: auto;">
			<div class="col-lg-12">
				<div class="panel panel-default">
					<div class="panel-heading">
						<center><h3><b>List KOST</b></h3></center>
					</div>
					<?php //var_dump($kosts); die(); ?>
					<!-- /.panel-heading -->
					<div class="panel-body">
						<table id="example" class="table table-striped table-bordered table-hover" style="width:100%; font-size:13;">
							<thead>
								<tr>
									<th>Nama</th>
									<th>Alamat</th>
									<th>Fasilitas</th>
									<th>Jumlah KM</th>
									<th>Keterangan</th>
								</tr>
							</thead>
							<tbody>
<?php 
	if(!empty($kosts)){
		foreach($kosts as $kosan) {
			$deskripsi = $kosan['properties']; ?>
								<tr role="row" class="<?php echo alternator("even", "odd"); ?>">
									<td class="sorting_1"><?php echo $deskripsi['judul'] ?></td>
									<td><?php echo $deskripsi['desc'] ?></td>
									<td><?php echo $deskripsi['fasum'] ?></td>
									<td><?php echo $deskripsi['kamarmandi'] ?></td>
									<td><?php echo $deskripsi['desclok'] ?></td>
								</tr>
<?php 	}
	}
?>
							</tbody>
						</table>
						
					</div>
					<!-- /.panel-body -->
				</div>
				<div class="panel panel-default">
					<div class="panel-heading">
						<center><h3><b>List KAMAR</b></h3></center>
					</div>
					<div class="panel-body">
						<table width="100%" class="table table-striped table-bordered table-hover" id="dataTables-example" style="width:100%; font-size:13;">
							<thead>
								<tr>
									<th>Kosan</th>
									<th>Kamar</th>
									<th>Luas</th>
									<th>Harga</th>
									<th>Terisi</th>
								</tr>
							</thead>
							<tbody>
<?php 
	if(!empty($kosts)){
		foreach($kosts as $kosan) {
			$deskripsi = $kosan['properties'];
			foreach ($deskripsi['kamar'] as $kamar) {
?>
								<tr class="<?php echo alternator("even", "odd"); ?>">
									<td><?php echo $deskripsi['judul'] ?></td>
									<td><?php echo $kamar['nama'] ?></td>
									<td><?php echo $kamar['luas'] ?></td>
									<td><?php echo $kamar['hargath'] ?></td>
									<td><?php echo $kamar['terisi'] ?></td>
								</tr>
<?php 		}
		}
	}
?>
							</tbody>
						</table>
						<!-- /.table-responsive -->
					</div>
					<!-- /.panel-body -->
				</div>
				<!-- /.panel -->
			</div>
			<!-- /.col-lg-12 -->
		</div>
		<!-- /.row -->
	</div>
	<!-- container -->

	<!-- jQuery -->
	<script src="../vendor/jquery/jquery.min.js"></script>

	<!-- Bootstrap Core JavaScript -->
	<script src="../vendor/bootstrap/js/bootstrap.min.js"></script>

	<!-- Metis Menu Plugin JavaScript -->
	<script src="../vendor/metisMenu/metisMenu.min.js"></script>

	<!-- DataTables JavaScript -->
	<script src="../vendor/datatables/js/jquery.dataTables.min.js"></script>
	<script src="../vendor/datatables-plugins/dataTables.bootstrap.min.js"></script>
	<script src="../vendor/datatables-responsive/dataTables.responsive.js"></script>

	<!-- Custom Theme JavaScript -->
	<script src="../dist/js/sb-admin-2.js"></script>

	<!-- Page-Level Demo Scripts - Tables - Use for reference -->
	<!-- <script src="<?php echo base_url() ?>aset/jQuery-v3.1.1.js"></script> -->
	<script>
	$(document).ready(function() {
		$('#dataTables-example').DataTable({
			responsive: true,
			"lengthMenu": [[25, 50, 100], [25, 50, 100]]
		});
	});
	var LOGINSTAT = false;
	$("#login").click(function() {
	window.location.href = "../home/login";
	});
	$("#logout").click(function() {
		window.location.href = "../home/logout";
	});
	$("#backend").click(function() {
		window.location.href = "../admin/pemilik_ctrl";
	});
	$("#peta").click(function() {
		window.location.href = "../html/map";
	});
	$("#about").click(function() {
	window.location.href = "../html/about";
	});

	/* Formatting function for row details - modify as you need */
	function format ( d ) {
		// `d` is the original data object for the row
		return '<table class="table table-condensed table-hover" cellpadding="5" cellspacing="0" border="0" style="padding-left:50px; font-size:13;">'+
			'<tr>'+
				'<td>Full name:</td>'+
				'<td>'+d.name+'</td>'+
			'</tr>'+
			'<tr>'+
				'<td>Extension number:</td>'+
				'<td>'+d.extn+'</td>'+
			'</tr>'+
			'<tr>'+
				'<td>Extra info:</td>'+
				'<td>And any further details here (images etc)...</td>'+
			'</tr>'+
		'</table>';
	}
	 
	 /*
	$(document).ready(function() {
		var table = $('#example').DataTable( {
			"ajax": "<?php echo base_url() ?>json/ajax.txt",
			"columns": [
				{
					"className":      'details-control',
					"orderable":      false,
					"data":           null,
					"defaultContent": ''
				},
				{ "data": "name" },
				{ "data": "position" },
				{ "data": "office" },
				{ "data": "salary" }
			],
			"order": [[1, 'asc']]
		} );
		 
		// Add event listener for opening and closing details
		$('#example tbody').on('click', 'td.details-control', function () {
			var tr = $(this).closest('tr');
			var row = table.row( tr );
	 
			if ( row.child.isShown() ) {
				// This row is already open - close it
				row.child.hide();
				tr.removeClass('shown');
			}
			else {
				// Open this row
				row.child( format(row.data()) ).show();
				tr.addClass('shown');
			}
		} );
	} );
	*/

	// $('#example').DataTable({
	//     select: {
	//         selector:'td:not(:first-child)',
	//         style:    'os'
	//     }
	// });
	</script>


</body>

</html>

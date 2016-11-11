<?php 
include 'includes/header.php';
include 'includes/left_menu.php';?>


<div id="page-wrapper">

	<div class="container-fluid">

		<!-- Page Heading -->
		<div class="row">
			<div class="col-lg-12">
				<div class="page-header">
					<h1>Welcome to parent portal</h1>
				</div>
			</div>
		</div>
		<div class="row">
			<?php 
			
			$searchthis = "255.255.255.0";
			$matches = array();
			
			$handle = @fopen("R1_startup-config.cfg", "r");
			if ($handle)
			{
				while (!feof($handle))
				{
					$buffer = fgets($handle);
					if(strpos($buffer, $searchthis) !== FALSE)
						$matches[] = $buffer;
				}
				fclose($handle);
			}
			echo "<pre>";
			//show results:
			print_r($matches);
			echo "<pre>";
			?>

		</div>
		<!-- /.container-fluid -->

	</div>
	<!-- /#page-wrapper -->
	<?php include 'includes/footer.php';?>
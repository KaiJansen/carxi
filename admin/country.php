<?
	include_once('../common.php');

	if(!isset($generalobjAdmin)){
		require_once(TPATH_CLASS."class.general_admin.php");
		$generalobjAdmin = new General_admin();
	}
	$generalobjAdmin->check_member_login();

	$hdn_del_id 	= isset($_POST['hdn_del_id'])?$_POST['hdn_del_id']:'';
	$iCountryId 		= isset($_GET['iCountryId'])?$_GET['iCountryId']:'';
	$status 		= isset($_GET['status'])?$_GET['status']:'';
	$success = isset($_REQUEST['success']) ? $_REQUEST['success'] : 0;
	$tbl_name 		= 'country';
	$script			= "Settings";

	if($hdn_del_id != ''){
		if(SITE_TYPE !='Demo'){
		$query = "DELETE FROM `".$tbl_name."` WHERE iCountryId = '".$hdn_del_id."'";
		$obj->sql_query($query);
	}
	else{
		header("Location:make.php?success=2");exit;
	}
	}
	if($iCountryId != '' && $status != ''){
		  if(SITE_TYPE !='Demo'){
		$query = "UPDATE `".$tbl_name."` SET eStatus = '".$status."' WHERE iCountryId = '".$iCountryId."'";
		$obj->sql_query($query);
	}
	else{
		header("Location:make.php?success=2");exit;
	}
	}

	$sql = "SELECT * FROM ".$tbl_name." ORDER BY iCountryId DESC";
	$db_data = $obj->MySQLSelect($sql);
	//echo '<pre>'; print_R($db_data); echo '</pre>';
?>
<!DOCTYPE html>
<!--[if IE 8]> <html lang="en" class="ie8"> <![endif]-->
<!--[if IE 9]> <html lang="en" class="ie9"> <![endif]-->
<!--[if !IE]><!--> <html lang="en"> <!--<![endif]-->

	<!-- BEGIN HEAD-->
	<head>
		<meta charset="UTF-8" />
		<title>Admin | Country</title>
		<meta content="width=device-width, initial-scale=1.0" name="viewport" />
		<? include_once('global_files.php');?>

		<link href="../assets/plugins/dataTables/dataTables.bootstrap.css" rel="stylesheet" />
		<script type="text/javascript">
			function confirm_delete()
			{
				var confirm_ans = confirm("Are You sure You want to Delete Make?");
				return confirm_ans;
				//document.getElementById(id).submit();
			}
		</script>
	</head>
	<!-- END  HEAD-->
	<!-- BEGIN BODY-->
	<body class="padTop53 " >

		<!-- MAIN WRAPPER -->
		<div id="wrap">
			<? include_once('header.php'); ?>
			<? include_once('left_menu.php'); ?>

			<!--PAGE CONTENT -->
			<div id="content">
				<div class="inner">
					<div class="row">
						<div class="col-lg-12">
							<h2><?php echo $langage_lbl_admin['LBL_COUNTRY_TXT'];?></h2>
							<a href="country_action.php">
								<input type="button" value="Add Country" class="add-btn">
							</a>
						</div>
					</div>
				<? if ($success == 2) { ?>
						<div class="alert alert-danger alert-dismissable">
								 <button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>
								 "Edit / Delete Record Feature" has been disabled on the Demo Admin Panel. This feature will be enabled on the main script we will provide you.
						</div><br/>
					<? } ?>
					<hr />
					<div class="table-list">
						<div class="row">
							<div class="col-lg-12">
								<div class="panel panel-default">
									<div class="panel-heading">
										Country
									</div>
									<div class="panel-body">
										<div class="table-responsive">
											<table class="table table-striped table-bordered table-hover" id="dataTables-example">
												<thead>
													<tr>
														<th>Country</th>
														<th>Code</th>
														<th>Status</th>
														<th>Action</th>
													</tr>
												</thead>
												<tbody>
													<?
														$count_all = count($db_data);
														if($count_all > 0) {
															for($i=0;$i<$count_all;$i++) {
																$id = $db_data[$i]['iCountryId'];
																$vCountry = $db_data[$i]['vCountry'];
																$vPhoneCode = $db_data[$i]['vPhoneCode'];
																$eStatus = $db_data[$i]['eStatus'];
																$checked = ($eStatus=="Active")?'checked':'';
															?>
															<tr class="gradeA">
																<td width="40%"><?=$vCountry;?></td>
																<td width="20%"><?=$vPhoneCode;?></td>
																<td width="20%" align="center" class="center">
																	<? if($eStatus == 'Active') {
																		   $dis_img = "img/active-icon.png";
																			}else if($eStatus == 'Inactive'){
																			 $dis_img = "img/inactive-icon.png";
																				}else if($eStatus == 'Deleted'){
																				$dis_img = "img/delete-icon.png";
																				}?>
																		<img src="<?=$dis_img;?>" alt="<?=$eStatus;?>">
																</td>
																<td class="center veh_act" width="20%">
																	<a href="country_action.php?id=<?=$id;?>">
																		<button class="remove_btn001" data-toggle="tooltip" title="Edit Country">
																			<img src="img/edit-icon.png" alt="Edit">
																		</button>
																	</a>
																	
																	<a href="country.php?iCountryId=<?=$id;?>&status=Active" data-toggle="tooltip" title="Active Country">
																		<img src="img/active-icon.png" alt="<?php echo $eStatus ?>" >
																	</a>
																	<a href="country.php?iCountryId=<?= $id; ?>&status=Inactive" data-toggle="tooltip" title="Inactive Country">
																		<img src="img/inactive-icon.png" alt="<?php echo $eStatus; ?>" >
																	</a>
																
																	<!-- <a href="languages.php?id=<?=$id;?>&action=delete"><i class="icon-trash"></i> Delete</a>-->
																	<form name="delete_form" id="delete_form" method="post" action="" onSubmit="return confirm_delete()" class="margin0">
																		<input type="hidden" name="hdn_del_id" id="hdn_del_id" value="<?=$id;?>">
																		<button class="remove_btn001" data-toggle="tooltip" title="Delete Country"> 
																			<img src="img/delete-icon.png" alt="Delete">
																		</button>
																	</form>
																</td>
															</tr>
															<? }
														} else { ?>
														<tr class="gradeA">
															<td colspan="4">No Records found.</td>
														</tr>
													<? } ?>
												</tbody>
											</table>
										</div>

									</div>
								</div>
							</div> <!--TABLE-END-->
						</div>
					</div>
                    <div class="clear"></div>
				</div>
			</div>
			<!--END PAGE CONTENT -->
		</div>
		<!--END MAIN WRAPPER -->

		<? include_once('footer.php');?>

		<script src="../assets/plugins/dataTables/jquery.dataTables.js"></script>
		<script src="../assets/plugins/dataTables/dataTables.bootstrap.js"></script>
		<script>
			$(document).ready(function () {
				$('#dataTables-example').dataTable();
			});
		</script>
	</body>
	<!-- END BODY-->
</html>

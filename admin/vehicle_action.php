<?
include_once('../common.php');

if(!isset($generalobjAdmin)){
		require_once(TPATH_CLASS."class.general_admin.php");
		$generalobjAdmin = new General_admin();
	}
$generalobjAdmin->check_member_login();
$id 		= isset($_REQUEST['id'])?$_REQUEST['id']:'';
$success	= isset($_REQUEST['success'])?$_REQUEST['success']:0;
$action 	= ($id != '')?'Edit':'Add';

$tbl_name 	= 'model';

//echo '<prE>'; print_R($_REQUEST); echo '</pre>'; 

// set all variables with either post (when submit) either blank (when insert)
$vTitle = isset($_POST['vTitle'])?$_POST['vTitle']:'';
$iMakeId = isset($_POST['iMakeId'])?$_POST['iMakeId']:'';
$eStatus_check = isset($_POST['eStatus'])?$_POST['eStatus']:'off';
$eStatus = ($eStatus_check == 'on')?'Active':'Inactive';

$sql = "SELECT * from make";
$db_make = $obj->MySQLSelect($sql);	

if(isset($_POST['submit'])) {
	
	$q = "INSERT INTO ";
	$where = '';
	
	if($id != '' ){ 
//	echo "<pre>";print_R($_REQUEST);exit;
		$q = "UPDATE ";
		$where = " WHERE `iModelId` = '".$id."'";
	}
	
		
	  $query = $q ." `".$tbl_name."` SET 	
		`vTitle` = '".$vTitle."',
		`iMakeId` = '".$iMakeId."',
		`eStatus` = '".$eStatus."'"
		.$where;
		
		
	$obj->sql_query($query);
	$id = ($id != '')?$id:mysql_insert_id();
	header("Location:model_action.php?id=".$id.'&success=1');

}

// for Edit
if($action == 'Edit') {
	 $sql = "SELECT model.*,make.vMake FROM model left join make on make.iMakeId = model.iMakeId  WHERE iModelId = '".$id."'";
	$db_data = $obj->MySQLSelect($sql);	
	
	$vLabel = $id;
	if(count($db_data) > 0) {
		foreach($db_data as $key => $value) {
			$vTitle	 = $value['vTitle'];
			$vMake = $value['vMake'];
			$eStatus = $value['eStatus'];
			$iMakeId = $value['iMakeId'];
		}
	}
}
?>
<!DOCTYPE html>
<!--[if IE 8]> <html lang="en" class="ie8"> <![endif]-->
<!--[if IE 9]> <html lang="en" class="ie9"> <![endif]-->
<!--[if !IE]><!--> <html lang="en"> <!--<![endif]-->

<!-- BEGIN HEAD-->
<head>
	<meta charset="UTF-8" />
    <title><?=$SITE_NAME?> | Model <?=$action;?></title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport" />
	<meta content="" name="keywords" />
	<meta content="" name="description" />
	<meta content="" name="author" />
    <link href="../assets/plugins/dataTables/dataTables.bootstrap.css" rel="stylesheet" />

    <? include_once('global_files.php');?>
	<!-- On OFF switch -->
	<link href="../assets/css/jquery-ui.css" rel="stylesheet" />
	<link rel="stylesheet" href="../assets/plugins/switch/static/stylesheets/bootstrap-switch.css" />	
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
						<h2><?=$action;?> Model</h2>
						<a href="model.php">
							<input type="button" value="Back to Listing" class="add-btn">
						</a>
					</div>
				</div>
				<hr />	
                <div class="body-div">
					<div class="form-group">
						<? if($success == 1) { ?>
						<div class="alert alert-success alert-dismissable">
							<button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>
							Record Updated successfully.
						</div><br/>
						<? } ?>
						<form method="post" action="">
							<input type="hidden" name="id" value="<?=$id;?>"/>
							<div class="row">
								<div class="col-lg-12">
									<label>Make</label>
								</div>
								<div class="col-lg-6">
									<select name = "iMakeId" id="iMakeId">
									  <?php for($j=0;$j<count($db_make);$j++) {?>
									     <option value="<?=$db_make[$j]['iMakeId']?>" <?php if($iMakeId == $db_make[$j]['iMakeId']){?> selected <?php }?>><?=$db_make[$j]['vMake']?></option>
                                      <?php } ?>									  
									</select>
								</div>
							</div>
							<div class="row">
								<div class="col-lg-12">
									<label>Model</label>
								</div>
								<div class="col-lg-6">
									<input type="text" class="form-control" name="vTitle"  id="vTitle" value="<?=$vTitle;?>" placeholder="Model Label" required>
								</div>
							</div>
							<div class="row">
								<div class="col-lg-12">
									<label>Status</label>
								</div>
								<div class="col-lg-6">
									<div class="make-switch" data-on="success" data-off="warning">
										<input type="checkbox" name="eStatus" <?=($id != '' && $eStatus == 'Inactive')?'':'checked';?>/>
									</div>
								</div>
							</div>
							<div class="row">
								<div class="col-lg-12">							
									<input type="submit" class="save btn-info" name="submit" id="submit" value="<?=$action;?> Model">
								</div>
							</div>
						</form>
                	</div>
				</div>
            </div>
	   </div>
		<!--END PAGE CONTENT -->
    </div>
     <!--END MAIN WRAPPER -->
     

	<? include_once('footer.php');?>
	<script src="../assets/plugins/switch/static/js/bootstrap-switch.min.js"></script>
</body>
	<!-- END BODY-->    
</html>
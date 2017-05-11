<?php 

	$action = !empty($_REQUEST['action']) ? $_REQUEST['action'] : '';
	$notification = '';


	if ($action == 'feedback_complete') {
		$notification = $t['items']['feedback'];
	}

		
	require(bDIR.'/engine/templates/header.php');
	require(bDIR.'/engine/templates/notification.php');
	require(bDIR.'/engine/templates/footer.php');
?>
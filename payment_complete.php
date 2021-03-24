
 <?php
	require "connection.inc.php";


	echo "Transaction Is Progress Please do not Reload";

	$id = $_GET['payment_request_id'];


	if (isset($_GET['payment_status']) && $_GET['payment_status'] == 'Credit') {
		mysqli_query($connection, "UPDATE `order` SET `payment_status`='Success' WHERE  `order`.`txnid`='$id'");
		echo mysqli_affected_rows($connection);
		echo "<script>
		       window.location.href = 'thank_you.php';
		      </script>";
	}


	if (isset($_GET['payment_status']) && $_GET['payment_status'] == 'Failed') {
		mysqli_query($connection, "UPDATE `order` SET  `payment_status`='Fail' WHERE  `order`.`txnid`='$id'");
		echo "<script>
	           window.location.href = 'payment_fail.php';
	          </script>";
	}
	?>
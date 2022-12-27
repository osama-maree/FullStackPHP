<?php
require_once("Class.Database.php");
class Tools
{
	static function cleanData($data)
	{
		$data = trim($data);
		$data = stripslashes($data);
		$data = htmlspecialchars($data);
		return $data;
	}

	static function printSuccess($message)
	{
?>
		<script>
			alert($message)
		</script>
	<?php
	}

	static function printError($message)
	{
	?><script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
		<script>
			Swal.fire({
				icon: 'error',
				title: 'Oops...',
				text: '<?php echo $message; ?>',
				footer: "Please Try again"
			})
		</script>
<?php
	}
}

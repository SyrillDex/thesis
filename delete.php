<?php

include_once("connections/connection.php");

$con = connection();

$id=$_GET["id"];
mysqli_query($con, "DELETE FROM student_docs WHERE id=$id");
?>


<script type="text/javascript">
window.location ="camera.php";
</script>
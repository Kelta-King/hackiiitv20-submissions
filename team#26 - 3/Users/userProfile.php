<?php
session_start();

 if(isset($_SESSION['login_user_connect']) && isset($_REQUEST['name'])){

    $dts = explode("&",base64_decode($_SESSION['login_user_connect']));
    $id = $dts[0];
    $email = $dts[1];
    $name = $dts[2];
	
	require_once("../Database/dbconnect_connect.php");
?>

<!DOCTYPE html>
<html>
<title><?php echo $name." | Profile" ?></title>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
<link rel="stylesheet" href="../Community.css">
<link rel='stylesheet' href='https://fonts.googleapis.com/css?family=Open+Sans'>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<style>
    html, body, h1, h2, h3, h4, h5 {
        font-family: "Open Sans", sans-serif
    }
</style>
<?php
	$url = base64_encode($id."&".$name);
	include("../Commen/generalHeader.php");
?>
  <?php
  $sql = "SELECT * FROM users WHERE u_id = $id";
  $result = mysqli_query($conn, $sql);
  $rowCount = mysqli_num_rows($result);
  if ($rowCount>0) {
      while ($row = mysqli_fetch_assoc($result)) {
          ?>
<center>
    <div class="w3-container w3-content" style="max-width:1300px;margin-top:80px">
        <section class="text-gray-700 body-font">
            <div class="container mx-auto flex px-5 py-24 items-center justify-center flex-col">
                <img class="lg:w-2/6 md:w-3/6 w-5/6 mb-10 object-cover object-center rounded w3-round w3-image w3-border" alt="hero"
                    src="<?php echo $row['u_dp'] ?>" style="width:300px">
                <div class="text-center lg:w-2/3 w-full">
                    <h1 class="title-font sm:text-4xl text-3xl mb-4 font-medium text-gray-900"><?php echo $row['real_name']; ?> </h1>


                    <section class="text-gray-700 body-font" id="individual">
                        <div class="container px-5 py-24 mx-auto">
                          <div class="xl:w-1/2 lg:w-3/4 w-full mx-auto text-center">
                              <path d="M925.036 57.197h-304c-27.6 0-50 22.4-50 50v304c0 27.601 22.4 50 50 50h145.5c-1.9 79.601-20.4 143.3-55.4 191.2-27.6 37.8-69.399 69.1-125.3 93.8-25.7 11.3-36.8 41.7-24.8 67.101l36 76c11.6 24.399 40.3 35.1 65.1 24.399 66.2-28.6 122.101-64.8 167.7-108.8 55.601-53.7 93.7-114.3 114.3-181.9 20.601-67.6 30.9-159.8 30.9-276.8v-239c0-27.599-22.401-50-50-50zM106.036 913.497c65.4-28.5 121-64.699 166.9-108.6 56.1-53.7 94.4-114.1 115-181.2 20.6-67.1 30.899-159.6 30.899-277.5v-239c0-27.6-22.399-50-50-50h-304c-27.6 0-50 22.4-50 50v304c0 27.601 22.4 50 50 50h145.5c-1.9 79.601-20.4 143.3-55.4 191.2-27.6 37.8-69.4 69.1-125.3 93.8-25.7 11.3-36.8 41.7-24.8 67.101l35.9 75.8c11.601 24.399 40.501 35.2 65.301 24.399z"></path>
                            </svg>
							<hr style="border:1px solid black">
                            <p class="leading-relaxed text-lg"><?php echo $row['description']; ?></p>
                          </div>
                        </div>

                      </section>

                </div>
            </div>
        </section>
    </div>
</center>
</body>

</html>

<?php
  }
}
   $conn->close();
}
else{
   header("Location:../logout.php");
}

?>

<?
  include_once "include/db.php";
  session_start();
  if (isset($_SESSION['id'])) {
    $id=$_SESSION['id'];
    $time=date("Y-m-d H-i");
    mysql_query(mysql_query("UPDATE list set bool='0', time='$time' where id='$id'"));
  }
  unset($_SESSION['rol']);
  unset($_SESSION['id']);
  unset($_SESSION['rasm']);
  unset($_SESSION['fio']);
  if (isset($_POST['mehmon'])) {
    $_SESSION['id']=0;
    $_SESSION['rasm']="no-image.jpg";
    print("<script>window.location='view.php'</script>");
  }
  if (isset($_POST['ok'])) {
    $login=$_POST['login'];
    $parol=md5($_POST['parol']);
    $surov=mysql_query("SELECT * from list where login='$login' and parol='$parol'");
    if (mysql_num_rows($surov)==1) {
      $row=mysql_fetch_assoc($surov);
      $id=$row['id'];
      $sum=$row['sum']+1;
      mysql_query(mysql_query("UPDATE list set sum='$sum', bool='1' where id='$id'"));
      $_SESSION['rol']=$row['rol'];
      $_SESSION['fio']=$row['fio'];
      $_SESSION['rasm']=$row['rasm'];
      $_SESSION['id']=$row['id'];
      print("<script>window.location='view.php'</script>");
    }else{
      $error="Login yoki parol xato";
    }
  }
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>Group202</title>
  <link rel="stylesheet" href="vendors/iconfonts/font-awesome/css/all.min.css">
  <link rel="stylesheet" href="vendors/css/vendor.bundle.base.css">
  <link rel="stylesheet" href="vendors/css/vendor.bundle.addons.css">
  <link rel="stylesheet" href="css/style.css">
</head>
<body>
  <div class="container-scroller">
    <div class="container-fluid page-body-wrapper full-page-wrapper">
      <div class="content-wrapper d-flex align-items-center auth">
        <div class="row w-100">
          <div class="col-lg-4 mx-auto">
            <div class="auth-form-light text-left p-5">
              <div class="brand-logo">
                <img src="images/2.png" alt="logo">
              </div>
              <h4>Salom! Xush kelibsiz</h4>
              <h6 class="font-weight-light">Kirish uchun davom eting.</h6>
              <form class="pt-3" method="post" action="index.php">
                <div class="popover-static-demo">
                <p style="color: red"><b><?=$error?></b></p>
                <div class="form-group">
                  <input type="text" class="form-control form-control-lg" id="exampleInputEmail1"  required="" name="login">
                </div>
                <div class="form-group">
                  <input type="password" class="form-control form-control-lg" id="exampleInputPassword1" required="" name="parol">
                </div>
                <div class="mt-3">
                  <button type="submit" class="btn btn-block btn-primary btn-lg font-weight-medium auth-form-btn" name="ok">KIRISH</button>
                </div>                
              </form>
              <form class="pt-3" method="post" action="index.php">
                <div class="text-center mt-4 font-weight-light">
                  Mehmon bo'lib kirsangiz bazi ma'lumotlarni ko'ra olmaysiz!
                </div>
                <br>
                <div class="mb-2">
                  <button type="submit" class="btn btn-block btn-facebook auth-form-btn" name="mehmon">
                    <i class="far fa-user mr-2"></i>Mehmon bo'lib kirish.
                  </button>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
      <!-- content-wrapper ends -->
    </div>
    <!-- page-body-wrapper ends -->
  </div>
  <? include_once "include/js.php"; ?>
</body>
</html>

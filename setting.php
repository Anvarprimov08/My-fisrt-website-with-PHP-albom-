<? 
  session_start();
  if (!isset($_SESSION['id']) or $_SESSION['id']==0) {
    print("<script>window.location='index.php'</script>");
  }
  $id=$_SESSION[id];
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>Group 202</title>
  <link rel="stylesheet" href="vendors/iconfonts/font-awesome/css/all.min.css">
  <link rel="stylesheet" href="vendors/css/vendor.bundle.base.css">
  <link rel="stylesheet" href="vendors/css/vendor.bundle.addons.css">
  <link rel="stylesheet" href="css/style.css">
</head>
<body class="sidebar-fixed">
  <div class="container-scroller">
    
    <? include_once "include/header.php"; ?>
    
    <div class="container-fluid page-body-wrapper">

      <!-- tarkib -->
      <? include_once "include/table.php"; ?>

      <!-- menu -->
      <? include_once "include/menu.php"; ?>

      <?   
        $surov=mysql_query("SELECT login, parol from list where id='$id'");
        if (isset($_POST['ok'])) {
          $row=mysql_fetch_assoc($surov);
          $i=0;
          $log=trim($_POST['login']);
          $login=filter($_POST['login']);
          $apar=$_POST['aparol'];
          $aparol=md5($_POST['aparol']);
          $par=$_POST['parol'];
          $tpar=$_POST['tparol'];
          $parol=md5(trim($_POST['parol']));
          if (strlen($log)>=5) {
            $test=mysql_query("SELECT * from list where login='$login'");
            if (mysql_num_rows($test)==0 or $login==$row['login']) {
              $i++;
            } else {
              $erlog="Loginni qayta kiriting";
            }            
          } else {
            $erlog="5 ta belgidan kam bo'lmagan login kiriting";
          }
          if ($aparol==$row['parol']) {
            if (strlen($par)>=5) {
              $test=mysql_query("SELECT * from list where parol='$parol'");
              if (mysql_num_rows($test)==0 or $parol==$row['parol']) {
                if ($par==$tpar) {
                  $i++;
                } else {
                  $ertpar="Takroriy parol xato";
                }              
              } else {
                $erpar="Parolni qayta kiriting";
              } 
            } else {
              $erpar="5 ta belgidan kam bo'lmagan parol kiriting";
            }
          } else {
            $erapar=" Amaldagi parolni noto'g'ri kiritdingiz";
          }
          if ($i==2) {
            $surov=mysql_query("UPDATE list set login='$login', parol='$parol' where id='$id' ");
            if ($surov) {
              print("<script>window.alert('Login va parol muvaffaqiyatli o\'zgartirildi!!!')</script>");
              print("<script>window.location='create.php'</script>");
            } else {
              print("<script>window.alert('XATOLIK: qaytadan o\'rinib ko\'ring')</script>");
            }            
          }
        }
      ?>

      <!-- asosiy -->
      <div class="main-panel">
        <div class="content-wrapper">
          <div class="row">
            <div class="col-lg-12">
              <div class="card">
                <div class="card-body">
                  <h4 class="card-title">Login & parolni o'zgartirish</h4>
                  <form class="cmxform" id="signupForm" method="post">
                    <fieldset>
                      <div class="form-group">
                        <label for="login">Yangi login</label>
                        <input id="login" class="form-control" name="login" type="text" value="<?=$log?>" required="">
                        <span style="color: red; font-size: 14px;"><?=$erlog?></span>
                      </div>
                      <div class="form-group">
                        <label for="aparol">Amaldagi parol</label>
                        <input id="aparol" class="form-control" name="aparol" type="password" value="<?=$apar?>" required="">
                        <span style="color: red; font-size: 14px;"><?=$erapar?></span>
                      </div>
                      <div class="form-group">
                        <label for="parol">Yangi parol</label>
                        <input id="parol" class="form-control" name="parol" type="password" value="<?=$par?>" required="">
                        <span style="color: red; font-size: 14px;"><?=$erpar?></span>
                      </div>
                      <div class="form-group">
                        <label for="tparol">Yangi parolni takrorlang</label>
                        <input id="tparol" class="form-control" name="tparol" type="password" value="<?=$tpar?>" required="">
                        <span style="color: red; font-size: 14px;"><?=$ertpar?></span>
                      </div>
                      <button type="submit" class="btn btn-primary mr-2" name="ok">Submit</button>
                      <button class="btn btn-light" type="reset">Cancel</button>
                    </fieldset>
                  </form>
                </div>
              </div>
            </div>
          </div>
        </div>

        <!-- footer -->
        <? include_once "include/footer.php"; ?>
      </div>
      <!-- asosiy ends -->
    </div>
  </div>
  <? include_once "include/js.php"; ?>  
</body>
</html>

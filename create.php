<? 
  session_start();
  if ($_SESSION['rol']!="Admin") {
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
        if (isset($_POST['ok'])) {          
          $i=0;
          $fi=trim($_POST['fio']);
          $fio=filter($_POST['fio']);
          $log=trim($_POST['login']);
          $login=filter($_POST['login']);
          $par=trim($_POST['parol']);
          $tpar=trim($_POST['tparol']);
          $parol=md5(trim($_POST['parol']));
          $maq=trim($_POST['maqsad']);
          $maqsad=filter($_POST['maqsad']);
          $shr=trim($_POST['shior']);
          $shior=filter($_POST['shior']);
          $man=trim($_POST['manzil']);
          $manzil=filter($_POST['manzil']);
          $tel=trim($_POST['tel']);
          $tlg=filter($_POST['tlg']);
          $ms=trim($_POST['msg']);
          $msg=filter($_POST['msg']);
          $rol=filter($_POST['rol']);
          $born=filter($_POST['born']);
          if (preg_match("/^[a-z `'ʼ]{10,}$/i", $fi) and !empty($fi)) {
            $i++;
          } else {
            $erfi="To'liq, to'g'ri va 10 ta belgidan kam bo'lmagan FIO kiriting";
          }
          if (preg_match("/^\+[0-9]{12,12}$/", $tel)) {
            $i++;
          } else {
            $ertel=" Telefon raqamingizni to'g'ri kiriting";
          }
          if (strlen($born)==10) {
            $i++;
          } else {
            $erborn=" Tug'ilgan kunni kiriting";
          }
          if (strlen($log)>=5) {
            $test=mysql_query("SELECT * from list where login='$login'");
            if (mysql_num_rows($test)==0) {
              $i++;
            } else {
              $erlog="Loginni qayta kiriting";
            }            
          } else {
            $erlog="5 ta belgidan kam bo'lmagan login kiriting";
          }
          if ($par==$tpar) {
            if (strlen($par)>=5) {
              $test1=mysql_query("SELECT * from list where parol='$parol'");
              if (mysql_num_rows($test1)==0) {
                $i++;
              } else {
                $erpar="Parolni qayta kiriting";
              } 
            } else {
              $erpar="5 ta belgidan kam bo'lmagan parol kiriting";
            }
          } else {
            $ertpar=" Takroriy parol xato";
          }
          if (!empty($man)) {
            $i++;
          } else {
            $erman="Kiriting";
          }
          if (!empty($maq)) {
            $i++;
          } else {
            $ermaq="Kiriting";
          }
          if (!empty($shr)) {
            $i++;
          } else {
            $ershr="Kiriting";
          }
          if ($_FILES['rasm']['error']==0) {
            if (!file_exists("images")) {
              mkdir("images");
            }
            if ($_FILES['rasm']['type']=="image/jpeg" || $_FILES['rasm']['type']=="image/png") {
              if ($_FILES['rasm']['size']<=3*1024*1024) {
                $i++;
                $rasm=time().".jpg";
                $file=__dir__."/images/".$rasm;
                $tmpname=$_FILES['rasm']['tmp_name'];
              } else {
                $errasm="Kichik hajmdagi rasm yuklang";
              }              
            } else {
              $errasm="Faqat rasm yuklang";
            }            
          }else{
            $errasm="Rasm yuklashda xatolik";
          }
          if ($i==9) {
            $surov=mysql_query("INSERT into list(fio, maqsad, manzil, shior, tel, tlg, rasm, msg, login, parol, rol, born) values('$fio', '$maqsad', '$manzil', '$shior', '$tel', '$tlg', '$rasm', '$msg', '$login', '$parol', '$rol', '$born')");
            if ($surov) {
              move_uploaded_file($tmpname, $file);
              print("<script>window.alert('Ma\'lumotlar muvaffaqiyatli yozildi!!!')</script>");
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
          <div class="page-header">
            <h3 class="page-title">
                Yangi a'zo qo'shish
            </h3>
          </div>
          <div class="row">
            <div class="col-lg-12">
              <div class="card">
                <div class="card-body">
                  <h4 class="card-title">Ma'lumotlarni to'g'ri to'ldiring</h4>
                  <form class="cmxform" id="signupForm" method="post" enctype="multipart/form-data">
                    <fieldset>
                      <div class="col-lg-4 grid-margin stretch-card">
                        <div class="card">
                          <div class="card-body">
                            <h4 class="card-title d-flex">Rasm
                            </h4>
                            <input type="file" class="dropify" accept="image/*" name="rasm" required="" />
                            <span style="color: red; font-size: 14px;"><?=$errasm?></span>
                          </div>
                        </div>
                      </div>
                      <div class="form-group">
                        <label for="fio">Ism familya otasining ismi</label>
                        <input id="fio" class="form-control" name="fio" type="text" value="<?=$fi?>" required="">
                        <span style="color: red; font-size: 14px;"><?=$erfi?></span>
                      </div>
                      <div class="form-group">
                        <label for="fio">Tug'ilgan kun</label>
                        <input id="fio" class="form-control" name="born" type="date"  value="<?=$born?>" required="">
                        <span style="color: red; font-size: 14px;"><?=$erborn?></span>
                      </div>
                      <div class="form-group">
                        <label for="rol1">Kim bo'lib kiritasiz</label>
                        <select class="form-control" id="rol" name="rol" required="">
                          <option value=""> --Tanlang--</option>
                          <option value="Talaba" <?if($_POST['rol']=="Talaba")echo "selected";?>>Talaba</option>
                          <option value="Teacher" <?if($_POST['rol']=="Teacher")echo "selected";?>>O'qituvchi</option>
                          <option value="Admin" <?if($_POST['rol']=="Admin")echo "selected";?>>Admin</option>
                        </select>
                      </div>
                      <div class="form-group">
                        <label for="login">Login</label>
                        <input id="login" class="form-control" name="login" type="text" value="<?=$log?>" required="">
                        <span style="color: red; font-size: 14px;"><?=$erlog?></span>
                      </div>
                      <div class="form-group">
                        <label for="parol">Parol</label>
                        <input id="parol" class="form-control" name="parol" type="password" value="<?=$par?>" required="">
                        <span style="color: red; font-size: 14px;"><?=$erpar?></span>
                      </div>
                      <div class="form-group">
                        <label for="tparol">Takroriy parol</label>
                        <input id="tparol" class="form-control" name="tparol" type="password" value="<?=$tpar?>" required="">
                        <span style="color: red; font-size: 14px;"><?=$ertpar?> <?=$erpar?></span>
                      </div>
                      <div class="form-group">
                        <label for="tel">Telefon raqam</label>
                        <input id="tel" class="form-control" name="tel" type="text" value="<?=$tel?>" required="">
                        <span style="color: red; font-size: 14px;"><?=$ertel?></span>
                      </div>
                      <div class="form-group">
                        <label for="tlg">Telegram manzil</label>
                        <input id="tlg" class="form-control" name="tlg" type="text" value="<?=$tlg?>">
                      </div>
                      <div class="form-group">
                        <label for="tlg">Yashash manzil</label>
                        <textarea id="manzil" class="form-control" name="manzil" required=""><?=$man?></textarea>
                        <span style="color: red; font-size: 14px;"><?=$erman?></span>
                      </div>
                      <div class="form-group">
                        <label for="maqsad">Maqsadingiz</label>
                        <textarea id="maqsad" class="form-control" name="maqsad" required=""><?=$maq?></textarea>
                        <span style="color: red; font-size: 14px;"><?=$ermaq?></span>
                      </div>
                      <div class="form-group">
                        <label for="shior">Shioringiz</label>
                        <textarea id="shior" class="form-control" name="shior" required=""><?=$shr?></textarea>
                        <span style="color: red; font-size: 14px;"><?=$ershr?></span>
                      </div>
                      <div class="form-group">
                        <label for="msg">Guruhga xabar</label>
                        <textarea id="msg" class="form-control" name="msg" required><?=$ms?></textarea>
                      </div>
                      <button type="submit" class="btn btn-primary mr-2" name="ok">Yuborish</button>
                      <button class="btn btn-light" type="reset">Tozalash</button>
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

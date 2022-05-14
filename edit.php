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
      <!-- rasm -->
      <?
        if (isset($_POST['file'])) {        
          if ($_FILES['rasm']['error']==0) {
            if (!file_exists("images")) {
              mkdir("images");
            }
            if ($_FILES['rasm']['type']=="image/jpeg" || $_FILES['rasm']['type']=="image/png") {
              if ($_FILES['rasm']['size']<=3*1024*1024) {
                $rasm=time().".jpg";
                $file=__dir__."/images/".$rasm;
                $tmpname=$_FILES['rasm']['tmp_name'];
                move_uploaded_file($tmpname, $file);
                $del=mysql_query("SELECT rasm from list where id='$id' ");
                $del=mysql_fetch_assoc($del);
                $del="images/".$del['rasm'];                
                $surov=mysql_query("UPDATE list set rasm='$rasm' where id='$id'");
                if (file_exists($del) and $surov) {
                  unlink($del);
                  $_SESSION['rasm']=$rasm;
                  print("<script>window.alert('Rasm muvaffaqiyatli o\'zgartirildi!!!')</script>");
                  print("<script>window.location='view.php'</script>");
                }
              } else {
                $errasm="Kichik hajmdagi rasm yuklang";
              }              
            } else {
              $errasm="Faqat rasm yuklang";
            }            
          }else{
            $errasm="Rasm yuklashda xatolik";
          }
        }
      ?>
      <?
        $surov=mysql_query("SELECT * from list where id='$id'");
        $row=mysql_fetch_assoc($surov);        
        $fi=$row['fio'];
        $maq=$row['maqsad'];
        $shr=$row['shior'];
        $man=$row['manzil'];
        $ms=$row['msg'];
        $tel=$row['tel'];
        $tg=$row['tlg'];
        $born=$row['born'];
      ?>
      <!-- mal'umotlar -->
      <?
      
        if (isset($_POST['ok'])) {          
          $i=0;
          $fi=trim($_POST['fio']);
          $fio=filter($_POST['fio']);
          $maq=trim($_POST['maqsad']);
          $maqsad=filter($_POST['maqsad']);
          $shr=trim($_POST['shior']);
          $shior=filter($_POST['shior']);
          $man=trim($_POST['manzil']);
          $manzil=filter($_POST['manzil']);
          $ms=trim($_POST['msg']);
          $msg=filter($_POST['msg']);
          $tg=trim($_POST['tlg']);
          $tlg=filter($_POST['tlg']);
          $tel=$_POST['tel'];
          $born=filter($_POST['born']);
          if (preg_match("/^[a-z `']{10,}$/i", $fi) and !empty($fi)) {
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
          if (!empty($ms)) {
            $i++;
          } else {
            $ermsg="Kiriting";
          }
          if ($i==7) {
            $surov=mysql_query("UPDATE list set fio='$fio', maqsad='$maqsad', manzil='$manzil', shior='$shior', tel='$tel', tlg='$tlg', msg='$msg', born='$born' where id='$id' ");
            if ($surov) {
              $_SESSION['fio']=$row['fio'];
              print("<script>window.alert('Ma\'lumotlar muvaffaqiyatli o\'zgartirildi!!!')</script>");
              print("<script>window.location='view.php'</script>");
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
                Rasmni o'zgarting
            </h3>
          </div>
          <div class="row">
            <div class="col-lg-12">
              <div class="card">
                <div class="card-body">
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
                      <button type="submit" name="file" class="btn btn-primary mr-2">Yuklash</button>
                    </fieldset>
                  </form>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="content-wrapper">
          <div class="page-header">
            <h3 class="page-title">
                Ma'lumotlaringizni o'zgartining
            </h3>
          </div>
          <div class="row">
            <div class="col-lg-12">
              <div class="card">
                <div class="card-body">
                  <h4 class="card-title">Ma'lumotlarni to'g'ri to'ldiring</h4>
                  <form class="cmxform" id="signupForm" method="post">
                    <fieldset>
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
                        <label for="tel">Telefon raqam</label>
                        <input id="tel" class="form-control" name="tel" type="text" value="<?=$tel?>" required="">
                        <span style="color: red; font-size: 14px;"><?=$ertel?></span>
                      </div>
                      <div class="form-group">
                        <label for="tlg">Telegram manzil</label>
                        <input id="tlg" class="form-control" name="tlg" type="text" value="<?=$tg?>">
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
                        <textarea id="msg" class="form-control" name="msg" required=""><?=$ms?></textarea>
                        <span style="color: red; font-size: 14px;"><?=$ermsg?></span>
                      </div>
                      <button type="submit" class="btn btn-primary mr-2" name="ok">Tayyor</button>
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

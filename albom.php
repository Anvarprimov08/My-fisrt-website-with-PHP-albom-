<? 
  session_start();
  if (!isset($_SESSION['id'])) {
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

      <!-- asosiy -->
      <div class="main-panel">
        <div class="content-wrapper">
          <div class="row">
            <div class="col-12">
              <div class="card">
                <div class="card-body">
                  <div class="row">
                    <div class="col-12">
                      <div class="row portfolio-grid">
                        <? 
                          $surov=mysql_query("SELECT rasm, shior, fio from list where rol='Teacher' order by fio asc");
                          while ($row=mysql_fetch_assoc($surov)):?>
                            <div class="col-xl-4 col-lg-4 col-md-4 col-sm-6 col-12">
                              <figure class="effect-text-in">
                                <img src="images/<?=$row['rasm']?>" alt="image"/>
                                <figcaption>
                                  <h4><?=$row['fio']?> afdsfsdf</h4>
                                  <p><?=$row['shior']?></p>
                                </figcaption>
                              </figure>
                            </div>
                        <? endwhile; ?>
                        <? 
                          $surov=mysql_query("SELECT rasm, shior, fio from list where rol='Admin' order by fio asc");
                          while ($row=mysql_fetch_assoc($surov)):?>
                            <div class="col-xl-4 col-lg-4 col-md-4 col-sm-6 col-12">
                              <figure class="effect-text-in">
                                <img src="images/<?=$row['rasm']?>" alt="image"/>
                                <figcaption>
                                  <h4><?=$row['fio']?></h4>
                                  <p><?=$row['shior']?></p>
                                </figcaption>
                              </figure>
                            </div>
                        <? endwhile; ?>
                        <? 
                          $surov=mysql_query("SELECT rasm, shior, fio from list where rol='Talaba' order by fio asc");
                          while ($row=mysql_fetch_assoc($surov)):?>
                            <div class="col-xl-4 col-lg-4 col-md-4 col-sm-6 col-12">
                              <figure class="effect-text-in">
                                <img src="images/<?=$row['rasm']?>" alt="image"/>
                                <figcaption>
                                  <h4><?=$row['fio']?></h4>
                                  <p><?=$row['shior']?></p>
                                </figcaption>
                              </figure>
                            </div>
                        <? endwhile; ?>
                      </div>
                    </div>
                  </div>
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

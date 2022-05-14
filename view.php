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
  <link rel="stylesheet" href="vendors/iconfonts/simple-line-icon/css/simple-line-icons.css">
  <link rel="stylesheet" href="css/style.css">
</head>
<body class="sidebar-fixed">
  <div class="container-scroller">
    
    <? include_once "include/header.php"; ?>
    <?
      if (isset($_GET['id'])) {
        $id=$_GET['id'];
        $del=mysql_query("SELECT rasm from list where id='$id' ");
        $rasm=mysql_fetch_assoc($del);
        $rasm="images/".$rasm['rasm'];
        if (file_exists($rasm)) {
          unlink($rasm);
        }
        $delet=mysql_query("DELETE from list where id='$id'");
        if ($delet) {
          print("<script>window.alert('Ma\'lumot o\'chirildi!!!')</script>");
          print("<script>window.location='view.php'</script>");
        }
      }
    ?>
    
    <div class="container-fluid page-body-wrapper">

      <!-- tarkib -->
      <? include_once "include/table.php"; ?>

      <!-- menu -->
      <? include_once "include/menu.php"; ?>

      <!-- asosiy -->
      <div class="main-panel">
        <div class="content-wrapper">
          <div class="row">
            <div class="col-12 grid-margin">
              <div class="card">
                <div class="card-body">
                  <div class="d-md-flex justify-content-between align-items-center">
                    <div class="d-flex align-items-center mb-3 mb-md-0">
                      <button class="btn btn-social-icon btn-facebook btn-rounded">
                      <i class="icon-user"></i>
                      </button>
                      <div class="ml-4">
                        <h5 class="mb-0">O'qituvchilar</h5>
                        <? $sum=mysql_query("SELECT * from list where rol='Teacher' "); ?>
                        <p class="mb-0"><?=mysql_num_rows($sum);?></p>
                      </div>
                    </div>
                    <div class="d-flex align-items-center mb-3 mb-md-0">
                      <button class="btn btn-social-icon btn-twitter btn-rounded">
                      <i class="icon-user-follow"></i>
                      </button>
                      <div class="ml-4">
                        <h5 class="mb-0">Adminlar</h5>
                        <? $sum=mysql_query("SELECT * from list where rol='Admin' "); ?>
                        <p class="mb-0"><?=mysql_num_rows($sum);?></p>
                      </div>
                    </div>
                    <div class="d-flex align-items-center">
                      <button class="btn btn-social-icon btn-linkedin btn-rounded">
                      <i class="fa fa-graduation-cap"></i>
                      </button>
                      <div class="ml-4">
                        <h5 class="mb-0">Talabalar</h5>
                        <? $sum=mysql_query("SELECT * from list where rol='talaba' "); ?>
                        <p class="mb-0"><?=mysql_num_rows($sum);?></p>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="row">
            <? 
              $surov=mysql_query("SELECT * from list where rol='Teacher' order by fio asc");
              while ($row=mysql_fetch_assoc($surov)):?>
                <div class="col-md-6 grid-margin stretch-card">
                  <div class="card text-center">
                    <div class="card-body" >
                      <img src="images/<?=$row['rasm']?>" class="img-lg rounded-circle mb-2" alt="profile image"/>
                      <h4><?=$row['fio']?></h4>
                      <p class="text-muted">O'qituvchi</p>
                      <p class="mt-4 card-text">
                        <b>Tug'ilgan kun: </b> <?=$row['born']?><br><br>
                        <i class="fa fa-home menu-icon"></i> <?=$row['manzil']?><br>
                      </p>
                      <? if ($_SESSION['rol']=="Admin") :?>
                        <button onclick="if(confirm('Foydalanuvchi o\'chirilsinmi'))window.location.href='view.php?id=<?=$row['id']?>'" class="btn btn-info btn-sm mt-3 mb-4">O'chirish</button>
                      <? endif ?>
                      <? if ($_SESSION['id']>0) :?>
                        <div class="border-top pt-3">
                            <div class="row">
                                <div class="col-6">
                                    <h6><i class="fa fa-microchip"></i> Telefon</h6>
                                    <p><a href="tel:/<?=$row['tel']?>"><?=$row['tel']?></a></p>
                                </div>
                                <div class="col-6">
                                    <h6><i class="fab fa-telegram"></i> Telegram</h6>
                                    <p><a target="_blank" href="https://t.me/<?=$row['tlg']?>"><?=$row['tlg']?></a></p>
                                </div>
                            </div>
                        </div>
                      <? endif ?>
                      <div class="border-top pt-3">
                          <div class="row">
                              <div class="col-6">
                                  <h6>So'ngi faolligi</h6>
                                  <p><div class="badge badge-success badge-pill my-auto mx-2"><? if($row['bool']) echo 'online'; else echo $row['time']; ?></div></p>
                              </div>
                              <div class="col-6">
                                  <h6>Tashriflar soni</h6>
                                  <p><div class="badge badge-success badge-pill my-auto mx-2"><?=$row['sum']?></div></p>
                              </div>
                          </div>
                      </div>
                      <div class="mt-4">
                        <div class="accordion accordion-multi-colored" id="accordion-<?=$row['id']?>" role="tablist">
                          <div class="card">
                            <div class="card-header" role="tab" id="heading-1<?=$row['id']?>">
                              <h6 class="mb-0">
                                <a data-toggle="collapse" href="#collapse-1<?=$row['id']?>" aria-expanded="false" aria-controls="collapse-1<?=$row['id']?>">
                                  Yashashdan maqsadim
                                </a>
                              </h6>
                            </div>
                            <div id="collapse-1<?=$row['id']?>" class="collapse" role="tabpanel" aria-labelledby="heading-1<?=$row['id']?>" data-parent="#accordion-<?=$row['id']?>">
                              <div class="card-body">
                                <?=$row['maqsad']?>
                              </div>
                            </div>
                          </div>
                          <div class="card">
                            <div class="card-header" role="tab" id="heading-2<?=$row['id']?>">
                              <h6 class="mb-0">
                                <a class="collapsed" data-toggle="collapse" href="#collapse-2<?=$row['id']?>" aria-expanded="false" aria-controls="collapse-2<?=$row['id']?>">
                                  Hayotdagi shiorim
                                </a>
                              </h6>
                            </div>
                            <div id="collapse-2<?=$row['id']?>" class="collapse" role="tabpanel" aria-labelledby="heading-2<?=$row['id']?>" data-parent="#accordion-<?=$row['id']?>">
                              <div class="card-body">
                                <?=$row['shior']?>
                              </div>
                            </div>
                          </div>
                          <div class="card">
                            <div class="card-header" role="tab" id="heading-3<?=$row['id']?>">
                              <h6 class="mb-0">
                                <a class="collapsed" data-toggle="collapse" href="#collapse-3<?=$row['id']?>" aria-expanded="true" aria-controls="collapse-3<?=$row['id']?>">
                                  Yangilik, e'lon yoki maslahatim
                                </a>
                              </h6>
                            </div>
                            <div id="collapse-3<?=$row['id']?>" class="collapse show" role="tabpanel" aria-labelledby="heading-3<?=$row['id']?>" data-parent="#accordion-<?=$row['id']?>">
                              <div class="card-body">
                                <?=$row['msg']?>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
            <? endwhile; ?>
            <? 
              $surov=mysql_query("SELECT * from list where rol='Admin' order by fio asc");
              while ($row=mysql_fetch_assoc($surov)):?>
                <div class="col-md-6 grid-margin stretch-card">
                  <div class="card text-center">
                    <div class="card-body" >
                      <img src="images/<?=$row['rasm']?>" class="img-lg rounded-circle mb-2" alt="profile image"/>
                      <h4><?=$row['fio']?></h4>
                      <p class="text-muted"><?=$row['rol']?></p>
                      <p class="mt-4 card-text">
                        <b>Tug'ilgan kun: </b> <?=$row['born']?><br><br>
                        <i class="fa fa-home"></i> <?=$row['manzil']?>
                      </p>
                      <? if ($_SESSION['rol']=="Admin") :?>
                        <button onclick="if(confirm('Foydalanuvchi o\'chirilsinmi'))window.location.href='view.php?id=<?=$row['id']?>'" class="btn btn-info btn-sm mt-3 mb-4">O'chirish</button>
                      <? endif ?>
                      <? if ($_SESSION['id']>0) :?>
                        <div class="border-top pt-3">
                            <div class="row">
                                <div class="col-6">
                                    <h6><i class="fa fa-microchip"></i> Telefon</h6>
                                    <p><a href="tel:/<?=$row['tel']?>"><?=$row['tel']?></a></p>
                                </div>
                                <div class="col-6">
                                    <h6><i class="fab fa-telegram"></i> Telegram</h6>
                                    <p><a target="_blank" href="https://t.me/<?=$row['tlg']?>"><?=$row['tlg']?></a></p>
                                </div>
                            </div>
                        </div>
                      <? endif ?>
                      <div class="border-top pt-3">
                          <div class="row">
                              <div class="col-6">
                                  <h6>So'ngi faolligi</h6>
                                  <p><div class="badge badge-success badge-pill my-auto mx-2"><? if($row['bool']) echo 'online'; else echo $row['time']; ?></div></p>
                              </div>
                              <div class="col-6">
                                  <h6>Tashriflar soni</h6>
                                  <p><div class="badge badge-success badge-pill my-auto mx-2"><?=$row['sum']?></div></p>
                              </div>
                          </div>
                      </div>
                      <div class="mt-4">
                        <div class="accordion accordion-multi-colored" id="accordion-<?=$row['id']?>" role="tablist">
                          <div class="card">
                            <div class="card-header" role="tab" id="heading-1<?=$row['id']?>">
                              <h6 class="mb-0">
                                <a data-toggle="collapse" href="#collapse-1<?=$row['id']?>" aria-expanded="false" aria-controls="collapse-1<?=$row['id']?>">
                                  Yashashdan maqsadim
                                </a>
                              </h6>
                            </div>
                            <div id="collapse-1<?=$row['id']?>" class="collapse" role="tabpanel" aria-labelledby="heading-1<?=$row['id']?>" data-parent="#accordion-<?=$row['id']?>">
                              <div class="card-body">
                                <?=$row['maqsad']?>
                              </div>
                            </div>
                          </div>
                          <div class="card">
                            <div class="card-header" role="tab" id="heading-2<?=$row['id']?>">
                              <h6 class="mb-0">
                                <a class="collapsed" data-toggle="collapse" href="#collapse-2<?=$row['id']?>" aria-expanded="false" aria-controls="collapse-2<?=$row['id']?>">
                                  Hayotdagi shiorim
                                </a>
                              </h6>
                            </div>
                            <div id="collapse-2<?=$row['id']?>" class="collapse" role="tabpanel" aria-labelledby="heading-2<?=$row['id']?>" data-parent="#accordion-<?=$row['id']?>">
                              <div class="card-body">
                                <?=$row['shior']?>
                              </div>
                            </div>
                          </div>
                          <div class="card">
                            <div class="card-header" role="tab" id="heading-3<?=$row['id']?>">
                              <h6 class="mb-0">
                                <a class="collapsed" data-toggle="collapse" href="#collapse-3<?=$row['id']?>" aria-expanded="true" aria-controls="collapse-3<?=$row['id']?>">
                                  Yangilik, e'lon yoki maslahatim
                                </a>
                              </h6>
                            </div>
                            <div id="collapse-3<?=$row['id']?>" class="collapse show" role="tabpanel" aria-labelledby="heading-3<?=$row['id']?>" data-parent="#accordion-<?=$row['id']?>">
                              <div class="card-body">
                                <?=$row['msg']?>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
            <? endwhile; ?>
            <? 
              $surov=mysql_query("SELECT * from list where rol='Talaba' order by fio asc");
              while ($row=mysql_fetch_assoc($surov)):?>
                <div class="col-md-6 grid-margin stretch-card">
                  <div class="card text-center">
                    <div class="card-body" >
                      <img src="images/<?=$row['rasm']?>" class="img-lg rounded-circle mb-2" alt="profile image"/>
                      <h4><?=$row['fio']?></h4>
                      <p class="text-muted"><?=$row['rol']?></p>
                      <p class="mt-4 card-text">
                        <b>Tug'ilgan kun: </b> <?=$row['born']?><br><br>
                        <i class="fa fa-home"></i> <?=$row['manzil']?>
                      </p>
                      <? if ($_SESSION['rol']=="Admin") :?>
                        <button onclick="if(confirm('Foydalanuvchi o\'chirilsinmi'))window.location.href='view.php?id=<?=$row['id']?>'" class="btn btn-info btn-sm mt-3 mb-4">O'chirish</button>
                      <? endif ?>
                      <? if ($_SESSION['id']>0) :?>
                        <div class="border-top pt-3">
                            <div class="row">
                                <div class="col-6">
                                    <h6><i class="fa fa-microchip"></i> Telefon</h6>
                                    <p><a href="tel:/<?=$row['tel']?>"><?=$row['tel']?></a></p>
                                </div>
                                <div class="col-6">
                                    <h6><i class="fab fa-telegram"></i> Telegram</h6>
                                    <p><a target="_blank" href="https://t.me/<?=$row['tlg']?>"><?=$row['tlg']?></a></p>
                                </div>
                            </div>
                        </div>
                      <? endif ?>
                      <div class="border-top pt-3">
                          <div class="row">
                              <div class="col-6">
                                  <h6>So'ngi faolligi</h6>
                                  <p><div class="badge badge-success badge-pill my-auto mx-2"><? if($row['bool']) echo 'online'; else echo $row['time']; ?></div></p>
                              </div>
                              <div class="col-6">
                                  <h6>Tashriflar soni</h6>
                                  <p><div class="badge badge-success badge-pill my-auto mx-2"><?=$row['sum']?></div></p>
                              </div>
                          </div>
                      </div>
                      <div class="mt-4">
                        <div class="accordion accordion-multi-colored" id="accordion-<?=$row['id']?>" role="tablist">
                          <div class="card">
                            <div class="card-header" role="tab" id="heading-1<?=$row['id']?>">
                              <h6 class="mb-0">
                                <a data-toggle="collapse" href="#collapse-1<?=$row['id']?>" aria-expanded="false" aria-controls="collapse-1<?=$row['id']?>">
                                  Yashashdan maqsadim
                                </a>
                              </h6>
                            </div>
                            <div id="collapse-1<?=$row['id']?>" class="collapse" role="tabpanel" aria-labelledby="heading-1<?=$row['id']?>" data-parent="#accordion-<?=$row['id']?>">
                              <div class="card-body">
                                <?=$row['maqsad']?>
                              </div>
                            </div>
                          </div>
                          <div class="card">
                            <div class="card-header" role="tab" id="heading-2<?=$row['id']?>">
                              <h6 class="mb-0">
                                <a class="collapsed" data-toggle="collapse" href="#collapse-2<?=$row['id']?>" aria-expanded="false" aria-controls="collapse-2<?=$row['id']?>">
                                  Hayotdagi shiorim
                                </a>
                              </h6>
                            </div>
                            <div id="collapse-2<?=$row['id']?>" class="collapse" role="tabpanel" aria-labelledby="heading-2<?=$row['id']?>" data-parent="#accordion-<?=$row['id']?>">
                              <div class="card-body">
                                <?=$row['shior']?>
                              </div>
                            </div>
                          </div>
                          <div class="card">
                            <div class="card-header" role="tab" id="heading-3<?=$row['id']?>">
                              <h6 class="mb-0">
                                <a class="collapsed" data-toggle="collapse" href="#collapse-3<?=$row['id']?>" aria-expanded="true" aria-controls="collapse-3<?=$row['id']?>">
                                  Yangilik, e'lon yoki maslahatim
                                </a>
                              </h6>
                            </div>
                            <div id="collapse-3<?=$row['id']?>" class="collapse show" role="tabpanel" aria-labelledby="heading-3<?=$row['id']?>" data-parent="#accordion-<?=$row['id']?>">
                              <div class="card-body">
                                <?=$row['msg']?>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
            <? endwhile; ?>
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

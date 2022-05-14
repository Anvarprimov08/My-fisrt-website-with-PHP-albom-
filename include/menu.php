      <nav class="sidebar sidebar-offcanvas" id="sidebar">
        <ul class="nav">
          <li class="nav-item nav-profile">
            <div class="nav-link">
              <div class="profile-image">
                <img src="images/<?=$_SESSION['rasm']?>" alt="image"/>
              </div>
              <div class="profile-name">
                <p class="name">
                  <?=$_SESSION['fio']?>
                </p>
                <p class="designation">
                  <?=$_SESSION['rol']?>
                </p>
              </div>
            </div>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="view.php">
              <i class="fa fa-home menu-icon"></i>
              <span class="menu-title">Asosiy oyna</span>
            </a>
          </li>
          <?
            if ($_SESSION['id']!=0) { ?>
              <li class="nav-item">
                <a class="nav-link" href="edit.php">
                  <i class="far fa-file-alt menu-icon"></i>
                  <span class="menu-title">Tahrirlash</span>
                </a>
              </li>
            <? } ?> 
          <li class="nav-item">
            <a class="nav-link" href="albom.php">
              <i class="far fa-file-image menu-icon"></i>
              <span class="menu-title">Foto albom</span>
            </a>
          </li>
          <?
            if ($_SESSION['rol']=="Admin") { ?>
              <li class="nav-item">
                <a class="nav-link" href="create.php">
                  <i class="far fa-file-alt menu-icon"></i>
                  <span class="menu-title">Azo qo'shish</span>
                </a>
              </li>
          <? } ?>          
        </ul>
      </nav>
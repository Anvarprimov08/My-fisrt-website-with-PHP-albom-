      <div id="right-sidebar" class="settings-panel " style="overflow-x: auto;">
        <i class="settings-close fa fa-times"></i>
        <ul class="nav nav-tabs" id="setting-panel" role="tablist">
          <li class="nav-item">
            <a class="nav-link active" id="chats-tab" data-toggle="tab" href="#chats-section" role="tab" aria-controls="chats-section">Tarkib</a>
          </li>
        </ul>
        <div class="tab-content" id="setting-content">
          <div class="tab-pane fadeactive active" id="chats-section" role="tabpanel" aria-labelledby="chats-section">
            <div class="d-flex align-items-center justify-content-between border-bottom">
              <? $tarkib=mysql_query("SELECT id from list "); ?>
              <p class="settings-heading border-top-0 mb-3 pl-3 pt-0 border-bottom-0 pb-0">Guruh a'zolari <b style="color: red"><?=mysql_num_rows($tarkib)?></b></p>
              <small class="settings-heading border-top-0 mb-3 pt-0 border-bottom-0 pb-0 pr-3 font-weight-normal">Tashriflar soni &<br> so'ngi faolligi</small>
            </div>
            <ul class="chat-list">
              <!-- so'ngi faolligi -->
              <? $time=date("Y-m-d H-i-s"); mysql_query("UPDATE list set time='$time' where id='$id'"); ?>
              <?
                $tarkib=mysql_query("SELECT rasm, fio, rol, sum, time, bool from list where rol='Teacher' order by fio asc");
                while ($mal=mysql_fetch_assoc($tarkib)) :?>
                  <li class="list <? if($mal['bool']) echo 'active' ?>">
                    <tr>
                      <td>
                        <div class="profile"><img src="images/<?=$mal['rasm']?>" alt="image"></div>
                        <div class="info">
                          <p><? if($mal['rol']=="Teacher") echo "O'qituvchi"; else echo $mal['rol']; ?></p>
                          <p><?=$mal['fio']?></p>
                        </div>
                      </td>
                      <td>
                        <div class="badge badge-success badge-pill my-auto mx-2"><?=$mal['sum']?></div>
                        <small class="text-muted my-auto"><? if($mal['bool']) echo 'online'; else echo $mal['time']; ?></small>
                      </td>
                    </tr>
                  </li>
              <? endwhile; ?> 
              <?
                $tarkib=mysql_query("SELECT rasm, fio, rol, sum, time, bool from list where rol='Admin' order by fio asc");
                while ($mal=mysql_fetch_assoc($tarkib)) :?>
                  <li class="list <? if($mal['bool']) echo 'active' ?>">
                    <tr>
                      <td>
                        <div class="profile"><img src="images/<?=$mal['rasm']?>" alt="image"></div>
                        <div class="info">
                          <p><?=$mal['rol']?></p>
                          <p><?=$mal['fio']?></p>
                        </div>
                      </td>
                      <td>
                        <div class="badge badge-success badge-pill my-auto mx-2"><?=$mal['sum']?></div>
                        <small class="text-muted my-auto"><? if($mal['bool']) echo 'online'; else echo $mal['time']; ?></small>
                      </td>
                    </tr>
                  </li>
              <? endwhile; ?>
              <?
                $tarkib=mysql_query("SELECT rasm, fio, rol, sum, time, bool from list where rol='Talaba' order by fio asc");
                while ($mal=mysql_fetch_assoc($tarkib)) :?>
                  <li class="list <? if($mal['bool']) echo 'active' ?>">
                    <tr>
                      <td style="width: 60%;">
                        <div class="profile"><img src="images/<?=$mal['rasm']?>" alt="image"></div>
                        <div class="info">
                          <p><?=$mal['rol']?></p>
                          <p><?=$mal['fio']?></p>
                        </div>
                      </td>
                      <td>
                        <div class="badge badge-success badge-pill my-auto mx-2"><?=$mal['sum']?></div>
                        <small class="text-muted my-auto"><? if($mal['bool']) echo 'online'; else echo $mal['time']; ?></small>
                      </td>
                    </tr>
                  </li>
              <? endwhile; ?>
            </ul>
          </div>
          <!-- tarkib ends -->
        </div>
      </div>
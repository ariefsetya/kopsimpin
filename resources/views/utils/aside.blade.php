<aside class="main-sidebar">
    <section class="sidebar">
      <div class="user-panel">
        <div class="pull-left image">
          <img src="{{url('images/'.(\App\Koperasi::find(Auth::user()->assigned_koperasi)['logo']))}}" class="img-circle" alt="User Image">
        </div>
        <div class="pull-left info">
          <p>{{Auth::user()->name}}</p>
          <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
        </div>
      </div>
      <!--form action="#" method="get" class="sidebar-form">
        <div class="input-group">
          <input type="text" name="q" class="form-control" placeholder="Search...">
              <span class="input-group-btn">
                <button type="submit" name="search" id="search-btn" class="btn btn-flat"><i class="fa fa-search"></i>
                </button>
              </span>
        </div>
      </form-->
      <ul class="sidebar-menu">
        <li class="header">NAVIGATION</li>
        <?php
        $menu = \App\Menu::where('id_induk',0)
                        ->get();
        foreach ($menu as $key) {
          if(sizeof(\App\Privileges::where('id_koperasi',Auth::user()->assigned_koperasi)
                    ->where('id_users',Auth::user()->id)
                    ->where('id_menu',$key->id)->get())>0){
          $menus = \App\Menu::find($key->id);
          $child = \App\Menu::where('id_induk',$key->id)
                        ->get();
          ?>
          <li class="treeview">
            <a href="{{url($menus->url)}}"><i class="fa {!!$menus->icon!!}"></i> {{$menus->nama}} {!!(sizeof($child)>0)?'<i class="fa fa-angle-left pull-right"></i>':""!!}</a>
            <?php
            if(sizeof($child)>0){
              ?>
              <ul class="treeview-menu">
              <?php
              foreach ($child as $keychild) {
                if(sizeof(\App\Privileges::where('id_koperasi',Auth::user()->assigned_koperasi)
                                    ->where('id_users',Auth::user()->id)
                                    ->where('id_menu',$keychild->id)->get())>0){
                          $menus = \App\Menu::find($keychild->id);
                          $child = \App\Menu::where('id_induk',$keychild->id)
                                        ->get();
                          ?>
                          <li class="treeview">
                            <a href="{{url($menus->url)}}"><i class="fa {!!$menus->icon!!}"></i> {{$menus->nama}} {!!(sizeof($child)>0)?'<i class="fa fa-angle-left pull-right"></i>':""!!}</a>
                            <?php
                            if(sizeof($child)>0){
                              ?>
                              <ul class="treeview-menu">
                              <?php
                              foreach ($child as $keychild) {
                                  if(sizeof(\App\Privileges::where('id_koperasi',Auth::user()->assigned_koperasi)
                                                      ->where('id_users',Auth::user()->id)
                                                      ->where('id_menu',$keychild->id)->get())>0){
                                            $menus = \App\Menu::find($keychild->id);
                                            $child = \App\Menu::where('id_induk',$keychild->id)
                                                          ->get();
                                            ?>
                                            <li class="treeview">
                                              <a href="{{url($menus->url)}}"><i class="fa {!!$menus->icon!!}"></i> {{$menus->nama}} {!!(sizeof($child)>0)?'<i class="fa fa-angle-left pull-right"></i>':""!!}</a>
                                              <?php
                                              if(sizeof($child)>0){
                                                ?>
                                                <ul class="treeview-menu">
                                                <?php
                                                foreach ($child as $keychild) {
                                                ?>

                                                  <li><a href="{{url($keychild->url)}}"><i class="fa {{$keychild->icon}}"></i> {{$keychild->nama}}</a></li>
                                                <?php 
                                                }
                                                ?>
                                                </ul>
                                                <?php
                                              } ?>
                                            </li>
                                            <?php
                                          }
                              }
                              ?>
                              </ul>
                              <?php
                            } ?>
                          </li>
                          <?php
                        }
              }
              ?>
              </ul>
              <?php
            } ?>
          </li>
          <?php
        }
      }
        ?>
      </ul>
    </section>
  </aside>
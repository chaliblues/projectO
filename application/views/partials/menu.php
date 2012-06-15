	  <div class="navbar">
      <div class="navbar-inner">
      <div class="container">
        <a data-target=".nav-collapse" data-toggle="collapse" class="btn btn-navbar">
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
        </a>
       
        <div class="nav-collapse">
          <ul class="nav">
            <?php
                
                //Iterate to create the opinion category menus
                $menu="";
                
                foreach ($opinionCategories as $opinionCategory) {
                  $subMenu="";
                  //Get the opinion sub categories
                  foreach ($opinionSubCategories as $opinionSubCategory) {
                    //Make sure that sub category belongs to this opinion category
                    if($opinionCategory['opinionCategoryID']==$opinionSubCategory['categoryID'])
                    {
                      $subMenu.='<li><a href="#">'.$opinionSubCategory['subCategoryName'].'</a></li>';
                    }
                  }
                  $menu.='
                        <li class="dropdown">
                        <a data-toggle="dropdown" class="dropdown-toggle" href="#">'.$opinionCategory['categoryName'].'<b class="caret"></b></a>
                        <ul class="dropdown-menu">
                         '.$subMenu.'
                        </ul>
                        </li>';
                }
                
                //Echo the menu data
                echo $menu;
            ?>

          </ul>
        </div><!-- /.nav-collapse -->
      </div>
    </div><!-- /navbar-inner -->
  </div>
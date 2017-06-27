<aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
        <!-- Sidebar user panel -->

        <!-- search form -->

        <!-- /.search form -->
        <!-- sidebar menu: : style can be found in sidebar.less -->
        <ul class="sidebar-menu">
                <?php
                $result_agrupador = $consultas->getMenuAgrupador();
                if($result_agrupador){
                    //echo "si bueno mi picho";
                    foreach ($result_agrupador as $ra) {
                        ?>
                        <li class="treeview">
                            <a href="#">
                                <i class="<?php echo $ra->icon ; ?>"></i>
                                <span><?php echo $ra->descripcion ; ?></span>
                                <span class="pull-right-container">
                                  <i class="fa fa-angle-left pull-right"></i>
                                </span>
                            </a>
                            <ul class="treeview-menu">
                                <?php
                                $result_menu = $consultas->getMenuAplicativos($ra->id_menu);
                                if($result_menu){
                                    foreach ($result_menu as $m) {
                                    ?>
                                    <li>
                                        <a <?php if($m->id_aplicativo==23){
                                            echo "target='_blank'";
                                        } ?> href="controlador.php?action=<?php echo base64_encode ($m->nombre_action) ?>"><i class="fa fa-circle-o"></i> <?php echo $m->nombre_menu ?></a>
                                    </li>
                                        <?php
                                    }
                                }
                                ?>
                            </ul>
                        </li>
                        <?php
                    }
                }
                ?>

        </ul>


    </section>
    <!-- /.sidebar -->
</aside>

<?php
  $conexion = conexion::conectar();
  $permisos = pg_query($conexion, "SELECT * FROM v_permisos WHERE id_gru = (SELECT id_gru FROM usuarios WHERE id_usu = ".$_SESSION['id_usu'].") AND pe_estado = 'ACTIVO' AND pa_estado = 'ACTIVO' AND m_estado = 'ACTIVO' AND a_estado = 'ACTIVO' AND g_estado = 'ACTIVO' ORDER BY mod_descrip, pag_descrip;");
  $p1 = pg_fetch_all($permisos);
  foreach ($p1 as $p){
    if($p['id_ac']=='1'){
      $modulos[$p['id_mod']]['id_mod'] = $p['id_mod'];
      $modulos[$p['id_mod']]['mod_descrip'] = $p['mod_descrip'];
      $modulos[$p['id_mod']]['m_icono'] = $p['m_icono'];
      $paginas[$p['id_mod']][$p['id_pag']]['id_pag'] = $p['id_pag'];
      $paginas[$p['id_mod']][$p['id_pag']]['pag_descrip'] = $p['pag_descrip'];
      $paginas[$p['id_mod']][$p['id_pag']]['pag_ubicacion'] = $p['pag_ubicacion'];
      $paginas[$p['id_mod']][$p['id_pag']]['pa_icono'] = $p['pa_icono'];
    }
  }
?>
<aside class="<?php echo $_SESSION['color_menu'];?>">
  <a href="/sysgrafica/inicio.php" class="<?php echo $_SESSION['color_logo'];?>">
    <img src="/sysgrafica/iconos/icono_cdt_blanco.png" alt="SYSGRAFICA LOGO" class="brand-image img-circle elevation-3" style="opacity: .8">
    <span class="brand-text font-weight-light">SysGrafica</span>
  </a>
  <div class="sidebar">
    <div class="user-panel mt-3 pb-3 mb-3 d-flex">
      <div class="image">
        <img src="<?php echo $_SESSION['usu_imagen'];?>" class="img-circle elevation-2" alt="User Image">
      </div>
      <div class="info">
        <a class="d-block">
          <?php echo $_SESSION['per_nombre']." ".$_SESSION['per_apellido'];?>
        </a>
      </div>
    </div>
    <div class="user-panel mt-3 pb-3 mb-3 d-flex">
      <div class="image">
        <img src="<?php echo $_SESSION['suc_imagen'];?>" class="img-circle elevation-2" alt="User Image">
      </div>
      <div class="info">
        <a class="d-block">
          <?php echo $_SESSION['suc_nombre'];?>
        </a>
      </div>
    </div>
    <nav class="mt-2">
      <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
        <?php foreach($modulos as $m){ ?>
          <li class="nav-item has-treeview <?php if($m['id_mod'] == $_SESSION['id_mod']){ echo "menu-open"; $_SESSION['id_mod'] = null;} ?>">
            <a href="#" class="nav-link">
              <i class="nav-icon <?php echo $m['m_icono'];?>"></i>
              <p>
                <?php echo $m['mod_descrip']; ?>
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <?php foreach($paginas[$m['id_mod']] as $p){ ?>
                <li class="nav-item">
                  <a href="<?php echo $p['pag_ubicacion']; ?>" class="nav-link <?php if($p['id_pag'] == $_SESSION['id_pag']){ echo "active";} ?>">
                    <i class="<?php echo $p['pa_icono'];?> nav-icon"></i>
                    <p><?php echo $p['pag_descrip']; ?></p>
                  </a>
                </li>
              <?php } ?>
            </ul>
          </li>
        <?php } ?>
      </ul>
    </nav>
  </div>
</aside>
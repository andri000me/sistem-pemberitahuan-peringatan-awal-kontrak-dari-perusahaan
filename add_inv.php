<?php
  $page_title = 'Add Product';
  require_once('includes/load.php');
  // Checkin What level user has permission to view this page
  page_require_level(2);
  $all_categories = find_all('categories');
  $all_photo = find_all('media');
?>
<?php
 if(isset($_POST['add_inv'])){
   $req_fields = array('nm_peralatan','lokasi','merek','tipe', 'kondisi','buatan','ket','code' );
   validate_fields($req_fields);
   if(empty($errors)){
     $p_name  = remove_junk($db->escape($_POST['nm_peralatan']));
     $p_lokasi    = remove_junk($db->escape($_POST['lokasi']));
     $p_merek     = remove_junk($db->escape($_POST['merek']));
     $p_tipe      = remove_junk($db->escape($_POST['tipe']));
     $p_kondisi   = remove_junk($db->escape($_POST['kondisi']));
     $p_buatan    = remove_junk($db->escape($_POST['buatan']));
     $p_ket       = remove_junk($db->escape($_POST['ket']));
     $p_code      = remove_junk($db->escape($_POST['code']));
     $date        = make_date();
     $query  = "INSERT INTO inv (";
     $query .=" id,nm_inv,lokasi,merek,tipe,kondisi,buatan,date,ket";
     $query .=") VALUES (";
     $query .=" '{$p_code}', '{$p_name}', '{$p_lokasi}', '{$p_merek}', '{$p_tipe}', '{$p_kondisi}', '{$p_buatan}', '{$date}', '{$p_ket}'";
     $query .=")";
     //$query .=" ON DUPLICATE KEY UPDATE name='{$p_name}'";
     if($db->query($query)){
       $session->msg('s',"Product added ");
       redirect('add_inv.php', false);
     } else {
       $session->msg('d',' Sorry failed to added!');
       redirect('inv.php', false);
     }

   } else{
     $session->msg("d", $errors);
     redirect('add_inv.php',false);
   }

 }

?>
<?php include_once('layouts/header.php'); ?>
<div class="row">
  <div class="col-md-12">
    <?php echo display_msg($msg); ?>
  </div>
</div>
  <div class="row">
  <div class="col-md-8">
      <div class="panel panel-default">
        <div class="panel-heading">
          <strong>
            <span class="glyphicon glyphicon-th"></span>
            <span>Add New Product</span>
         </strong>
        </div>
        <div class="panel-body">
         <div class="col-md-12">
          <form method="post" action="add_inv.php" class="clearfix">
  
              <div class="form-group">
                <label  class="control-label">Nama Peralatan</label>
                <input type="text" class="form-control" name="nm_peralatan" placeholder="Nama Peralatan">
              </div>
              <div class="form-group">
                <label  class="control-label">Lokasi</label>
                <input type="text" class="form-control" name="lokasi" placeholder="Lokasi">
              </div>
              <div class="form-group">
                <label  class="control-label">Merek</label>
                <input type="text" class="form-control" name="merek" placeholder="Merek">
              </div>
              <div class="form-group">
                <label  class="control-label">Tipe</label>
                <input type="text" class="form-control" name="tipe" placeholder="Tipe">
              </div>
              <div class="form-group">
                <label class="control-label">Kondisi</label>
                <input type="text" class="form-control" name="kondisi" placeholder="Kondisi">
              </div>
              <div class="form-group">
                <label  class="control-label">Buatan</label>
                <input type="text" class="form-control" name="buatan" placeholder="Buatan">
              </div>
              <div class="form-group">
                <label class="control-label">Ket</label>
                <input type="text" class="form-control" name="ket" placeholder="Ket">
              </div>
              <div class="form-group">
                <label  class="control-label">Code</label>
                <input type="text" class="form-control" name="code" placeholder="Code">
              </div>
              

           

           
              <button type="submit" name="add_mitra" class="btn btn-danger">Add product</button>
              <a href="inv.php" class="btn btn-primary">Back</a>
          </form>
         </div>
        </div>
      </div>
    </div>
  </div>

<?php include_once('layouts/footer.php'); ?>

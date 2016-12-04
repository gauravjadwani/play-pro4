<!DOCTYPE html>
<?php
include '../common_utilities/header.php';
include_once '../controller/list_user_groups.php';

?>
  
<div class="container">
    <div class="row">
        
  
  <h2>VIEW YOUR PROJECTS </h2>
  
  <div class="table-responsive">
  <table class="table">
      
    <thead>
        <th>ID</th>
        <th>NAME</th>
        <th>CREATED ON</th>
        <th>CLOSED ON</th>
        <th>CREATED BY</th>
        <th>LIST OF PROJECTS</th>
        <th>role<th>
        
      
    </thead>
    <tbody>
        
      <?php

      if(!empty($list_group_details_owner))
      {

      foreach($list_group_details_owner as $d)

      
      {


        foreach($d as $k)
        {
      
          print_r($d);
          echo 'ga';
          //print_r($d[4]);
          //r_dump($d[4]);
          foreach($d[4] as $p)
          echo $p;
          exit();

          


      ?>
      <tr>
        <td><?php echo $k;?>
          
        </td>
        <?php } ?>
      </tr>
      <?php }
      }
      
      ?>
      

    </tbody>
  </table>
  </div>
</div>


    
    
    </div>
        </div>

</body>
</html>


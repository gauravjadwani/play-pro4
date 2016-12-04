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

      if(!empty($list_group_details_modifier))
      {

      foreach($list_group_details_modifier as $d)

      
      {


        foreach($d as $k)
        {
      


          foreach($k as $k1)


      ?>
      <tr>
        <td><?php echo $k1;?>
          
        </td>
        <?php } ?>
      </tr>
      <?php }
      }
      }
      ?>
      


<?php

      if(!empty($list_group_details_owner))
      {

      foreach($list_group_details_owner as $d)
      {


        foreach($d as $k)
        {
      


      foreach($k as $k1)
      {


      ?>
      <tr>
        <td><?php echo $k;?>
          
        </td>
        <?php } ?>
      </tr>
      <?php }
      }}
      ?>
      

      <?php

      if(!empty($list_group_details_readonly))
      {

      foreach($list_group_details_readonly as $d)
      {


        foreach($d as $k)
        {
      
          foreach($k as $k1)

      


      ?>
      <tr>
        <td><?php echo $k;?>
          
        </td>
        <?php } ?>
      </tr>
      
      <?php }
      }}
      ?>
      



    </tbody>
  </table>
  </div>
</div>


    
    
    </div>
        </div>

</body>
</html>


<?php
include_once '../common_utilities/header.php';


?>

<div class="container">
    <div class="row">
        <div class="col-md-4">
            <ul class="list-group">
            <h2>NOTIFICATIONS</h2>
            <hr>
                <?php
                 
              include '../controller/notifications.php';
                
                ?>
                </ul>
            </div>
            
        <div class="col-md-4">
            <div class="row">
                
                
                    <h2>PENDING SELF TASKS</h2>
                    <hr>
                   
               
                    
  
  <ul class="list-group">

            <?php
            //if(!empty($_POST['date']))
            require_once 'display_pending_self_tasks.php';
            ?>
      </ul>
      
         
                 
</div>
        </div>
        <div class="col-md-4">
            <ul class="list-group">
            <h2>PENDING PROJECT</h2>
            <hr>
                <?php
                 
    require_once  'display_pending_projects.php';
                
                ?>
                </ul>
            </div>
    </div>
    </div>

</body>
</html>


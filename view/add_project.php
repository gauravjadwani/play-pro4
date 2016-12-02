<?php 
include_once '../common_utilities/header.php';
include_once '../controller/list_group_project.php';
?>
<div class="container">
    <div class="row">
        <div class="col-md-3">
        </div>
         <form action="../controller/add_project.php" method="POST">
        <div class="col-md-7">
            <div class='row'>
                 <h1>&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbspNAME OF THE PROJECT</h1>
                <div class="col-md-2"></div>
                 <div class="col-md-10"><hr>
                 </div>
                
                
                   
                
            
           <div class="col-md-3" style="font-size: 200%;color:purple">NAME</div>
           <div class="col-md-9">
               
                <div class="form-group">
    
    <input class="form-control input-lg" name="name_of_the_project" type="text" placeholder="name of the project">
                </div>
               
        </div>  
           </div>
             &nbsp
            <div class="row">
                 <div class="form-group">
            <div class="col-md-3" style="font-size: 200%;color:purple">GROUP</div>
           <div class="col-md-9">
               
               
               <select class="form-control" name="associated_group">
      
              <option  selected value='default'> -- select a group -- </option>
              <?php
                   
                   foreach($list_group_permission as $groups)
                   {
                       //print_r($list_groups);
                       //print_r($groups);
                   ?>
                   <option value='<?php echo $groups;?>'><?php echo $groups;?></option>
                   
                   
                   <?php }
                   
                   ?>
               </select>
                
                  </div>
               
        </div>  </div>
           

            
             &nbsp
            <div class='row'>
            <div class="form-group">
      <div class="col-md-3" style="font-size: 200%;color:purple">DESC</div>
      <div class="col-md-9">
      <textarea class="form-control" rows="3" name="desc" placeholder="Description for the project"></textarea>
    </div>
                
      </div></div>
            &nbsp
            <div class='row'>
           <div class="form-group">
               <div class="col-md-3" style="font-size: 200%;color:purple">DATE</div>
               
                   
              
                <div class="col-md-9">
                    
           
           <input type="date" name="deadline" class="form-control">&nbsp&nbsp&nbsp
         
            </div>
               
            
               </div>
               <div class="col-md-3">
                   
               </div>
               <div class="col-md-9">
                <button type="submit" class="btn btn-default">Submit</button>
                </div>
           </div>
                </div>
      
    </div>
    </div>

</body>
</html>




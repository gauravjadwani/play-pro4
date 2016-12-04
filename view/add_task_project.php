<!DOCTYPE html>
    <?php
    
    include '../common_utilities/header.php';
    include '../controller/list_user_projects.php';


    ?>




        
        
    <form action="../controller/add_task_to_project.php" method="POST">
        
<div class="container">
    <div class="row">
        <div class="col-md-6">
             <div class="well">
            <div class="row">
       
       
                
       
           <div class="col-md-2"> <b>DATE</b></div><div class="col-md-10"><input type="date" name="date"></div>
         
           
               </div>
            
        
                
                
                
                
                </div>
            <div class="row">
                <hr>
            <div class='col-md-2'>
  <label for="sel1">Select Project:</label>
 
            </div>
            <div class='col-md-10'>
                
                <select class="form-control" name="project_id">
      
      
      <?php
if($list_user_projects!='empty projects')
foreach ($list_user_projects as $pro) 
{





      ?>
 
       
      <option value="<?php echo $pro; ?>"><?php echo $pro; ?>
        
      </option>
  
      
      <?php

}
      ?>
      
      
      </select>
            </div>
                
                
                
                
                </div>
            </div>
        
        <div class="col-md-6">
            <div class="row">
            
            <div class = "form-group">
      <label for = "task" class = "col-sm-2 control-label" style="font-size: 20px">Task</label>
		
      <div class = "col-md-7">
       <input type = "text" class = "form-control" name ="task" placeholder ="Enter Task">
      </div>
      <div class="col-md-3">
          </div>
   </div>
                </div>&nbsp
            <div class="row">
                        <div class = "form-group">
      <label for = "email" class = "col-md-2 control-label" style="font-size: 20px">Priority</label>
		
      <div class = "col-md-7">
       <input type = "number" class = "form-control" name = "priority" placeholder ="Enter Priority" min="1">
      </div>
      <div class="col-sm-3">
          </div>  
   
              </div>
            </div>&nbsp
            
                <div class="row">
                    <div class="col-md-2">
                        
                    </div>
               
                <div class="row">
                    <div class="col-md-2">
                        
                    </div>
                    
                    <div class="col-md-7">
                        <br>
                    <button type = "submit" class = "btn btn-default">Submit</button>
                    </div>
            
            
            
            
        </div>
</div>
        </div>
    </div>
    </div>
            
            </form>
        </body>
        </html>
    
<!DOCTYPE html>
  
<?php
include_once '../common_utilities/header.php';
?>
        
        
        
        
        
        
        
        <form action="../controllers/addtask_toself.php" method="POST">
        
<div class="container">
    <div class="row">
        <div class="col-md-6">
             <div class="well">
            <div class="row">
       
       
                
       
           <div class="col-md-2"> <b>DATE</b></div><div class="col-md-10"><input type="date" name="date"></div>
         
           
               </div>
            
        
                
                
                
                
                </div>
            
                
                
                
                
                </div>
            
        
        <div class="col-md-6">
            <div class="row">
            
            <div class = "form-group">
      <label for = "email" class = "col-sm-2 control-label" style="font-size: 20px">Task</label>
		
      <div class = "col-md-7">
       <input type = "text" class = "form-control" name = "task" placeholder ="Enter Task">
      </div>
      <div class="col-md-3">
          </div>
   </div>
                </div>&nbsp
            <div class="row">
                        <div class = "form-group">
      <label for = "email" class = "col-md-2 control-label" style="font-size: 20px">Priority</label>
		
      <div class = "col-md-7">
       <input type = "number" class = "form-control" name = "priority" placeholder ="Enter Priority" min="0">
      </div>
      <div class="col-sm-3">
          </div>
   
              </div>
            </div>&nbsp
            <hr>
             
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
    </div>
            
            </form>
        </body>
        </html>
    
            

<?php
include_once '../common_utilities/header.php';
?>
    <div class='container'>
        <div class='row'>
            <div class="col-sm-3"></div>
            <form action='../controller/add_group.php' method='POST'>
            <div class="col-sm-7">
                    <h1>GROUP DETAILS</h1>
                    <hr>
                    <div class="<form-group">
                        
                        <input class="form-control input-lg" name="name_of_group" type="text" placeholder="name of the group">
                        &nbsp
      <textarea class="form-control" rows="3" name="list_members_modify" placeholder="MODIFY-members accociated with the project seperate them with the ,"></textarea>
    </div>
                    &nbsp
                    <div class="form-group">
                        
      <textarea class="form-control" rows="3" name="list_members_readonly" placeholder="READ ONLY-members accociated with the project seperate them with the ,"></textarea>
    </div>
   
                    <button type="submit" class="btn btn-default">Submit</button>
                </div>
            </form>
            <div class="col-sm-2">
                
            </div>
        </div>
</div>
        
                

</body>
</html>


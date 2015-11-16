<style type="text/css">
  table td {
    white-space: nowrap;
  }
</style>


<div class="container">

  <div style="margin-top:50px;" class="mainbox col-md-12">
    
    <div id="users" class="table-responsive col-md-offset-1">
      <h3 class="col-md-offset-5">Users   </h3>
      <div class="col-md-3 col-md-offset-3">
        <table class="table table-striped">
          <?php

            //output student table.
            $results = get_user_list();
            if(!$results) {
              echo "Database Error";
            }
            else {
              // table headers
                    echo '<thead><tr>';
                    echo '<th><a href="add-user-form.php">
                         <img class="table-icon" src="./res/image/add-user.png"></a></th>
                          <th>Username</th>
                          <th>Email</th>
                          <th>Admin</th>
                          ';
                    echo '</tr></thead>';
                    echo '<tbody>';
                   //fill in rows with data
                   while($row = $results->fetch_assoc()) {
                      echo '<tr>
                           <td><a href="#" onclick="Confirm.render(\'Delete User?\',\'delete_user\',\'', $row['user_key'], '\')">
                           <img class="table-icon" src="./res/image/rm-user.png">
                           </a></td>
                           <td>', $row['username'],'</td>
                           <td>', $row['email'],'</td>
                           <td>', $row['admin'],'</td>
                          '
                            ;
                    }
                     echo '</tbody>';
                }
          ?>
        </table>
      </div>
    </div>
  </div>
<!-- Modal -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
        <h4 class="modal-title text-center">USUWASZ POST</h4>
      </div>
      <div class="modal-body">
          <h2 class="text-center">Na pewno chcesz usunąć post?</h2>
      </div>
      <div class="modal-footer">

      <form method="post">
           <label for="id">Usuń post o ID</label>
            <input type="text" name="id" class="modal_delete btn btn-default">
            <input name="" value="Anuluj" type="button" class="btn btn-success" data-dismiss="modal">
            <input type="submit" name="delete" value="Usuń" class="form-group btn btn-danger">
      </form>

     <!--  <a class="btn btn-danger modal_delete">Delete</a> -->
        
       <!--  <a class="btn btn-default" data-dismiss="modal">Cancel</a> -->
      </div>
    </div>
  </div>
</div>

<?php
   if(isset($_POST['delete'])){

    $postId = $_POST['id'];

     if(isset($_POST['delete'])){

            $deletePostId = mysqli_real_escape_string($conn, $postId);

            $query = "DELETE FROM post WHERE id = {$deletePostId} ";

            $delete_post = mysqli_query ($conn, $query);
            header("Location: posts.php");
        }
   }


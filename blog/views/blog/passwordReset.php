<div id="bloc_inscription">    
    <?php 
        if(!isset($_POST['oublie_password']))
        {
            echo'
            <form role="form" method="POST" action='.WEBROOT.'blog/passwordReset>
                <div class="form-group">
                    <label for="email">Mon email :</label>
                    <input type="text" class="form-control" id="email" name="email">
                </div>
                <input type="submit" class="btn btn-default" value="submit" name="oublie_password">
            </form>
            ';
        }
        else
        {
            echo $adresse;
        }
    ?>
</div>


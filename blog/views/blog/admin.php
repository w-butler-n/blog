<div>
    <?php
        echo '
            <table class="table">
            <thead>
                <tr>
                    <th>id</th>
                    <th>identifiant</th>
                    <th>telephone</th>
                    <th>email</th>
                    <th>naissance</th>
                    <th>genre</th>
                    <th>level</th>
                    <th>ip</th>
                </tr>
            </thead>
            <tbody>';
        foreach($info_users as $key)
        {
            echo 
                '<form method="POST" action='.WEBROOT.'administration/update_user/'.$key['id'].'>
                    <tr>
                        <td>'.$key['id'].'</td>
                        <td><input type="text" value='.$key['identifiant'].' name="identifiant"></td>
                        <td><input type="text" value='.$key['telephone'].' name="telephone"></td>
                        <td><input type="text" value='.$key['email'].' name="email"></td>
                        <td><input type="text" value='.$key['naissance'].' name="naissance"></td>
                        <td><input type="text" value='.$key['genre'].' name="genre"></td>
                        <td><input type="text" value='.$key['level'].' name="level"></td>
                        <td>'.$key['ip'].'</td>
                        <td><input type="submit" value="update" name="update_user"></form></td>
                        <td><form method="POST" action='.WEBROOT.'administration/delete_user/'.$key['id'].'><input type="submit" name="delete_user" value="delete"></td>
                    </tr>
                </form>';
            }
        echo 
            '</tbody>
            </table>';
        foreach($article as $key)
        {
            echo'
                <form method="POST" action='.WEBROOT.'administration/update_article/'.$key['id'].'>
                    <textarea name="titre">'.$key['titre'].'</textarea>
                    <textarea name="contenu">'.$key['contenu'].'</textarea>
                    <input type="text" value='.$key['image'].' name="image">
                    <input type="text" value='.$key['genre'].' name="genre">
                    <input type="submit" value="update" name="update_article">
                </form>
                <form method="POST" action='.WEBROOT.'administration/delete_article/'.$key['id'].'>
                    <input type="submit" value="delete" name="delete_article">
                </form>'
            ;
        }
    ?>
</div>

<div>
    <form method="post" action=<?php echo WEBROOT.'administration/add_tags';?>>
        <div class="form-group">
            <label for="tags">New tags</label>
            <input type="tags" class="form-control" id="tags" name="new_tags">
            <input type="submit" class="btn btn-default" name="insert_tags">
        </div>
    </form>
</div>
<?php
    foreach($tags as $key)
            {
                echo'
                    <form method="POST" action='.WEBROOT.'administration/update_tags/'.$key['tags'].'>
                        <input type="text" value='.$key['tags'].' name="tags">
                        <input type="submit" value="update" name="update_tags">
                    </form>
                    <form method="POST" action='.WEBROOT.'administration/delete_tags/'.$key['tags'].'>
                        <input type="submit" value="delete" name="delete_tags">
                    </form>'
                ;
            }
?>

<div>
    <form method="post" action=<?php echo WEBROOT.'application/ajout_article';?> enctype="multipart/form-data">
        <div class="form-group">
            <label for="name">Name</label>
            <input type="text" class="form-control" id="name" name="titre">
            <label for="name">Text Area</label>
            <textarea class="form-control" rows="3" name="contenu"></textarea>
            <label for="genre_article">Genre</label>
            <input type="text" class="form-control" id="genre_article" name="genre_article">
        </div>
        <div class="form-group">
            <label for="inputfile">File input</label>
            <input type="file" id="inputfile" name="image">
        </div>
        <input type="submit" class="btn btn-default" name="new_article">
    </form>
</div>
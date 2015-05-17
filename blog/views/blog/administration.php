<div>
    <?php
        foreach($infos_user as $key)
        {
            echo
                '<div>
                        <span>pseudo : '.$key['login'].'</span><br>
                        <span>number : '.$key['telephone'].'</span><br>
                        <span>email : '.$key['email'].'</span><br>
                        <span>date de naissance : '.$key['naissance'].'</span><br>
                        <span>genre : '.$key['genre'].'</span><br>
                        <span>Level : '.$key['level'].'</span><br>
                </div>
            ';
        }
    ?>
</div>

<div>
    <h3>Update information</h3>
    <?php
        foreach($infos_user as $key)
        {
            echo
                '<form action='.WEBROOT.'users/update_infos/'.$key['id'].' method="POST">
                        <span>'.$key['login'].'</span><br>
                        <label for="phone">Number :</label><input type="texte" name=telephone id="phone" value='.$key['telephone'].'><br>
                        <label for="email">Email :</label><input type="texte" name=email id="email" value='.$key['email'].'><br>
                        <span>date de naissance : '.$key['naissance'].'</span><br>
                        <span>genre : '.$key['genre'].'</span><br>
                        <span>Level : '.$key['level'].'</span><br>
                        <input type="submit" value="submit">
                </form>
            ';
        }
    ?>
</div>
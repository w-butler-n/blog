<div class="clearfix englobe_article">
    <?php
       	foreach($article as $key)
        {
            echo
            ' 
                <article class="clearfix bloc_article">
                    <div class="header_article">
                        <h2>'.$key['title'].'</h2>
                        <div>
                            <span id="infos_article">Posted on '.$key['created'].' by '.$key['login'].' '.$key['updated'].'</span>
                        </div>
                    </div>
                    <div class="contenu_article">
                        <img src='.WEBROOT.'/test/'.$key['image'].' alt="image_article" class="image_article">
                    </div>
                    <p>'.$key['content'].'</p>
                </article>
            ';
        }

    ?>
</div>

<aside class="englobe_widget">
    <div class="englobe_tags">
        <h3>Categorie</h3>
        <ul>
            <?php
                foreach($tags as $key)
                {
                    echo'<li><a href='.WEBROOT.'blog/tags/'.$key['tags'].'>'.$key['tags'].'</a></li>';
                }
            ?>
        </ul>
    </div>
</aside>

<div id="bloc_commentaire">
    <h3>Commentaires</h3>
    <div id="contain_commentaire">
        <?php 
            foreach($commentaire as $key)
            {
                
                    if(isset($_SESSION['level']))
                    {
                        if($_SESSION['level'] == 'admin_view' || !empty($_SESSION['level']))
                        {
                            echo'
                            <div>
                                <span id="infos_article">'.$key['pseudo'].' '.$key['date_ajout'].'</span>
                                <form action='.WEBROOT.'/administration/delete_commentaire/'.$key['id'].'>
                                    <textarea name="new_comment">'.$key['commentaire'].'</textarea>
                                    <input type="submit" value="delete">
                                </form>
                            </div>
                            ';
                        }
                    }
                
                else
                {
                    echo'
                    <div>
                        <span id="infos_article">'.$key['pseudo'].' '.$key['date_ajout'].'</span>
                            <p>'.$key['commentaire'].'<p>
                    </div>
                    ';
                }
            }
       ?>
    </div>
    <div id="englobe_formulaire_commentaire">
        <form method="POST" action=<?php echo ''.WEBROOT.'application/ajout_commentaires'?>>
            <textarea name="commentaire"></textarea>
            <input type="submit" name="add_commentaire">
        </form>
    </div>
</div>
        

<div class="next-previous">
    <?php
        echo '</div><a href='.WEBROOT.'blog>precedent</a>';
    ?>
</div>
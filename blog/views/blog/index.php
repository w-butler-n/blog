<div class="clearfix englobe_article">
    <?php
        if(isset($erreur))
        {
            echo $erreur;
        }
       
        if(isset($articles))
        {
            foreach($articles as $key)
            {
                if(isset($_SESSION['level']))
                {
                    if($_SESSION['level'] == 'admin_view')
                    {
                        $delete = '<a href='.WEBROOT.'administration/delete_article/'.$key['id'].'><img class="delete_article" src='.WEBROOT.'/img/delete.png alt=""></a>';
                        $edit = '<a href='.WEBROOT.'administration/update_article_by_index/'.$key['id'].'><img class="edit_article" src='.WEBROOT.'/img/edite.png alt=""></a>';
                    }
                }
                if(isset($delete) && isset($edit))
                {
                    echo
                ' 
                    <article class="clearfix bloc_article">
                        <div class="header_article">
                            <h2>'.$key['title'].'</h2>
                            <div>
                                <span id="infos_article">Posted on '.$key['created'].' by '.$key['login'].'</span>
                            </div>
                        </div>
                        <div class="contenu_article">
                            <img src='.WEBROOT.'/test/'.$key['image'].' alt="image_article" class="image_article">
                        </div>
                        <p>'.$key['content'].'</p>
                        <div id="readmore">
                            <a href='.WEBROOT.'blog/article/'.$key['id'].' id="lien_readmore">Read More</a>
                        </div>
                        '.$edit.' '.$delete.'
                    </article>
                ';
                }
                else if($key['video'] == '')
                {
                    echo
                    ' 
                        <article class="clearfix bloc_article">
                            <div class="header_article">
                                <h2>'.$key['title'].'</h2>
                                <div>
                                    <span id="infos_article">Posted on '.$key['created'].' by '.$key['login'].'</span>
                                </div>
                            </div>
                            <div class="contenu_article">
                                <img src='.WEBROOT.'/test/'.$key['image'].' alt="image_article" class="image_article">
                            </div>
                            <p>'.$key['content'].'</p>
                            <div id="readmore">
                                <a href='.WEBROOT.'blog/article/'.$key['id'].' id="lien_readmore">Read More</a>
                            </div>
                        </article>
                    ';
                }
                else
                {
                    echo
                    ' 
                        <article class="clearfix bloc_article">
                            <div class="header_article">
                                <h2>'.$key['title'].'</h2>
                                <div>
                                    <span id="infos_article">Posted on '.$key['created'].' by '.$key['login'].'</span>
                                </div>
                            </div>
                            <div class="contenu_article">
                                
                            </div>
                            <p>'.$key['content'].'</p>
                            <div id="readmore">
                                <a href='.WEBROOT.'blog/article/'.$key['id'].' id="lien_readmore">Read More</a>
                            </div>
                        </article>
                    ';
                }
            }
        }
    ?>
</div>

<aside class="englobe_widget">
    <div class="englobe_tags">
        <h3>Categorie</h3>
        <ul>
            <?php
                if(isset($tags))
                {
                    foreach($tags as $key)
                    {
                        echo'<li><a href='.WEBROOT.'blog/tags/'.$key['tags'].'/1>'.$key['tags'].'</a></li>';
                    }
                }
            ?>
        </ul>
    </div>
</aside>


<div class="next-previous">
    <?php
        if(isset($pagination_precedent))
        {
            echo $pagination_precedent;
        }
        if(isset($pagination_suivant))
        {
            echo $pagination_suivant;
        }
    ?>
</div>
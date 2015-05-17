<header>
    <h1>Dashboard</h1>
</header>

<nav>
    <ul>
        <li>
            <figure>
                <a href=<?php echo WEBROOT.'blog/user/'.$_SESSION['user'].'/infos-users ';?>>
                    <img src=<?php echo WEBROOT.'/img/user.png ';?> alt="QSDF">
                    <figcaption>Users</figcaption>
                </a>
            </figure>
        </li>
        <li>
            <figure>
                <a href=<?php echo WEBROOT.'blog/user/'.$_SESSION['user'].'/article ';?>>
                    <img src=<?php echo WEBROOT.'/img/article.png ';?> alt="QSDF">
                    <figcaption>Article</figcaption>
                </a>
            </figure>
        </li>
        <li>
            <figure>
                <a href=<?php echo WEBROOT.'blog/user/'.$_SESSION['user'].'/tags ';?>>
                    <img src=<?php echo WEBROOT.'/img/tags.png ';?> alt="QSDF">
                    <figcaption>Tags</figcaption>
                </a>
            </figure>
        </li>
        <li>
            <figure>
                <a href="#">
                    <img src=<?php echo WEBROOT.'/img/statistics.png ';?> alt="ED">
                    <figcaption>Statistics</figcaption>
                </a>
            </figure>
        </li>
        <li>
            <figure>
                <a href=<?php echo WEBROOT.'blog/user/'.$_SESSION['user'].'/mail';?>>
                    <img src=<?php echo WEBROOT.'/img/mail.png ';?> alt="QSDF">
                    <figcaption>Mail</figcaption>
                </a>
            </figure>
        </li>
        <li id="visuel">
            <figure>
                <a href=<?php echo WEBROOT.'administration/view_site_admin';?>>
                    <img src=<?php echo WEBROOT.'/img/visuel_site.png ';?> alt="QSDF">
                    <figcaption>Visuel</figcaption>
                </a>
            </figure>
        </li>
        <li>
            <figure>
                <a href=<?php echo WEBROOT.'users/logout';?>>
                    <img src=<?php echo WEBROOT.'/img/logout.png ';?> alt="QSDF">
                    <figcaption>logout</figcaption>
                </a>
            </figure>
        </li>
    </ul>
</nav>

<?php
    if(isset($flag_article))
    {
        echo 
        '
        <h2>Add New Post</h2>

        <div id="form_add">
            <form method="post" action='.WEBROOT.'application/ajout_article enctype="multipart/form-data">
                <div class="form-group">
                    <label for="name" class="text_align_center_label">Title</label>
                    <input type="text" class="form-control" id="input_title" name="titre">
                    <label for="name" class="text_align_center_label">Contenu</label>
                    <textarea class="form-control" rows="3" name="contenu"></textarea>
                    <div id="vid">
                        <label class="text_align_center_label">Video</label>
                        <input type="text" class="form-control" id="input_title" name="video">
                    </div>
                    <div id="englobe_input_select_file" class="clearfix">    
                        <div id="englobe_input_file">
                            <label for="inputfile">image</label>
                            <input type="file" id="inputfile" name="image">
                        </div>
                        <div>
                            <label for="genre_article">Genre</label><br>
                            <select name="genre_article">
                                <option value="shojo">shojo</option>
                                <option value="shonen">shonen</option>
                                <option value="seinen">seinen</option>
                                <option value="seijin">seijin</option>
                                <option value="komodo">komodo</option>
                            </select>
                        </div>
                    </div>
                </div>
                <input type="submit" class="btn btn-default" name="new_article" id="input_submit_article">
            </form>
        </div>
        ';
    }
?>
    
<?php 
    if(isset($article))
    {
        echo 
        '
        <div id="div_table_article">
            <table id="table_article">
                <tr>
                    <th>Title</th>
                    <th>Contenu</th>
                    <th>Image</th>
                    <th>Genre</th>
                    <th>Date_ajout</th>
                    <th>Added by</th>
                    <th>Ip</th>
                    <th width="110" class="ac">Content Control</th>
                </tr>
                    ';
        foreach($article as $key)
        {
            if(strlen($key['content']) > 60)
            {
                $key['content'] = substr($key['content'], 0,30).' ...';
            }
            echo
            '
                <tr>
                    <td><h3><a href="#">'.$key['title'].'</a></h3></td>
                    <td>'.$key['content'].'</td>
                    <td>'.$key['image'].'</td>
                    <td>'.$key['tags'].'</td>
                    <td>'.$key['created'].'</td>
                    <td>'.$key['login'].'</td>
                    <td>'.$key['ip'].'</td>
                    <td><a href='.WEBROOT.'administration/delete_article/'.$key['id'].' class="ico del">Delete</a><a href='.WEBROOT.'blog/user/'.$_SESSION['user'].'/edit-article/'.$key['id'].' class="ico edit">Edit</a></td>
                </tr>
            ';
        }
            echo '
            </table>
            '.$pagination_precedent.' '.$pagination_suivant.'
        </div>
        ';
    }

    else if(isset($users))
    {
        echo 
        '
        <div id="div_table_article">
            <table id="table_article">
                <tr>
                    <th>Id</th>
                    <th>Identifiant</th>
                    <th>email</th>
                    <th>number</th>
                    <th>genre</th>
                    <th>date de naissance</th>
                    <th>date d\'inscription</th>
                    <th>level</th>
                    <th>ip</th>
                    <th width="110" class="ac">Content Control</th>
                </tr>
                    ';
        foreach($users as $key)
        {
            if($_SESSION['user'] != 'admin')
            {
                if($key['login'] != 'admin')
                {
                    echo
                '
                <tr>
                    <td>'.$key['id'].'</td>
                    <td>'.$key['login'].'</td>
                    <td>'.$key['email'].'</td>
                    <td>'.$key['telephone'].'</td>
                    <td>'.$key['genre'].'</td>
                    <td>'.$key['naissance'].'</td>
                    <td>'.$key['date_inscription'].'</td>
                    <td>'.$key['level'].'</td>
                    <td>'.$key['ip'].'</td>
                    <td><a href='.WEBROOT.'administration/delete_user/'.$key['id'].' class="ico del">Delete</a><a href='.WEBROOT.'blog/user/'.$_SESSION['user'].'/edit-user/'.$key['login'].' class="ico edit">Edit</a></td>
                </tr>
                ';
                }
            }
            else if($_SESSION['user'] == 'admin')
            {
                
                    echo
                '
                <tr>
                    <td>'.$key['id'].'</td>
                    <td>'.$key['login'].'</td>
                    <td>'.$key['email'].'</td>
                    <td>'.$key['telephone'].'</td>
                    <td>'.$key['genre'].'</td>
                    <td>'.$key['naissance'].'</td>
                    <td>'.$key['date_inscription'].'</td>
                    <td>'.$key['level'].'</td>
                    <td>'.$key['ip'].'</td>
                    <td><a href='.WEBROOT.'administration/delete_user/'.$key['id'].' class="ico del">Delete</a><a href='.WEBROOT.'blog/user/'.$_SESSION['user'].'/edit-user/'.$key['identifiant'].' class="ico edit">Edit</a></td>
                </tr>
                ';
                
            }
            
        }
            echo '
            </table>
            '.$pagination_precedent_users.' '.$pagination_suivant_users.'
        </div>
        ';
    }
    if(isset($edit_user_by_name))
    {
        echo 
        '
        <div id="div_table_article">
            <form method="POST" action='.WEBROOT.'/administration/update_user/'.$edit_user_by_name[0]['id'].'>
                <table id="table_article">
                    <tr>
                        <th>Identifiant</th>
                        <th>email</th>
                        <th>number</th>
                        <th>genre</th>
                        <th>date de naissance</th>
                        <th>date d\'inscription</th>
                        <th>level</th>
                        <th>ip</th>
                        <th class="ac">Content Control</th>
                    </tr>
                        ';

        foreach($edit_user_by_name as $key)
        {
            echo
            '
                    <tr>
                        <td><input type="text" name="identifiant" value='.$key['login'].'></td>
                        <td><input type="text" name="email" value='.$key['email'].'></td>
                        <td><input type="text" name="telephone" value='.$key['telephone'].'></td>
                        <td><input type="text" name="genre" value='.$key['genre'].'></td>
                        <td><input type="text" name="naissance" value='.$key['naissance'].'></td>
                        <td>'.$key['date_inscription'].'</td>
                        <td><input type="text" name="level" value='.$key['level'].'></td>
                        <td>'.$key['ip'].'</td>
                        <td><input type="submit" value="update"></td>
                    </tr>
                ';
        }   
        echo '
                </table>
            </form>
        </div>';
    }

    if(isset($edit_article_by_id))
    {
        echo 
        '
        <div id="form_add">
            <form method="post" action='.WEBROOT.'administration/update_article/'.$edit_article_by_id[0]['id'].' enctype="multipart/form-data">
                <div class="form-group">
        ';
        foreach($edit_article_by_id as $key)
        echo '
                    <label for="name" class="text_align_center_label">Title</label>
                    <textarea class="form-control" id="input_title" name="titre">'.$key['title'].'</textarea>
                    <label for="name" class="text_align_center_label">Contenu</label>
                    <textarea class="form-control" rows="3" name="contenu">'.$key['content'].'</textarea>
                    <div id="englobe_input_select_file" class="clearfix">    
                        <div id="englobe_input_file">
                            <label for="inputfile">image</label>
                            <input type="file" id="inputfile" name="image">
                        </div>
                        <div>
                            <label for="genre_article">Genre : </label><br>
                            <select name="genre">
                                <option value="shojo">shojo</option>
                                <option value="shonen">shonen</option>
                                <option value="seinen">seinen</option>
                                <option value="seijin">seijin</option>
                                <option value="komodo">komodo</option>
                            </select>
                        </div>
                    </div>
        ';
        echo 
        '
        </div>
                <input type="submit" class="btn btn-default" name="new_article" id="input_submit_article">
            </form>
        </div> 
        ';
    }

    if(isset($tags))
    {
        echo 
        '
        <h2>Add New Tag</h2>

        <div id="form_add">
            <form method="post" action='.WEBROOT.'administration/add_tags enctype="multipart/form-data">
                <div class="form-group">
                    <input type="text" class="form-control" id="input_title" name="new_tags">
                </div>
                <input type="submit" class="btn btn-default" name="insert_tags" id="input_submit_article">
            </form>
        </div>

        <div id="div_table_article">
            
                <table id="table_article">
                    <tr>
                        <th>Tag</th>
                        <th>Added by</th>
                        <th class="ac">Content Control</th>
                    </tr>
                        ';

        foreach($tags as $key)
        {
            echo
            '
                    <tr>
                        <td>'.$key['tags'].'</td>
                        <td>'.$key['user'].'</td>
                        <td><a href='.WEBROOT.'administration/delete_tags/'.$key['id'].' class="ico del">Delete</a><a href='.WEBROOT.'blog/user/'.$_SESSION['user'].'/edit-tags/'.$key['id'].' class="ico edit">Edit</a></td>
                    </tr>
            ';
        }   
        echo '
                </table>
            
        </div>';
    }
    else if (isset($tags_edit)) 
    {
        echo 
        '
        <div id="div_table_article">
            <form method="POST" action='.WEBROOT.'administration/update_tags/'.$tags_edit[0]['id'].'>
                <table id="table_article">
                    <tr>
                        <th>Tag</th>
                        <th>Added by</th>
                        <th class="ac">Content Control</th>
                    </tr>
                        ';

        foreach($tags_edit as $key)
        {
            echo
            '
                    <tr>
                        <td><input type=text value='.$key['tags'].' name="tag"></td>
                        <td>'.$key['user'].'</td>
                        <td><input type="submit" value="submit" name="update_tags"></td>
                    </tr>
            ';
        }   
        echo '
                </table>
            </form>
        </div>';
    }

    else if(isset($mail))
    {
        echo 
        '
        <div id="div_table_article">
                <table id="table_article">
                    <tr>
                        <th>nom</th>
                        <th>prenom</th>
                        <th>email</th>
                        <th>sujet</th>
                        <th>date</th>
                        <th>ip</th>
                        <th class="ac">Content Control</th>
                    </tr>
                        ';

        foreach($mail as $key)
        {
            echo
            '
                    <tr>
                        <td>'.$key['nom'].'</td>
                        <td>'.$key['prenom'].'</td>
                        <td>'.$key['email'].'</td>
                        <td>'.$key['sujet'].'</td>
                        <td>'.$key['date_contact'].'</td>
                        <td>'.$key['ip'].'</td>
                        <td><a href='.WEBROOT.'blog/user/'.$_SESSION['user'].'/mail/'.$key['id'].' class="ico edit">View</a> <a href='.WEBROOT.'administration/delete_mail/'.$key['id'].' class="ico del">Delete</a></td>
                    </tr>
                ';
        }   
        echo '
            </table>
        </div>';
    }

    else if(isset($mail_by_id))
    {
        foreach($mail_by_id as $key)
        {
            echo
            '
                <section>
                    <h4>Mail de : '.$key['nom'].' '.$key['prenom'].'<h4>
                    <p>'.$key['message'].'</p>
                </section>
            ';
        }
    }
?>
    
                   
<div id="englobe_header_nav">
    <div id="contain">
        <header id="header_full">
            <h1>#My_WebBlog</h1>
        </header>

        <nav id="nav_header">
            <ul>
                <?php 
                    echo 
                    '
                        <li><a href='.WEBROOT.'blog/index/1>Home</a></li>
                        <li><button data-toggle="modal" data-target=".bs-example-modal-lg2">Contact</button></li>
                    ';
                    if(empty($_SESSION['user']))
                    {
                        echo '<li><button data-toggle="modal" data-target=".bs-example-modal-lg3">Inscription</button></li>';
                    }
                    if(isset($_SESSION['level']))
                    {
                        if($_SESSION['level'] == 'admin_view')
                        {
                        echo 
                            '
                                <li><a href='.WEBROOT.'administration/view_panel_site>Panel admin</a></li>
                            ';
                        }
                    }
                    if(isset($_SESSION['user']))
                    {
                        echo 
                        '
                            <li><a href='.WEBROOT.'blog/user/'.$_SESSION['user'].'>Mon compte</a></li>
                            <li><a href='.WEBROOT.'users/logout>deconnexion</a></li>
                        ';
                    }
                    else
                    {
                        echo '<li><button data-toggle="modal" data-target=".bs-example-modal-lg">Connexion</button></li>';
                    }
                ?>
            </ul>
        </nav>
    </div>

</div>

<div class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <form class="form-horizontal" <?php echo 'action='.WEBROOT.'users/connexion method="POST"';?> id="formulaire">
                <div class="form-group">
                    <label for="username" class="col-sm-2 control-label">Username</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="username" name="identifiant" placeholder="Username">
                    </div>
                </div>
                
                <div class="form-group">
                    <label for="Password" class="col-sm-2 control-label">Password</label>
                    <div class="col-sm-10">
                        <input type="password" class="form-control" id="Password" name="password" placeholder="Password">
                    </div>
                </div>
                
                <div class="form-group">
                    <div class="col-sm-offset-2 col-sm-10">
                        <div class="checkbox">
                            <label>
                                <input type="checkbox"> Remember me
                            </label>
                        </div>
                    </div>
                </div>
                
                <div class="form-group">
                    <div class="col-sm-offset-2 col-sm-10">
                        <input type="submit" class="btn btn-default" name="verif_user" value="Sign in">
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

<div class="modal fade bs-example-modal-lg2" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabe" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="container">
            <div class="row" id="back">
                <h3 class="text-center">Formulaire de contact</h3>
                <div class="col-sm-8">
                    <form action=<?php echo WEBROOT.'application/add_contact';?> method="POST">
                        <div class="row form-group">
                            <div class="col-xs-3">
                                <label for="nom">Nom :</label>
                                <input id="nom" class="form-control" name="nom" type="text">
                            </div>
                            <div class="col-xs-3">
                                <label for="prenom">Prenom :</label>
                                <input id="prenom" class="form-control" name="prenom" type="text">
                            </div>
                        </div>
                        <div class="row form-group">
                            <div class="col-xs-5">
                                <label for="email">Email :</label>
                                <input class="form-control" id="email" name="email" type="email">
                            </div>
                        </div>
                        <div class="row form-group">
                            <div class="col-xs-10">
                                <label for="sujet">Sujet :</label>
                                <input class="form-control" id="sujet" name="sujet" type="text">
                                <label for="email">Message :</label>
                                <textarea class="form-control" id="message" name="message" rows="5">Votre message</textarea>
                            </div>
                        </div>
                        <div class="row form-group">
                            <div class="col-xs-10">
                                <button class="btn btn-default pull-right" name="new_contact">Envoyer</button>
                            </div>
                        </div>
                    </form>
                </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade bs-example-modal-lg3" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabe" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="container">
            <div class="row" id="back">
                <div class="col-sm-8">
                    
                        <div class="row form-group">
                            <div class="topi">
                                <div id="bloc_inscription">    
            <form role="form" method="POST" action="<?php echo WEBROOT.'application/inscription'; ?>">
                <div class="form-group">
                    <label for="identifiant">Mon identifiant :</label>
                    <input type="text" class="form-control" id="identifiant" name="identifiant">
                </div>
                <div class="form-group">
                    <label for="password">Mon mot de passe :</label>
                    <input type="password" class="form-control" id="password" name="password">
                </div>
                <div class="form-group">
                    <label for="password_confirm">Confirmation du mot de passe :</label>
                    <input type="password" class="form-control" id="password_confirm">
                </div>
                <div class="form-group">
                    <label for="e-mail">Mon adresse e-mail :</label>
                    <input type="email" class="form-control" id="e-mail" name="email">
                </div>
                <div class="form-group">
                    <label for="phone">Telephone :</label>
                    <input type="text" class="form-control" id="phone" name="telephone">
                </div>
                <div class="form-group">
                    <label for="birthday">Votre anniversaire :</label>
                    <select id="birthday" name="jour">
                        <option value="0">-jour-</option>
                        <option value="1">1</option>
                        <option value="2">2</option>
                        <option value="3">3</option>
                        <option value="4">4</option>
                        <option value="5">5</option>
                        <option value="6">6</option>
                        <option value="7">7</option>
                        <option value="8">8</option>
                        <option value="9">9</option>
                        <option value="10">10</option>
                        <option value="11">11</option>
                        <option value="12">12</option>
                        <option value="13">13</option>
                        <option value="14">14</option>
                        <option value="15">15</option>
                        <option value="16">16</option>
                        <option value="17">17</option>
                        <option value="18">18</option>
                        <option value="19">19</option>
                        <option value="20">20</option>
                        <option value="21">21</option>
                        <option value="22">22</option>
                        <option value="23">23</option>
                        <option value="24">24</option>
                        <option value="25">25</option>
                        <option value="26">26</option>
                        <option value="27">27</option>
                        <option value="28">28</option>
                        <option value="29">29</option>
                        <option value="30">30</option>
                        <option value="31">31</option>
                    </select>
                    <select id="birthday" name="mois">
                        <option value="0">-mois-</option>
                        <option value="1">janvier</option>
                        <option value="2">février</option>
                        <option value="3">mars</option>
                        <option value="4">avril</option>
                        <option value="5">mai</option>
                        <option value="6">juin</option>
                        <option value="7">juillet</option>
                        <option value="8">août</option>
                        <option value="9">septembre</option>
                        <option value="10">octobre</option>
                        <option value="11">novembre</option>
                        <option value="12">décembre</option>
                    </select>
                    <select id="birthday" name="annee">
                        <option value="0">-année-</option>
                        <option value="2007">2007</option>
                        <option value="2006">2006</option>
                        <option value="2005">2005</option>
                        <option value="2004">2004</option>
                        <option value="2003">2003</option>
                        <option value="2002">2002</option>
                        <option value="2001">2001</option>
                        <option value="2000">2000</option>
                        <option value="1999">1999</option>
                        <option value="1998">1998</option>
                        <option value="1997">1997</option>
                        <option value="1996">1996</option>
                        <option value="1995">1995</option>
                        <option value="1994">1994</option>
                        <option value="1993">1993</option>
                        <option value="1992">1992</option>
                        <option value="1991">1991</option>
                        <option value="1990">1990</option>
                        <option value="1989">1989</option>
                        <option value="1988">1988</option>
                        <option value="1987">1987</option>
                        <option value="1986">1986</option>
                        <option value="1985">1985</option>
                        <option value="1984">1984</option>
                        <option value="1983">1983</option>
                        <option value="1982">1982</option>
                        <option value="1981">1981</option>
                        <option value="1980">1980</option>
                        <option value="1979">1979</option>
                        <option value="1978">1978</option>
                        <option value="1977">1977</option>
                        <option value="1976">1976</option>
                        <option value="1975">1975</option>
                        <option value="1974">1974</option>
                        <option value="1973">1973</option>
                        <option value="1972">1972</option>
                        <option value="1971">1971</option>
                        <option value="1970">1970</option>
                        <option value="1969">1969</option>
                        <option value="1968">1968</option>
                        <option value="1967">1967</option>
                        <option value="1966">1966</option>
                        <option value="1965">1965</option>
                        <option value="1964">1964</option>
                        <option value="1963">1963</option>
                        <option value="1962">1962</option>
                        <option value="1961">1961</option>
                        <option value="1960">1960</option>
                        <option value="1959">1959</option>
                        <option value="1958">1958</option>
                        <option value="1957">1957</option>
                        <option value="1956">1956</option>
                        <option value="1955">1955</option>
                        <option value="1954">1954</option>
                        <option value="1953">1953</option>
                        <option value="1952">1952</option>
                        <option value="1951">1951</option>
                        <option value="1950">1950</option>
                        <option value="1949">1949</option>
                        <option value="1948">1948</option>
                        <option value="1947">1947</option>
                        <option value="1946">1946</option>
                        <option value="1945">1945</option>
                        <option value="1944">1944</option>
                        <option value="1943">1943</option>
                        <option value="1942">1942</option>
                        <option value="1941">1941</option>
                        <option value="1940">1940</option>
                        <option value="1939">1939</option>
                        <option value="1938">1938</option>
                        <option value="1937">1937</option>
                        <option value="1936">1936</option>
                        <option value="1935">1935</option>
                        <option value="1934">1934</option>
                        <option value="1933">1933</option>
                        <option value="1932">1932</option>
                        <option value="1931">1931</option>
                        <option value="1930">1930</option>
                        <option value="1929">1929</option>
                        <option value="1928">1928</option>
                        <option value="1927">1927</option>
                        <option value="1926">1926</option>
                        <option value="1925">1925</option>
                        <option value="1924">1924</option>
                        <option value="1923">1923</option>
                        <option value="1922">1922</option>
                        <option value="1921">1921</option>
                        <option value="1920">1920</option>
                        <option value="1919">1919</option>
                        <option value="1918">1918</option>
                        <option value="1917">1917</option>
                        <option value="1916">1916</option>
                        <option value="1915">1915</option>
                        <option value="1914">1914</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="genre">Genre :</label>
                    <label>Homme </label><input type="radio" name="genre" id="genre" value="Homme">
                    <label>Femme </label><input type="radio" name="genre" id="genre" value="Femme">
                </div>
                <input type="submit" class="btn btn-default" value="submit" name="submit_new_user">
            </form>
        </div>
                            </div>
                        <div class="row form-group">
                            <div class="col-xs-10">
                               
                            </div>
                        </div>
                    
                </div>
                </div>
            </div>
        </div>
    </div>
</div>
   <header>
       <div class="logo">
           <h1 class="logo-txt"><i class="fas fa-book-reader"></i>The Blog</h1>
       </div>
       <i class="fa fa-bars menu-switch" onclick="toggleMenu('.nav')"></i>
       <ul class="nav">
           <li><a href="accueil.php">Accueil</a></li>
           <li><a href="..\htmlfiles\apropos.html">A Propos</a></li>
           <!--        <li><a href="#">S'inscrire</a></li>-->
           <!--        <li><a href="#">Se Connecter</a></li>-->
           <li>
               <a href="#" onclick="toggleMenu('.nav ul')">
                   <i class="fa fa-user"></i>
                   <?php
                   //session_start();
                   if(isset($_SESSION['pseudo'])){
                       echo $_SESSION['pseudo'];
                       echo"
                           <ul>
                            <li><a href='#'>Tableau de Bord</a></li>
                            <li><a href='deconnexion.php' class='Deconnexion'>Se Déconnecter</a></li>
                           </ul>";
                   }
                    else{
                        echo "Utilisateur";
                        echo"
                           <ul>
                            <li><a href='login.php' class='connexion'>Se Connecter</a></li>
                           </ul>";
                    }
                   ?>
                   <i class="fa fa-chevron-down"></i>
               </a>
           </li>
       </ul>
   </header>

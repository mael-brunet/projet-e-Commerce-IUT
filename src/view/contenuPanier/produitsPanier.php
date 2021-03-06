<main>
    <?php
    if(Session::userIsAdmin()) {
        $nom = $_GET['nom'];
        echo '<h1>Panier de ' . htmlspecialchars($nom) . '</h1>';
    }
    else {
        echo '<h1>Votre panier</h1>';
    }
        $prixTotal = 0;
        if(Session::userIsAdmin() || isset($_GET['idPanier']) ) {
            foreach ($tabProduitsPanier as $p) {
                echo '

                    <div class ="produitsPanier">
                        <a href="#"><img src="'.htmlspecialchars($p['produit']->get('urlImage1')).'"></a>
                        <a href="#"><p class="nomProduit">'. htmlspecialchars($p['produit']->get('intitule')).'</p></a>
                        
                        <p class="controls"> Quantite :'. ' ' . htmlspecialchars($p['contenuPanier']->get('quantite')).'</p>
                        
                        <p class="prix"> Prix total : '. htmlspecialchars(($p['produit']->get('prix'))*$p['contenuPanier']->get('quantite')).'€</p>
                    </div>
                    <span class "separateur"></span>';

                $prixTotal += $p['produit']->get('prix')*$p['contenuPanier']->get('quantite');
            }
        }
        else if(Session::userIsCreate()){
            foreach ($tabProduitsPanier as $p) {
                echo '
                    <div class ="produitsPanier">
                        <a href="#"><img src="'.htmlspecialchars($p['produit']->get('urlImage1')).'"></a>
                        <a href="#"><p class="nomProduit">'. htmlspecialchars($p['produit']->get('intitule')).'</p></a>
                        
                        <p class="controls"> Quantite :<a href="?controller=contenuPanier&action=ajouter&idProduit='.htmlspecialchars($p['contenuPanier']->get('idProduit')).'" class="ajouter">+</a>  '. htmlspecialchars($p['contenuPanier']->get('quantite')).'  
                        <a href="?controller=contenuPanier&action=supprimer&idProduit='.htmlspecialchars($p['contenuPanier']->get('idProduit')).'" class="supprimer">-</a></p>
                        
                        <p class="prix"> Prix total : '. htmlspecialchars(($p['produit']->get('prix'))*$p['contenuPanier']->get('quantite')).'€</p>
                    </div>
                    <span class "separateur"></span>';

                $prixTotal += $p['produit']->get('prix')*$p['contenuPanier']->get('quantite');
            }
        }
        else{
            foreach ($tabProduitsPanier as $p) {
                echo '
                    <div class ="produitsPanier">
                        <a href="#"><img src="'.htmlspecialchars(unserialize($p["produit"])->get('urlImage1')).'"></a>
                        <a href="#"><p class="nomProduit">'. htmlspecialchars(unserialize($p["produit"])->get('intitule')).'</p></a>
                        
                        <p class="controls"> Quantite :<a href="?controller=contenuPanier&action=ajouter&idProduit='.htmlspecialchars(unserialize($p["produit"])->get('idproduit')).'" class="ajouter">+</a>  '. htmlspecialchars($p['quantite']).'  
                        <a href="?controller=contenuPanier&action=supprimer&idProduit='.htmlspecialchars(unserialize($p["produit"])->get('idproduit')).'" class="supprimer">-</a></p>
                        
                        <p class="prix"> Prix total : '. htmlspecialchars((unserialize($p["produit"])->get('prix'))*$p['quantite']).'€</p>
                    </div>
                    <span class "separateur"></span>';
                $prixTotal += unserialize($p["produit"])->get('prix')*$p['quantite'];
            }
        }

        if(count($tabProduitsPanier) == 0){
            echo "
                <div class='vide'>
                    <p>Vous n'avez pas de produit dans votre panier.</p>
                    <a href='?controller=Produit&action=readAll'>Retour à la boutique</a>
                </div>";
        }

    ?>

    <div class="total">
        <p>Livré par : Mondial Reley</p>
        <p>Frais de livraison : 4.99€</p>
        <p>Total : <?php echo htmlspecialchars($prixTotal) ;?>€</p>
        <?php
            if(Session::userIsCreate()){
                if(!Session::userIsAdmin() && !isset($_GET['idPanier'])) {
                    if($prixTotal > 0){
                        ?>
                        <a href="?controller=contenuPanier&action=commander">VALIDER MON PANIER</a>
                        <?php
                    }
                }
            }
            else{?>
                <a href="?controller=utilisateur&action=connexion">SE CONNECTER</a>
            <?php }

        ?>
    </div>
</main>

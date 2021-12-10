<main>
    <h1>Votre panier</h1>
    <?php
        $prixTotal = 0;
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
    ?>

    <div class="total">
        <p>Livré par : Mondial Reley</p>
        <p>Frais de livraison : 4.99€</p>
        <p>Total : <?php echo $prixTotal ;?>€</p>
        <a href="?controller=contenuPanier&action=valider">VALIDER MON PANIER</a>
    </div>
</main>

<?php require __DIR__ . '/../includes/header.php'; ?>

<main id="cart-page">

    <section id="cart-container">

        <h1 id="cart-title">Mon Panier</h1>

        <?php if (empty($cart)): ?>

            <p id="cart-empty">
                Votre panier est vide.
            </p>

        <?php else: ?>

            <?php $total = 0; ?>

            <div id="cart-list">

                <?php foreach ($cart as $item): ?>

                    <?php
                        $subtotal = $item['prix_unitaire'] * $item['quantite'];
                        $total += $subtotal;
                    ?>

                    <div class="cart-item">

                        <div class="cart-info">
                            <h3><?= htmlspecialchars($item['titre']) ?></h3>
                        </div>

                        <div class="cart-price">
                            <?= number_format($subtotal, 2) ?> €</div>

                        <div class="cart-actions">

                            <form method="POST" action="index.php?page=remove-from-cart">
                                <input type="hidden" name="musique_id" value="<?= (int)$item['musique_id'] ?>">
                                <button type="submit" class="cart-delete-btn">🗑 Supprimer</button>
                            </form>

                        </div>

                    </div>

                <?php endforeach; ?>

            </div>

            <div id="cart-total">
                Total : <?= number_format($total, 2) ?> €
            </div>

            <!-- FORM CHECKOUT -->
<form id="checkout-form"
      method="POST"
      action="index.php?page=checkout"
      onsubmit="return confirmCheckout(event)">

    <button type="submit" class="cart-checkout-btn">
        💳 Passer la commande
    </button>

</form>

        <?php endif; ?>

    </section>

</main>

<div id="checkout-modal" class="checkout-modal hidden">

    <div class="checkout-box">

        <h2>Confirmer l’achat</h2>

        <p>Es-tu sûr de vouloir acheter ces musiques ?</p>

        <div class="checkout-actions">

            <button type="button"
                    class="btn-cancel"
                    onclick="closeCheckoutModal()">
                Annuler
            </button>

            <button type="button"
                    class="btn-confirm"
                    onclick="submitCheckout()">
                Confirmer
            </button>

        </div>

    </div>

</div>

<script src="./assets/javascript/index.js"></script>
<script src="./assets/javascript/Catalog.js"></script>

<?php require __DIR__ . '/../includes/footer.php'; ?>
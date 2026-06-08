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
                            <h3>
                                <?= htmlspecialchars($item['titre']) ?>
                            </h3>

                        </div>

                        <div class="cart-price">
                            <?= number_format($subtotal, 2) ?> €
                        </div>

                        <div class="cart-actions">

                            <form method="POST" action="index.php?page=remove-from-cart">
                                <input type="hidden" name="musique_id" value="<?= (int)$item['musique_id'] ?>">
                                <button type="submit" class="cart-delete-btn">
                                    &#128465; Supprimer
                                </button>
                            </form>

                        </div>

                    </div>

                <?php endforeach; ?>

            </div>

            <div id="cart-total">
                Total : <?= number_format($total, 2) ?> €
            </div>

            <form method="POST" action="index.php?page=checkout">
                <button type="submit" class="cart-checkout-btn">
                    Passer la commande
                </button>
            </form>

        <?php endif; ?>

    </section>

</main>

<?php require __DIR__ . '/../includes/footer.php'; ?>
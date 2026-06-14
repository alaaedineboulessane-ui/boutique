function addToCart(musiqueId)
{
    fetch('index.php?page=add-to-cart', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json'
        },
        body: JSON.stringify({
            musique_id: musiqueId
        })
    })
    .then(response => response.text())
    .then(data => {
        console.log(data);
        alert(data);
    })
    .catch(error => {
        console.error(error);
    });
}

function confirmCheckout(event)
{
    const confirmed = confirm("Confirmer l'achat de ce panier ?");

    if (!confirmed) {
        event.preventDefault();
        return false;
    }

    return true;
}


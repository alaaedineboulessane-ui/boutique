function playSound(id) {
    const audio = document.getElementById(id);
    if (!audio) return;

    document.querySelectorAll("audio").forEach(a => {
        if (a.id !== id) {
            a.pause();
            a.currentTime = 0;
        }
    });

    if (audio.paused) {
        audio.play().catch(err => {
            console.log("Lecture bloquée :", err);
        });
    } else {
        audio.pause();
    }
}

    if (audio.paused) {
        audio.play();
    } else {
        audio.pause();
    }


function addToCart(title, price) {
    alert(title + " ajouté au panier (" + price + "€)");
}

function showInfo(title, artist) {
    alert("Titre : " + title + "\nArtiste : " + artist);
}

function addToCart(title, price) {

    fetch('index.php?page=add-to-cart', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json'
        },
        body: JSON.stringify({
            title: title,
            price: price
        })
    })
    .then(response => response.json())
    .then(data => {
        alert(data.message);
    })
    .catch(error => console.error('Erreur:', error));
}
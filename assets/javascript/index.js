



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
        audio.play().catch(err => console.log(err));
    } else {
        audio.pause();
    }
}


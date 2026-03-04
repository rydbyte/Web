window.addEventListener("load", function () {
    document.querySelector('#fbutton').addEventListener('click', async function () {
        let query = document.querySelector('#fsearch').value

        const urlParams = new URLSearchParams(window.location.search);

        urlParams.set('query', query);

        window.location.search = urlParams;
        //window.location.reload()
    });
});


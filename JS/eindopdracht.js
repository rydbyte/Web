window.addEventListener("load", function () {

    if (!localStorage.getItem("selected")) {
        localStorage.setItem("selected", 'Api');
    }

    if (localStorage.getItem("selected") === "DataBase"){
        document.querySelector('#fsearch').placeholder = "Search for a Pokemon..."
    }

    document.querySelector('#current').textContent = `Current: ${localStorage.getItem("selected")}`;

    document.querySelector('#fbutton').addEventListener('click', async function () {
        event.preventDefault()

        let query = document.querySelector('#fsearch').value
        let type = localStorage.getItem("selected")

        const urlParams = new URLSearchParams(window.location.search);

        urlParams.set('query', query);
        urlParams.set('type', type);

        window.location.search = urlParams;
        //window.location.reload()
    });

    document.querySelector('#btnApi').addEventListener('click', async function() {
        localStorage.setItem("selected", "Api");
        document.querySelector('#current').textContent = `Current: ${localStorage.getItem("selected")}`;
        document.querySelector('#fsearch').placeholder = "Search for a Country..."
        let content = (getComputedStyle(document.querySelector('form'), ':before').getPropertyValue('content'));
        content.replaceAll("Pokemon Search", "Country Search")
    });
    document.querySelector('#btnDataBase').addEventListener('click', async function() {
        localStorage.setItem("selected", "DataBase");
        document.querySelector('#current').textContent = `Current: ${localStorage.getItem("selected")}`;
        document.querySelector('#fsearch').placeholder = "Search for a Pokemon..."
        let content = (getComputedStyle(document.querySelector('form'), ':before').content);
        content.replaceAll("Country Search", "Pokemon Search")
    });
});


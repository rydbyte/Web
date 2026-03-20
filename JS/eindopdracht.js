window.addEventListener("load", function () {

    const errorBox = document.querySelector('#error');
    const loadingbox = document.querySelector('#loading');

    const countryBox = document.querySelector('#country-result');
    const countryname = document.querySelector('#country-name');
    const region = document.querySelector('#region');
    const subregion = document.querySelector('#sub');
    const capital = document.querySelector('#capital');
    const population = document.querySelector('#population');
    const languages = document.querySelector('#languages');
    const countrycurrency = document.querySelector('#currency');
    const timezone = document.querySelector('#timezone');
    const flag = document.querySelector('#flag');

    const pokeBox = document.querySelector('#pokemon-result');
    const id = document.querySelector('#id');
    const name = document.querySelector('#name');
    const type = document.querySelector('#type');
    const height = document.querySelector('#height');
    const weight = document.querySelector('#weight');
    const img = document.querySelector('#img');

    if (!localStorage.getItem("selected")) {
        localStorage.setItem("selected", "Api");
        document.querySelector('#btnApi').style.background = '#4b5563';
        document.querySelector('#btnDataBase').style.background = '#020617'
        document.title = "Country Search";
    }

    if (localStorage.getItem("selected") === "DataBase") {
        document.querySelector('#fsearch').placeholder = "Search for a Pokémon...";
        document.querySelector('#btnDataBase').style.background = '#4b5563';
        document.querySelector('#btnApi').style.background = '#020617'
        document.title = "Pokemon Search";
    }

    if (localStorage.getItem("selected") === "Api"){
        document.querySelector('#fsearch').placeholder = "Search for a Country...";
        document.querySelector('#btnApi').style.background = '#4b5563';
        document.querySelector('#btnDataBase').style.background = '#020617'
        document.title = "Country Search";
    }

    document.getElementById("fsearch").addEventListener("keydown", function(e) {
        if (e.key === "Enter") {
            e.preventDefault();
            document.getElementById("fbutton").click();
        }
    });

    document.querySelector('#fbutton').addEventListener('click', async function (event) {
        event.preventDefault();

        const query = document.querySelector('#fsearch').value.trim();
        const mode = localStorage.getItem("selected");

        if (query === "") return;

        try {
            loadingbox.hidden = false;
            errorBox.hidden = true;
            countryBox.hidden = true;
            pokeBox.hidden = true;

            const response = await fetch(
                `http://localhost/JS/eindopdracht.php?query=${query}&type=${mode}`
            );

            try {
                const data = await response.json();

                if (data.error) {
                    alert(data.error);
                    return;
                }

                if (mode === "Api") {
                    console.log(data[0])
                    countryname.textContent = "Name: " + data[0].name.common ?? "Unknown";
                    region.textContent = "Region: " + data[0].region ?? "Unknown";
                    subregion.textContent = "Sub-Region: " + data[0].subregion ?? "Unknown";
                    capital.textContent = "Capital: " + data[0].capital ?? "Unknown";
                    population.textContent = "Population: " + data[0].population ?? "Unknown";
                    timezone.textContent = "Timezone: " + data[0].timezones[0] ?? "Unknown";

                    let langues = Object.values(data[0].languages).join(", ");
                    languages.textContent = "Languages: " + langues;

                    const currency = Object.values(data[0].currencies)[0];
                    countrycurrency.textContent = "Currency: " + currency.symbol + " ("+ currency.name + ")";
                    flag.src = data[0].flags.png ?? "";

                    loadingbox.hidden = true;
                    countryBox.hidden = false;
                }

                if (mode === "DataBase") {
                    console.log(data)
                    id.textContent = "Pokemon: " + data.id;
                    name.textContent = "Name: " + data.name;
                    type.textContent = "Type: " + data.type;
                    height.textContent = "Height: " + data.height /10 + "m";
                    weight.textContent = "Weight: " + data.weight /10 + "kg";
                    img.src = data.img;

                    loadingbox.hidden = true;
                    pokeBox.hidden = false;
                }
            }
            catch (err){
                loadingbox.hidden = true;
                errorBox.hidden = false;
            }
        } catch (err) {
            console.error("Fetch error:", err);
        }
    });

    document.querySelector('#btnApi').addEventListener('click', function () {
        localStorage.setItem("selected", "Api");
        document.querySelector('#btnApi').style.background = '#4b5563';
        document.querySelector('#btnDataBase').style.background = '#020617'
        document.querySelector('#fsearch').placeholder = "Search for a Country...";
        document.title = "Country Search";
    });

    document.querySelector('#btnDataBase').addEventListener('click', function () {
        localStorage.setItem("selected", "DataBase");
        document.querySelector('#btnDataBase').style.background = '#4b5563';
        document.querySelector('#btnApi').style.background = '#020617'
        document.querySelector('#fsearch').placeholder = "Search for a Pokémon...";
        document.title = "Pokemon Search";
    });
});

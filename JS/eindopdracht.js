window.addEventListener("load", function () {

    const errorBox = document.querySelector('#error');

    const countryBox = document.querySelector('#country-result');
    const c_name = document.querySelector('#country-name');
    const c_region = document.querySelector('#region');
    const c_sub = document.querySelector('#sub');
    const c_capital = document.querySelector('#capital');
    const c_population = document.querySelector('#population');
    const c_languages = document.querySelector('#languages');
    const c_currency = document.querySelector('#currency');
    const c_timezone = document.querySelector('#timezone');
    const c_flag = document.querySelector('#flag');

    const pokeBox = document.querySelector('#pokemon-result');
    const p_id = document.querySelector('#id');
    const p_name = document.querySelector('#name');
    const p_type = document.querySelector('#type');
    const p_height = document.querySelector('#height');
    const p_weight = document.querySelector('#weight');
    const p_img = document.querySelector('#img');

    if (!localStorage.getItem("selected")) {
        localStorage.setItem("selected", "Api");
        document.querySelector('#btnApi').style.background = '#4b5563';
        document.querySelector('#btnDataBase').style.background = '#020617'
    }

    if (localStorage.getItem("selected") === "DataBase") {
        document.querySelector('#fsearch').placeholder = "Search for a Pokémon...";
        document.querySelector('#btnDataBase').style.background = '#4b5563';
        document.querySelector('#btnApi').style.background = '#020617'
    }

    if (localStorage.getItem("selected") === "Api"){
        document.querySelector('#fsearch').placeholder = "Search for a Country...";
        document.querySelector('#btnApi').style.background = '#4b5563';
        document.querySelector('#btnDataBase').style.background = '#020617'
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
            const response = await fetch(
                `http://localhost/JS/eindopdracht.php?query=${query}&type=${mode}`
            );
            errorBox.hidden = true;
            countryBox.hidden = true;
            pokeBox.hidden = true;
            try {
                const data = await response.json();

                if (data.error) {
                    alert(data.error);
                    return;
                }

                if (mode === "Api") {
                    console.log(data[0])
                    c_name.textContent = "Name: " + data[0].name.common ?? "Unknown";
                    c_region.textContent = "Region: " + data[0].region ?? "Unknown";
                    c_sub.textContent = "Sub-Region: " + data[0].subregion ?? "Unknown";
                    c_capital.textContent = "Capital: " + data[0].capital ?? "Unknown";
                    c_population.textContent = "Population: " + data[0].population ?? "Unknown";
                    c_timezone.textContent = "Timezone: " + data[0].timezones[0] ?? "Unknown";

                    let langues = Object.values(data[0].languages).join(", ");
                    c_languages.textContent = "Languages: " + langues;

                    const currency = Object.values(data[0].currencies)[0];
                    c_currency.textContent = "Currency: " + currency.symbol + " ("+ currency.name + ")";
                    c_flag.src = data[0].flags.png ?? "";

                    countryBox.hidden = false;
                }

                if (mode === "DataBase") {
                    console.log(data)
                    p_id.textContent = "Id: " + data.id;
                    p_name.textContent = "Name: " + data.name;
                    p_type.textContent = "Type: " + data.type;
                    p_height.textContent = "Height: " + data.height + "cm";
                    p_weight.textContent = "Weight: " + data.weight + "g";
                    p_img.src = data.img;

                    pokeBox.hidden = false;
                }
            }
            catch (err){
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
    });

    document.querySelector('#btnDataBase').addEventListener('click', function () {
        localStorage.setItem("selected", "DataBase");
        document.querySelector('#btnDataBase').style.background = '#4b5563';
        document.querySelector('#btnApi').style.background = '#020617'
        document.querySelector('#fsearch').placeholder = "Search for a Pokémon...";
    });
});

let pc = {
    "color": "black ",
    "cpu": "amd ",
    "gpu": "rtx "
}

const headers = new Headers({
    "Content-Type": "application/json",
    "x-api-key": "live_eEhHHZcMeM8daSSoZGwsjTz5T932kdgLiValkNsALlwdL475xuTLjlSpTzormKTR"
});

let requestOptions = {
    method: 'GET',
    headers: headers,
    redirect: 'follow'
};

window.addEventListener("load", function (){
    document.querySelector('#box1').style.backgroundColor = "green";
    document.querySelector('#box2').style.backgroundColor = "orange";
    document.querySelector('#box3').style.backgroundColor = "purple";
    document.querySelector('#box4').style.backgroundColor = "cyan";

    document.querySelector('#box1').addEventListener('click', function() {
        document.querySelector("#box2").innerText = "AAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAA"
        document.querySelector("#box2").style.backgroundColor = "red";
    });
    document.querySelector('#box2').addEventListener('click', function() {
        document.querySelector("#box1").innerText = "AAAAAAAAAAAAAAAA"
        document.querySelector("#box1").style.backgroundColor = "purple";
    });
    document.querySelector('#box3').addEventListener('click', function() {
        document.querySelector("#box3").innerText = pc.cpu + pc.color + pc.gpu
        document.querySelector("#box3").style.backgroundColor = "blue";
    });
    document.querySelector('#box4').addEventListener('click', async function () {

        let response = await fetch("https://api.thecatapi.com/v1/images/search", requestOptions);
        let data = await response.json();
        let img = document.createElement("img");
        console.log(response)
        img.src = data[0].url;
        let src = document.getElementById("box4");
        src.appendChild(img);
    });
});

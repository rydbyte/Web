
let laptop = {
    "Color": "black ",
    "GPU": "RTX 100 ",
    "Hz": 144,
}

window.addEventListener("load", function () {
    document.body.style.backgroundColor = "orange"
    document.querySelector('#box1').style.backgroundColor = "green";
    document.querySelector('#box2').style.backgroundColor = "orange";
    document.querySelector('#box1').style.backgroundColor = "pink";
    document.querySelector('#box2').style.backgroundColor = "purple";
    document.querySelector('#box1').addEventListener('click', function() {
        document.querySelector("#box2").style.backgroundColor = "red"
        document.querySelector('#box2').innerText = "Dit is nu de tekst in Box Twee."
    });

    document.querySelector('#box2').addEventListener('click', function() {
        document.querySelector("#box1").style.backgroundColor = "red"
        document.querySelector('#box1').innerHTML = "<h1>Groot</h1>"
    });

    document.querySelector('#box3').addEventListener('click', function() {
        document.querySelector("#box4").style.backgroundColor = "red"
        document.querySelector('#box4').innerHTML = laptop.Color + laptop.GPU + laptop.Hz.toString()
    });

});

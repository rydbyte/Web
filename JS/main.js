
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

});

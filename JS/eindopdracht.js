window.addEventListener("load", function () {
    document.querySelector('#fbutton').addEventListener('click', async function () {
        let query = document.querySelector('#fsearch').value

        const urlParams = new URLSearchParams(window.location.search);

        urlParams.set('query', query);

        window.location.search = urlParams;
        //window.location.reload()
    });

    function search_result_wikipedia(result) {
        return `
    <div class="card wiki"> 
      <h2>${result.title}</h2>
      <p>
        ${result.snippet}
      </p>
    </div>
  `;
    }
});


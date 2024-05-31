(function () {
  console.log("rest API");

  let lien__categorie = document.querySelectorAll(".lien__categorie");
  for (const elm of lien__categorie) {
    elm.addEventListener("click", function () {
      let categoryId = this.id.split("_")[1];
      fetchPosts(categoryId);
    });
  }

  function fetchPosts(categoryId) {
    let url =
      "https://gftnth00.mywhc.ca/tim23/wp-json/wp/v2/posts?categories=" +
      categoryId;

    // Effectuer la requête HTTP en utilisant fetch()
    fetch(url)
      .then(function (response) {
        // Vérifier si la réponse est OK (statut HTTP 200)
        if (!response.ok) {
          throw new Error(
            "La requête a échoué avec le statut " + response.status
          );
        }

        // Analyser la réponse JSON
        return response.json();
      })
      .then(function (data) {
        // La variable "data" contient la réponse JSON
        console.log(data);
        let restapi = document.querySelector(".contenu__restapi");
        restapi.innerHTML = "";
        // Maintenant, vous pouvez traiter les données comme vous le souhaitez
        // Par exemple, extraire les titres des articles comme dans l'exemple précédent
        data.forEach(function (article) {
          let titre = article.title.rendered;
          let contenu = article.content.rendered.substring(0, 200);
          console.log(titre);
          let carte = document.createElement("div");
          carte.classList.add("restapi__carte");

          carte.innerHTML = `
            <h2>${titre}</h2>
            <p>${contenu}</p>
            `;
          restapi.appendChild(carte);
          carte.style.marginTop = "30px";
        });
      })
      .catch(function (error) {
        // Gérer les erreurs
        console.error("Erreur lors de la récupération des données :", error);
      });
  }
})();

/**
 * @file Script contenant les fonctions de base
 * @author Jonathan Martel (jmartel@cmaisonneuve.qc.ca)
 * @version 0.1
 * @update 2019-01-21
 * @license Creative Commons BY-NC 3.0 (Licence Creative Commons Attribution - Pas d’utilisation commerciale 3.0 non transposé)
 * @license http://creativecommons.org/licenses/by-nc/3.0/deed.fr
 *
 */

//const BaseURL = "https://localhost/vino_etu/";
const BaseURL = document.baseURI;

//console.log(BaseURL);
window.addEventListener('load', function() {    
  //console.log("load");
  /**Soustraire quantité */
    document.querySelectorAll(".btnBoire").forEach(function(element){
        console.log(element);
        element.addEventListener("click", function(evt){
            let id = evt.target.parentElement.dataset.id;
            let requete = new Request(BaseURL+"index.php?requete=boireBouteilleCellier", {method: 'POST', body: '{"id": '+id+'}'});

            fetch(requete)
            .then(response => {
                if (response.status === 200) {
                  // Récharger la page pour voir les changements  
                  location.reload();                 
                  return response.json();
                } else {
                  throw new Error('Erreur');
                }
              })
              .then(response => {                
                console.debug(response);
              }).catch(error => {
                console.error(error);
              });
        })

    });    
    
    /*
    * Gerer l evenement lorsqu on clioque sur le boutton  'Ajouter': quantité plus
    */
    document.querySelectorAll(".btnAjouter").forEach(function(element){
        //console.log(element);
        element.addEventListener("click", function(evt){
            let id = evt.target.parentElement.dataset.id;
            let requete = new Request(BaseURL+"index.php?requete=ajouterBouteilleCellier", {method: 'POST', body: '{"id": '+id+'}'});

            fetch(requete)
            .then(response => {
                if (response.status === 200) {
                  // Récharger la page 
                  location.reload();                 
                  return response.json();
                } else {
                  throw new Error('Erreur');
                }
              })
              .then(response => {
                                
                console.debug(response);
              }).catch(error => {
                console.error(error);
              });
        })

    });
   
    let inputNomBouteille = document.querySelector("[name='nom_bouteille']");
    //console.log(inputNomBouteille);
    let liste = document.querySelector('.listeAutoComplete');

    if(inputNomBouteille){
      inputNomBouteille.addEventListener("keyup", function(evt){
        //console.log(evt);
        let nom = inputNomBouteille.value;
        liste.innerHTML = "";
        if(nom){
          let requete = new Request(BaseURL+"index.php?requete=autocompleteBouteille", {method: 'POST', body: '{"nom": "'+nom+'"}'});
          fetch(requete)
              .then(response => {
                  if (response.status === 200) {                    
                    return response.json();
                  } else {
                    throw new Error('Erreur');
                  }
                })
                .then(response => {
                  console.log(response);                  
                  response.forEach(function(element){
                    liste.innerHTML += "<li data-id='"+element.id +"'>"+element.nom+"</li>";
                  })
                }).catch(error => {
                  //console.error(error);
                });
        }
        
        
      });

      let bouteille = {
        nom : document.querySelector(".nom_bouteille"),
        millesime : document.querySelector("[name='millesime']"),
        id_cellier : document.getElementById("id_cellier"),//e.options[e.selectedIndex].value
        quantite : document.querySelector("[name='quantite']"),
        date_achat : document.querySelector("[name='date_achat']"),
        prix : document.querySelector("[name='prix']"),
        garde_jusqua : document.querySelector("[name='garde_jusqua']"),
        notes : document.querySelector("[name='notes']"),
      };
      
      /** Liste des noms*/
      liste.addEventListener("click", function(evt){
        console.dir(evt.target)
        if(evt.target.tagName == "LI"){
          bouteille.nom.dataset.id = evt.target.dataset.id;
          bouteille.nom.innerHTML = evt.target.innerHTML;          
          liste.innerHTML = "";
          inputNomBouteille.value = "";

        }
      });

      let btnAjouter = document.querySelector("[name='ajouterBouteilleCellier']");
      if(btnAjouter){
        btnAjouter.addEventListener("click", function(evt){
          var param = {
            "id_bouteille":bouteille.nom.dataset.id,
            "id_cellier": id_cellier[id_cellier.selectedIndex].value,// 1,//
            "date_achat":bouteille.date_achat.value,
            "garde_jusqua":bouteille.garde_jusqua.value,
            "notes":bouteille.notes.value,
            "prix":bouteille.prix.value,
            "quantite":bouteille.quantite.value,
            "millesime":bouteille.millesime.value,
          };
          console.log(param);
          let requete = new Request(BaseURL+"index.php?requete=ajouterNouvelleBouteilleCellier", {method: 'POST', body: JSON.stringify(param)});
          console.log(requete.body);
            fetch(requete)
              .then(response => {
                  if (response.status === 200) {
                    //console.log(response.body);
                    return response.json();
                  } else {
                    throw new Error('Erreur');
                  }
                })
                .then(response => {
                  console.log(response);
                
                }).catch(error => {
                  //console.error(error);
                });
        
        });
      }      
      
    }

    /*
      * Affichage de la vue de modification d'une bouteille  
      */
    let btnModifier = document.querySelectorAll(".btnModifier").forEach(function(e){
      //console.log(e);
      e.addEventListener('click', function(evt){
        let id = evt.target.parentElement.dataset.id;
        
        console.log(location.href);
        //let requete = new Request(BaseURL+`index.php?requete=modifier`);//, {method: 'GET'}?id=${id}`,
        location.href = BaseURL+`index.php?requete=getBouteille&id=${id}`;//
      })
    });

    /**
     * Modification d'une bouteille
     */
    document.querySelectorAll(".modifierBouteille").forEach(function(e) {
      console.log(e);
      e.addEventListener('click', function(evt){
        let id = document.querySelector("[name=id]").value;
        //console.log(id);
        let bouteille = {
          nom : document.querySelector(".nom_bouteille"),
          millesime : document.querySelector("[name='millesime']"),
          id_cellier : document.getElementById("id_cellier"),//e.options[e.selectedIndex].value
          quantite : document.querySelector("[name='quantite']"),
          date_achat : document.querySelector("[name='date_achat']"),
          prix : document.querySelector("[name='prix']"),
          garde_jusqua : document.querySelector("[name='garde_jusqua']"),
          notes : document.querySelector("[name='notes']"),
        };

        var param = {
          "id_bouteille":bouteille.nom.dataset.id, //document.querySelector(".nom_bouteille"),
          "id_cellier": id_cellier[id_cellier.selectedIndex].value,// 1,//
          "date_achat":bouteille.date_achat.value,
          "garde_jusqua":bouteille.garde_jusqua.value,
          "notes":bouteille.notes.value,
          "prix":bouteille.prix.value,
          "quantite":bouteille.quantite.value,
          "millesime":bouteille.millesime.value,
        };
        console.log(param);

        let requete = new Request(BaseURL+"index.php?requete=modifierBouteilleCellier", 
                                {method: 'POST', body: JSON.stringify(param)});

      fetch(requete)
      .then(response => {
        if (response.status === 200) {
          //console.log(response.body);
          return response.json();
        } else {
          throw new Error('Erreur');
        }
      })
      .then(response => {
        console.log(response);
      
      }).catch(error => {
        //console.error(error);
      });
        

      })
    })
        /* fetch(requete)
          .then(response => {
              if (response.status === 200) {
                console.log(response.url);
                return response;//.json()
              } else {
                throw new Error('Erreur');
              }
            })
            .then(response => {
              console.log(response);
            
            }).catch(error => {
              //console.error(error);
            });         */
    
    
    /**BaseURL+"index.php?requete=modifierBouteilleCellier", {method: 'POST', body: '{"id": '+id+'}'} */
});


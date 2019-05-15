import RiotAPIStatic from "./api/riotapistatic.js"

$( document ).ready(function() {
  RiotAPIStatic.getChampions()
    .then(response => {
      let data = response.data.data
      let champions = Object.values(data)

      console.log(champions)

      // All Champions
      let containerAll = $('#champion-container-all')
      champions.forEach(champion => {
        containerAll.append(`
          <div class="cell small-2" >
            <p>${champion.name}</p>
            <img src="http://ddragon.leagueoflegends.com/cdn/6.24.1/img/champion/${champion.image.full}" data-tooltip tabindex="1" title="${champion.title}: ${champion.blurb}" class="champion-description"/>
          </div>
        `)
      })

      // Champions by tag
      let tags = ["Fighter", "Tank", "Mage", "Assassin", "Support", "Marksman"]

      tags.forEach(tag => {
        let container = $(`#champion-container-${tag}`)

        champions.filter(champion => {
          return champion.tags.includes(tag)
        })
          .forEach(champion => {
            container.append(`
              <div class="cell small-2">
                <p>${champion.name}</p>
                <img src="http://ddragon.leagueoflegends.com/cdn/6.24.1/img/champion/${champion.image.full}" data-tooltip tabindex="1" title="${champion.title}: ${champion.blurb}" class="champion-description"/>
              </div>
            `)
          })
      })
      $(".champion-description").each(function(i,e){
        new Foundation.Tooltip($(e), {
          allowHtml: true
        });
      });
    })
});

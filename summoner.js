import RiotAPIDynamic from "./api/riotapidynamic.js"
import RiotAPIStatic from './api/riotapistatic.js'

$( document ).ready(function() {
  RiotAPIDynamic.getChampionMastery(window.summonerName)
    .then(masteryResponse => {
      let masteryData = masteryResponse.data;

      RiotAPIStatic.getChampions()
        .then(championResponse => {
          let championData = Object.values(championResponse.data.data)

          // Loop through all champion masteries
          let data = masteryData.map(champion => {
            let output = champion;
            // Find the matching champion data
            let match = championData.filter(championSub => championSub.key === `${champion.championId}`)

            // Create an item called 'data' at the matched entry
            if (match) {
              output['data'] = match[0]
            }

            // Return our updated entry
            return output;
          })

          console.log(data)

          // All Champions
          let container = $('#champion-mastery-container')
          data.forEach(champion => {
            // Check to see that the data was updated
            if (champion.data) {
              container.append(`
                <div class="cell small-6">
                  <div class="grid-x grid-margin-x">
                    <div class="cell small-3" >
                      <img src="http://ddragon.leagueoflegends.com/cdn/6.24.1/img/champion/${champion.data.image.full}"/>
                    </div>
                    <div class="cell shrink">
                      <p>${champion.data.name}</p>
                    </div>
                    <div class="cell auto">
                      <p>Level: ${champion.championLevel}</p>
                      <p>Points: ${champion.championPoints}</p>
                    </div>
                  </div>
                <div>
              `)
            }
        })
      })
    })
  });

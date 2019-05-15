import RiotAPIStatic from "./api/riotapistatic.js"
import RiotAPIDynamic from "./api/riotapidynamic.js"

$( document ).ready(function() {
    $( "#usernameform" ).submit(function( event ) {
      event.preventDefault();

      var username = $('#usernameform input').val()

      if (!username) return
      console.log(RiotAPIDynamic.updateSummoner(username))
      window.location.href = 'http://localhost:8080/finalproject/summoner.php?summonerName=' + username
    });
});

$( document ).ready(function() {
  $( "#champion" ).click(function( event ) {
    event.preventDefault();

    var champion = $('#champion p').val()

    if (!champion) return
    console.log(RiotAPIStatic.getChampions(champion))
  })
});

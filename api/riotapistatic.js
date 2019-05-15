const instance = axios.create({
  baseURL: 'http://ddragon.leagueoflegends.com/cdn/6.24.1/data/en_US/',
  timeout: 1000,
});

export default{
  getChampions(){
      return instance.get('champion.json')
  }
}

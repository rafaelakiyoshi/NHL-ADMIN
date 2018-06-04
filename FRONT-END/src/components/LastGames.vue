<template>
  <div id="lastgames">
    <div class="list-group">
      <h3>Last Games</h3>
      <button v-for="(game) in games" v-bind:key="game.id" type="button" class="list-group-item list-group-item-action">
      <div class="row">
        <div class="col left">
         <img class="inline" v-bind:src="teams[game.id_team1-1].logo" width="50" height="50"/>
         <h6 class="inline">{{teams[game.id_team1-1].name}}</h6>
        </div>
        <div class="col center">
          <br>
       <h5 class="inline">{{ game.score_team1 }}</h5> VS <h5 class="inline">{{ game.score_team2 }}</h5>
        </div>
        <div class="col right">
          <h6 class="inline">{{teams[game.id_team2-1].name}}</h6>
          <img class="inline" v-bind:src="teams[game.id_team2-1].logo" width="50" height="50"/>
        </div>
      </div>
      </button>
    </div>
  </div>
</template>
<script>
export default {
  name: 'lastgames',
  data () {
    return {
      games: [],
      teams: []
    }
  },
  mounted () {
    // Checking if the data already are in VueX or if there's any update to do.
    if ((this.$store.getters.getTeams.length === 0 || this.$store.getters.getGames.length === 0)) {
      console.log('Catching the Data')
      this.$http.get('http://nhl.admin/api/teams').then(response => {
      // get body data
        this.$store.commit('setTeams', response.body)
        this.teams = response.body
      }, response => {
      // error callback
      })

      this.$http.get('http://nhl.admin/api/games').then(response => {
      // get body data
        this.$store.commit('setGames', response.body)
        this.games = response.body
      }, response => {
      // error callback
      })
    } else {
      console.log('The Data already are in VueX')
      // The Data already are in VueX
      this.games = this.$store.getters.getGames
      this.teams = this.$store.getters.getTeams
    }
  }
}
</script>
<style lang="scss" scoped>
.right {
  text-align: right;
}

.center {
  text-align: center;
}

.padding-right{
  padding-right: 10px;
}

.padding-left {
  padding-left: 10px;
}

.inline {
  display: inline;
  font-weight: bold;
}
</style>

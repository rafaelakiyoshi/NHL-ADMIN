<template>
  <div id="ranking">
    <div class="list-group">
      <h3>Ranking</h3>
      <button v-for="(team, index) in teams" v-bind:key="team.id" type="button" class="list-group-item list-group-item-action">
        <div class="row">
          <div class="col">
          <h4 class="inline">{{index+1}}º - </h4>
          <img v-bind:src="team.logo" width="50" height="50"/>
          <h6 class="inline">{{ team.name }}</h6>
          </div>
          <div class="col-md-auto center">
            Wins
            <br>
            {{ team.wins }}
          </div>
          <div class="col col-lg-2 center">
            Loses
            <br>
            {{ team.loses }}
          </div>
        </div>
      </button>
    </div>
  </div>
</template>
<script>
export default {
  name: 'ranking',
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
        this.teams.sort((a, b) => parseFloat(b.wins) - parseFloat(a.wins))
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
      this.games = this.$store.getters.getGames
      this.teams = this.$store.getters.getTeams
    }
  }
}
</script>
<style lang="scss" scoped>
.inline {
  display: inline;
  font-weight: bold;
}
.center{
  text-align: center;
}
</style>

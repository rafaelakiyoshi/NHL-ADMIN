<template>
  <div id="lastgames">
    <div class="list-group">
      <h3>{{ title }}</h3>
      <button v-for="(game) in gamesToShow" v-bind:key="game.id" type="button" class="list-group-item list-group-item-action">
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
           {{ game.id_team2 }}
          <h6 class="inline">{{teams[game.id_team2-1].name}}</h6>
          <img class="inline" v-bind:src="teams[game.id_team2-1].logo" width="50" height="50"/>
        </div>
      </div>
      </button>
      <b-pagination align="center" :total-rows="totalLength" v-model="currentPage" :per-page="perPage">
    </b-pagination>
    </div>
  </div>
</template>
<script>
export default {
  name: 'lastgames',
  props: ['specificGames'],
  data () {
    return {
      title: 'Last Games',
      gamesToShow: [],
      games: [],
      teams: [],
      currentPage: 0,
      perPage: 10,
      oldCurrentPage: 0,
      totalLength: 0
    }
  },
  watch: {
    currentPage: function(){
      let x = this.games
      let start
      let end
      if(this.currentPage == 1){
        start = this.currentPage
        end = this.currentPage * this.perPage
      } else if(this.currentPage > this.oldCurrentPage) {
        start = this.currentPage * this.perPage - (this.perPage -1)
        end = this.currentPage * this.perPage
      } else {
        start = this.currentPage * this.perPage
        end = this.currentPage * this.perPage - (this.perPage -1)
      }
      this.gamesToShow = x.slice(start-1, end)
    }
  },
  mounted () {
        // Checking if the data already are in VueX or if there's any update to do.
      if ((this.$store.getters.getTeams.length === 0 || this.$store.getters.getGames.length === 0)) {
        this.$http.get('http://nhl.admin/api/teams').then(response => {
        // get body data
          this.$store.commit('setTeams', response.body)
          this.teams = response.body
          this.teams.sort((a, b) => parseFloat(a.id) - parseFloat(b.id))
        }, response => {
        // error callback
        })

        this.$http.get('http://nhl.admin/api/games').then(response => {
        // get body data
          this.$store.commit('setGames', response.body)
          this.games = response.body
          this.totalLength = this.games.length
          let x = this.games
          this.gamesToShow = x.slice(0, 10)
        }, response => {
        // error callback
        })
      } else {
        // The Data already are in VueX
        this.games = this.$store.getters.getGames
        this.teams = this.$store.getters.getTeams
        this.totalLength = this.games.length
        let x = this.games
        this.gamesToShow = x.slice(0, 10)
      }
    if(this.specificGames){
        this.teams.sort((a, b) => parseFloat(a.id) - parseFloat(b.id))
        console.log(this.teams)
        console.log(this.specificGames, this.specificGames.length)
        this.games = this.specificGames
        let x = this.specificGames
        this.gamesToShow = x.slice(0, 5)
        this.totalLength = 10
        this.perPage = 5
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

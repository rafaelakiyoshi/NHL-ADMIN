<template>
  <div id="ranking">
    <div class="list-group">
      <h3>Ranking</h3>
      <button v-for="(team, index) in teamsToShow" v-bind:key="team.id" type="button" class="list-group-item list-group-item-action"  @click="routeForTeam(team)" >
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
    <b-pagination align="center" :total-rows="totalLength" v-model="currentPage" :per-page="perPage">
    </b-pagination>
  </div>
</template>
<script>
import teamdetail from '../views/TeamDetail.vue'
export default {
  name: 'ranking',
  components: {
    teamdetail
  },
  data () {
    return {
      games: [],
      teams: [],
      teamsSorted: [],
      teamsToShow: [],
      currentPage: 0,
      perPage: 10,
      oldCurrentPage: 0,
      totalLength: 0
    }
  },
  watch: {
    currentPage: function () {
      let x = this.teamsSorted
      let start
      let end
      if (this.currentPage === 1) {
        start = this.currentPage
        end = this.currentPage * this.perPage
      } else if (this.currentPage > this.oldCurrentPage) {
        start = this.currentPage * this.perPage - (this.perPage - 1)
        end = this.currentPage * this.perPage
      } else {
        start = this.currentPage * this.perPage
        end = this.currentPage * this.perPage - (this.perPage - 1)
      }
      this.teamsToShow = x.slice(start - 1, end)
    }
  },
  methods: {
    routeForTeam (team) {
      this.$store.commit('setTeamDetail', team)
      this.$router.push({
        name: 'Teamdetail',
        params: { team, games: this.games }
      })
    }
  },
  mounted () {
    // Checking if the data already are in VueX or if there's any update to do.
    if (
      this.$store.getters.getTeams.length === 0 ||
      this.$store.getters.getGames.length === 0
    ) {
      this.$http.get('http://nhl.admin/api/teams').then(
        response => {
          // get body data
          this.teams = response.body
          let sorted = this.teams
          this.teamsSorted = sorted.sort(
            (a, b) => parseFloat(b.wins) - parseFloat(a.wins)
          )
          this.totalLength = this.teams.length
          let x = this.teams
          this.teamsToShow = x.slice(0, 10)
        },
        response => {
          // error callback
        }
      )

      this.$http.get('http://nhl.admin/api/games').then(
        response => {
          // get body data
          this.games = response.body
        },
        response => {
          // error callback
        }
      )
    } else {
      this.games = this.$store.getters.getGames
      this.teams = this.$store.getters.getTeams
      let sorted = this.teams
      this.teamsSorted = sorted.sort(
        (a, b) => parseFloat(b.wins) - parseFloat(a.wins)
      )
      this.totalLength = this.teams.length
      let x = this.teams
      this.teamsToShow = x.slice(0, 10)
    }
  }
}
</script>
<style lang="scss" scoped>
.inline {
  display: inline;
  font-weight: bold;
}
.center {
  text-align: center;
}
</style>

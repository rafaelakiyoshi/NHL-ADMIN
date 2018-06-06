<template>
  <div id="teamdetail">
    <div class="space demo-3">
    <div class="card" bottom>
      <a><img :src="team.logo" width="150" height="150" class="logo" center/></a>
  <div class="card-body">
    <h2 class="inline">{{ team.name }}</h2>
    <h5 class="inline" > {{ team.division }} Division</h5>
  <div class="row inline">
    <div class="col-sm">
      <gamesplayed v-bind:team="team"></gamesplayed>
    </div>
    <div class="col-sm">
      <scores v-bind:team="team"></scores>
    </div>
    <div class="col-sm">
      <visualizations v-bind:team="team"></visualizations>
    </div>
  </div>
    <div class="card">
  <div class="card-body">
    <lastgames v-bind:specificGames="specificGames"></lastgames>
  </div>
</div>
  </div>
</div>
</div>
    </div>
</template>

<script>
import LastGames from '../components/LastGames.vue'
import GamesPlayed from '../components/GamesPlayed.vue'
import Visualizations from '../components/Visualizations.vue'
import Scores from '../components/Scores.vue'
export default {
  components: {
    lastgames: LastGames,
    gamesplayed: GamesPlayed,
    visualizations: Visualizations,
    scores: Scores
  },
  name: 'teamdetail',
  props: ['team', 'games'],
  data () {
    return {
      specificGames: []
    }
  },
  mounted () {
    var newGames = this.games
    for (var x in newGames) {
      if (
        newGames[x].id_team1 === this.team.id ||
        newGames[x].id_team2 === this.team.id
      ) {
        this.specificGames.push(newGames[x])
      }
    }
  }
}
</script>

<style lang="scss" scoped>
.inline {
  text-align: center;
}

.logo {
  display: block;
  margin-left: auto;
  margin-right: auto;
  // width: 50%;
}

a {
  display: block;
  // overflow: hidden;
  float: left;
}

img {
  vertical-align: top;
}

.space {
  padding-top: 70px;
  width: 100%;
}

/* DEMO 3 */

.demo-3 a {
  margin-top: -80px;
}
</style>

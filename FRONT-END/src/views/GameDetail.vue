<template>
  <div id="gamedetail">
    <div class="space demo-3">
    <div class="card" bottom>
      <a class="center">
        <img style="display: inline;" :src="allTeams[game[0].id_team1-1].logo" width="100" height="100" class="logo1" center/>
        <img style="display: inline;" src="https://d30y9cdsu7xlg0.cloudfront.net/png/161226-200.png" width="100" height="100" center/>
        <img style="display: inline;" :src="allTeams[game[0].id_team2-1].logo" width="100" height="100" class="logo2" center/>
      </a>
  <div class="card-body">
    <div class="row">
    <div class="col-6">
      <h2 class="inline">{{ allTeams[game[0].id_team1-1].name }}</h2>
    <h5 class="inline" > {{ allTeams[game[0].id_team1].division }} Division</h5>
    </div>
    <div class="col-6">
       <h2 class="inline">{{ allTeams[game[0].id_team2-1].name }}</h2>
    <h5 class="inline" > {{ allTeams[game[0].id_team2-1].division }} Division</h5>
    </div>
  </div>
  <h2 class="inline demo-3" >{{game[0].score_team1}} VS {{game[0].score_team2}}</h2>
  <hr>
  <h2 class="inline">Past Games</h2>
  <div class="row inline">
    <div class="col-sm">
    </div>
    <div class="col-sm">
    </div>
    <div class="col-sm">
    </div>
  </div>
    <div class="card">
  <div class="card-body">
    <lastgames v-if="specificGames" v-bind:specificGames="game"></lastgames>
  </div>
</div>
  <div class="row">
    <div class="col-3">
      <button @click="showEdit" type="button" class="btn btn-dark" style="width: 100%">Edit Game</button>
    </div>
    <div class="col-6">
    </div>
    <div class="col-3">
    <button @click="showModal" type="button" class="btn btn-dark" style="width: 100%">Delete Game</button>
    </div>
</div>
  </div>
</div>
</div>
      <!-- MODAL DELETING-->
       <div>
    <b-modal ref="myModalRef" hide-footer title="Warning">
      <div class="d-block text-center">
        <h3>You are deleting this Game. Are you sure about that?</h3>
      </div>
      <div class="row">
    <div class="col">
    </div>
    <div class="col">
      <b-btn class="mt-3" variant="outline" block @click="hideModal">Cancel</b-btn>
    </div>
    <div class="col">
      <b-btn class="mt-3" variant="outline-danger" block @click="deleteGame">Delete</b-btn>
    </div>
  </div>
    </b-modal>
  </div>
    <!-- MODAL EDITING -->
    <div>
  <!-- Modal Component -->
  <b-modal size="lg" ref="editModal" hide-footer id="modal-center" centered title="Game Edit">
    <games v-bind:gameID="game[0].id"
      v-bind:teams="allTeams"
      v-bind:team1Select="allTeams[game[0].id_team1-1]"
      v-bind:team2Select="allTeams[game[0].id_team2-1]"
      v-bind:score1="game[0].score_team1"
      v-bind:score2="game[0].score_team2"
      v-bind:watched="game[0].watched"
      v-bind:vModelExample="game[0].game_date"
      method="put"
    ></games>
  </b-modal>
</div>
    </div>
</template>

<script>
import LastGames from '../components/LastGames.vue'
import GamesPlayed from '../components/GamesPlayed.vue'
import Visualizations from '../components/Visualizations.vue'
import Scores from '../components/Scores.vue'
import Games from '../views/Games.vue'
export default {
  components: {
    lastgames: LastGames,
    gamesplayed: GamesPlayed,
    visualizations: Visualizations,
    scores: Scores,
    games: Games
  },
  name: 'gamedetail',
  props: ['game', 'allGames', 'allTeams'],
  data () {
    return {
      teams: [],
      specificGames: []
    }
  },
  methods: {
    showEdit () {
      this.$refs.editModal.show()
    },
    showModal () {
      this.$refs.myModalRef.show()
    },
    hideModal () {
      this.$refs.myModalRef.hide()
    },
    deleteGame () {
      this.$http.delete(`http://nhl.admin/api/games/${this.game[0].id}`).then(
        response => {
          this.hideModal()
          this.$router.push('Dashboard')
        },
        response => {
          // error callback
        }
      )
    }
  },
  mounted () {
    this.specificGames = this.game
    this.newGames = this.$store.getters.getGames
  }
}
</script>

<style lang="scss" scoped>
.inline {
  text-align: center;
}

.logo1 {
  display: block;
  margin-left: auto;
  margin-right: auto;
  width: 46.5%;
  padding-left: 5%;
}

.logo2 {
  display: block;
  position: absolute;
  margin-left: auto;
  margin-right: auto;
  width: 46.5%;
  padding-right: 5%;
}

a {
  display: block;
  overflow: hidden;
  float: left;
}

.space {
  padding-top: 70px;
  width: 100%;
}

.demo-3 a {
  margin-top: -50px;
}
</style>

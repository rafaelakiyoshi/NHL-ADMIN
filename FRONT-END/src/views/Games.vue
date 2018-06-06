<template>
  <div id="game" class="animated fadeIn">
    <div class="card">
      <div class="card-body">
  <b-alert variant="success" :show="finishComponent" >Success Alert</b-alert>
<form v-if="!finishComponent">
  <datepicker :format="format" style="text-align: center;" placeholder="Date of the Game" v-model="noPropvModelExample"></datepicker>
  <br>
  <div class="row">
  <div class="col-6">
    <div class="form-group">
      <label class="mr-sm-2" for="inlineFormCustomSelect">Team 1</label>
      <img v-if="noPropteam1Select" :src="noPropteam1Select.logo" width="50" height="50" class="logo" center/>
      <select class="custom-select mr-sm-2"  v-model="noPropteam1Select" id="inlineFormCustomSelect">
        <option v-for="team in noPropteams" :value="team" v-bind:key="team.id">{{ team.name }}</option>
      </select>
      <br><br>
      <label class="mr-sm-2" for="inlineFormCustomSelect">Score Team 1</label>
      <select class="custom-select mr-sm-2" v-model="noPropscore1" id="inlineFormCustomSelect">
         <option v-for="score in scores" :value="score" v-bind:key="score">{{ score }}</option>
      </select>
    </div>
  </div>
  <!-- <div class="col-sm">col-sm</div> -->
  <div class="col-6">
    <div class="form-group">
      <label class="mr-sm-2" for="inlineFormCustomSelect">Team 2</label>
      <img v-if="noPropteam2Select" :src="noPropteam2Select.logo" width="50" height="50" class="logo" center/>
      <select class="custom-select mr-sm-2"  v-model="noPropteam2Select" id="inlineFormCustomSelect">
        <option v-for="team in noPropteams" :value="team" v-bind:key="team.id">{{ team.name }}</option>
      </select>
      <br><br>
      <label class="mr-sm-2" for="inlineFormCustomSelect">Score Team 2</label>
      <select class="custom-select mr-sm-2" v-model="noPropscore2" id="inlineFormCustomSelect">
         <option v-for="score in scores" :value="score" v-bind:key="score">{{ score }}</option>
      </select>
    </div>
  </div>
</div>
<label class="mr-sm-2" for="inlineFormCustomSelect">Game Views</label>
      <input v-model="noPropwatched" type="number" class="form-control" id="exampleFormControlInput1" placeholder="How many people watched?">
      <br><br>
      <button @click="saveGame" type="submit" class="btn btn-dark" style="width: 100%">Save</button>
  </form>
    </div>
  </div>
  </div>
</template>

<script>
import Datepicker from 'vuejs-datepicker'
export default {
  name: 'games',
  props: [
    'gameID',
    'teams',
    'team1Select',
    'team2Select',
    'score1',
    'score2',
    'watched',
    'vModelExample',
    'method'
  ],
  components: {
    Datepicker
  },
  data () {
    return {
      scores: [0, 1, 2, 3, 4, 5, 6, 7, 8, 9],
      format: 'd MMMM yyyy',
      finishComponent: false,
      noPropteam1Select: {},
      noPropteam2Select: {},
      noPropscore1: {},
      noPropscore2: {},
      noPropwatched: 0,
      noPropvModelExample: null,
      noPropteams: null
    }
  },
  methods: {
    showEdit () {
      this.$refs.editModal.hide()
    },
    hideModal () {
      this.$refs.myModalRef.hide()
    },
    saveGame () {
      let date
      try {
        date = this.noPropvModelExample
          .toISOString('YYYY-MM-DD')
          .match(/\d{4}-\d{2}-\d{2}/)[0]
      } catch (e) {
        date = this.noPropvModelExample
      }
      let gameUpdate = {
        id_team1: this.noPropteam1Select.id,
        id_team2: this.noPropteam2Select.id,
        score_team1: this.noPropscore1,
        score_team2: this.noPropscore2,
        game_date: date,
        watched: parseInt(this.noPropwatched)
      }

      if (this.method === 'put') {
        this.$http
          .put(`http://nhl.admin/api/games/${this.gameID}`, gameUpdate)
          .then(
            response => {
              this.finishComponent = !this.finishComponent
              this.finishComponent = false
              this.$router.push('Dashboard')
            },
            response => {
              // error callback
            }
          )
      } else {
        this.$http.post(`http://nhl.admin/api/games/`, gameUpdate).then(
          response => {
            this.finishComponent = !this.finishComponent
            this.finishComponent = false
            this.$router.push('Dashboard')
          },
          response => {
            // error callback
          }
        )
      }
    }
  },
  beforeMount () {
    this.noPropteam1Select = this.team1Select
    this.noPropteam2Select = this.team2Select
    this.noPropscore1 = this.score1
    this.noPropscore2 = this.score2
    this.noPropwatched = this.watched
    this.noPropvModelExample = this.vModelExample
    this.noPropteams = this.teams
    this.finishComponent = false
    if (!this.teams) {
      this.$http.get('http://nhl.admin/api/teams/').then(
        response => {
          this.noPropteams = response.body
        },
        response => {
          // error callback
        }
      )
    }
  }
}
</script>
<style lang="scss" scoped>
.form {
  display: inline;
}
</style>

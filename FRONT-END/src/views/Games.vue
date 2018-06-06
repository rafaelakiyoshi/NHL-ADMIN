<template>
  <div id="game" class="animated fadeIn">
  <b-alert variant="success" :show="finishComponent" >Success Alert</b-alert>
<form v-if="!finishComponent">
  <datepicker :format="format" style="text-align: center;" placeholder="Date of the Game" v-model="vModelExample"></datepicker>
  <br>
  <div class="row">
  <div class="col-6">
    <div class="form-group">
      <label class="mr-sm-2" for="inlineFormCustomSelect">Team 1</label>
      <img v-if="team1Select.logo" :src="team1Select.logo" width="50" height="50" class="logo" center/>
      <select class="custom-select mr-sm-2"  v-model="team1Select" id="inlineFormCustomSelect">
        <option v-for="team in teams" :value="team" v-bind:key="team.id">{{ team.name }}</option>
      </select>
      <br><br>
      <label class="mr-sm-2" for="inlineFormCustomSelect">Score Team 1</label>
      <select class="custom-select mr-sm-2" v-model="score1" id="inlineFormCustomSelect">
         <option v-for="score in scores" :value="score" v-bind:key="score">{{ score }}</option>
      </select>
    </div>
  </div>
  <!-- <div class="col-sm">col-sm</div> -->
  <div class="col-6">
    <div class="form-group">
      <label class="mr-sm-2" for="inlineFormCustomSelect">Team 2</label>
      <img v-if="team1Select.logo" :src="team2Select.logo" width="50" height="50" class="logo" center/>
      <select class="custom-select mr-sm-2"  v-model="team2Select" id="inlineFormCustomSelect">
        <option v-for="team in teams" :value="team" v-bind:key="team.id">{{ team.name }}</option>
      </select>
      <br><br>
      <label class="mr-sm-2" for="inlineFormCustomSelect">Score Team 2</label>
      <select class="custom-select mr-sm-2" v-model="score2" id="inlineFormCustomSelect">
         <option v-for="score in scores" :value="score" v-bind:key="score">{{ score }}</option>
      </select>
    </div>
  </div>
  
</div>
<label class="mr-sm-2" for="inlineFormCustomSelect">Game Views</label>
      <input v-model="watched" type="number" class="form-control" id="exampleFormControlInput1" placeholder="How many people watched?">
      <br><br>
      <button @click="saveGame" type="submit" class="btn btn-dark" style="width: 100%">Save</button>
</form>

    <!-- <div class="card">
    <div class="card-body">
      <h1 style="text-align: center;">Creating a New Game</h1>
      <hr>
      <div class="col" style="text-align: center;">
         <img v-if="team1Select.logo" :src="team1Select.logo" width="150" height="150" class="logo" center/>

         
         <select placeholder="lala" v-model="team1Select" class="form-control form-control-lg" style="max-width: 18rem; display: inline;" required>
            <option v-for="team in teams" :value="team" v-bind:key="team.id">{{ team.name }}</option>
         </select>
         <select v-model="score1" class="form-control" id="exampleFormControlSelect1" style="max-width: 5rem; display: inline;">
            <option v-for="score in scores" :value="score" v-bind:key="score">{{ score }}</option>
         </select>
         <h2 style="display: inline;">VS</h2>
         <select v-model="score2" class="form-control" id="exampleFormControlSelect1" style="max-width: 5rem; display: inline;">
            <option v-for="score in scores" :value="score" v-bind:key="score">{{ score }}</option>
         </select>
         <select v-model="team2Select" class="form-control form-control-lg" style="max-width: 18rem; display: inline;">
            <option v-for="team in teams" v-bind:key="team.id" :value="team">{{ team.name }}</option>
         </select>
         <img v-if="team2Select.logo" :src="team2Select.logo" width="150" height="150" class="logo" center/>
      </div>
      <div class="container">
  <div class="row">
    <div class="col-sm">
    </div>
    <div class="col-sm">
      <h6 style="text-align: center;">Game Date</h6>
      
    <datepicker :format="format" style="text-align: center;" placeholder="Select Date" v-model="vModelExample"></datepicker>
    <br>
    <input v-model="watched" type="number" class="form-control" id="exampleFormControlInput1" placeholder="Game's Views">
    <br>
    </div>
    <div class="col-sm">
    </div>
  </div>
</div>
     <button @click="saveGame" type="button" class="btn btn-primary btn-lg btn-block">Save Game</button>
    </div>
  </div> -->
    
  </div>
</template>

<script>
import Datepicker from 'vuejs-datepicker'
export default {
  name: 'games',
  props: ['gameID', 'teams', 'team1Select', 'team2Select', 'score1', 'score2', 'watched', 'vModelExample', 'method'],
  components: {
    Datepicker
  },
  data () {
    return {
      vModelExample: null,
      teams: [],
      scores: [1,2,3,4,5,6,7,8,9],
      team1Select: {},
      team2Select: {},
      score1: null,
      score2: null,
      watched: null,
      format: "d MMMM yyyy",
      finishComponent: false
    }
  },
  methods: {
    showEdit () {
      console.log('chegou')
      this.$refs.editModal.hide()
    },
    hideModal () {
      this.$refs.myModalRef.hide()
    },
    saveGame () {
      // if (!this.team1Select || !this.team2Select || !this.score1 || !this.score2 || !this.watched || !this.vModelExample){
      //   this.$refs.myModalRef.show()
      //   return 0
      // }
      let date
      try{
        date = this.vModelExample.toISOString('YYYY-MM-DD').match(/\d{4}-\d{2}-\d{2}/)[0]
      } catch(e){
        date = this.vModelExample
      }
      let gameUpdate = {
        id_team1: this.team1Select.id,
        id_team2: this.team2Select.id,
        score_team1: this.score1,
        score_team2: this.score2,
        game_date: date,
        watched: parseInt(this.watched)
      }

      if (this.method === 'put'){
        this.$http.put(`http://nhl.admin/api/games/${this.gameID}`, gameUpdate).then(response => {
          this.finishComponent = !this.finishComponent
          this.finishComponent = false
          this.$router.push('Dashboard')
        }, response => {
          // error callback
        })
      } else {
        alert('NOT PUT')
      }
      
       
    }
  },
  mounted () {
    this.finishComponent = false
    if (!this.teams){
      this.$http.get('http://nhl.admin/api/teams/').then(response => {
        this.teams = response.body
        }, response => {
          // error callback
        })
    }
  }
}
</script>
<style lang="scss" scoped>
.form{
  display: inline;
}
</style>

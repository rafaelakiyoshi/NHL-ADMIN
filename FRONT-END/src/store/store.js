import Vue from 'vue'
import Vuex from 'vuex'

Vue.use(Vuex)

export const store = new Vuex.Store({
  state: {
    games: [],
    teams: [],
    update: false,
    teamDetail: {}
  },
  getters: {
    getTeamDetail: state => {
      return state.teamDetail
    },
    getTeams: state => {
      return state.teams
    },
    getGames: state => {
      return state.games
    },
    getUpdate: state => {
      return state.update
    }
  },
  mutations: {
    setTeamDetail: (state, teamDetail) => {
      state.teamDetail = teamDetail
    },
    setTeams: (state, teams) => {
      state.teams = teams
    },
    setGames: (state, games) => {
      state.games = games
    },
    setUpdate: state => {
      state.update = !this.update
    }
  }
})

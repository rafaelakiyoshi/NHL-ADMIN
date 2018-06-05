<template>
  <div id="graphics">
    <b-card>
      <b-row>
        <b-col sm="5">
          <h4 id="traffic" class="card-title mb-0">Traffic of Games and Visualization</h4>
          <div class="small text-muted">2018</div>
        </b-col>
        <b-col sm="7" class="d-none d-md-block">
          <b-button type="button" variant="primary" class="float-right"><i class="icon-cloud-download"></i></b-button>
          <b-button-toolbar class="float-right" aria-label="Toolbar with buttons group">
            <b-form-radio-group class="mr-3" id="radiosBtn" buttons button-variant="outline-secondary" name="radiosBtn">
              <b-form-radio class="mx-0" value="Day">Day</b-form-radio>
              <b-form-radio class="mx-0" value="Month">Month</b-form-radio>
              <b-form-radio class="mx-0" value="Year">Year</b-form-radio>
            </b-form-radio-group>
          </b-button-toolbar>
        </b-col>
      </b-row>
      <div id="main" style="width: 100%; height:550px;"></div>
    </b-card>
  </div>
</template>
<script>
import echarts from 'echarts'
export default {
  name: 'graphics',
  data () {
    return {
      myChart: null,
        games: [],
        games_watched: [],
        games_date: [],
        number_games: [],
        teams: [],
      option: {
        title: {
          text: 'NHL Games Tracking',
          subtext: '',
          x: 'center'
        },
        tooltip: {
          trigger: 'axis',
          axisPointer: {
            animation: false
          }
        },
        legend: {
          data: ['Peoples Watching', 'Number of Games'],
          x: 'left'
        },
        toolbox: {
          feature: {
            dataZoom: {
              yAxisIndex: 'none'
            },
            restore: {},
            saveAsImage: {}
          }
        },
        axisPointer: {
          link: { xAxisIndex: 'all' }
        },
        dataZoom: [
          {
            show: true,
            realtime: true,
            start: 0,
            end: 100,
            xAxisIndex: [0, 1]
          },
          {
            type: 'inside',
            realtime: true,
            start: 30,
            end: 70,
            xAxisIndex: [0, 1]
          }
        ],
        grid: [
          {
            left: 50,
            right: 50,
            height: '30%'
          },
          {
            left: 50,
            right: 50,
            top: '55%',
            height: '30%'
          }
        ],
        xAxis: [
          {
            type: 'category',
            boundaryGap: false,
            axisLine: { onZero: true },
            data: [
              '2009/10/1 4:00',
              '2009/10/1 5:00',
              '2009/10/1 6:00',
              '2009/10/1 7:00'
            ]
          },
          {
            gridIndex: 1,
            type: 'category',
            boundaryGap: false,
            axisLine: { onZero: true },
            data: [
              '2009/10/1 4:00',
              '2009/10/1 5:00',
              '2009/10/1 6:00',
              '2009/10/1 7:00'
            ],
            position: 'top'
          }
        ],
        yAxis: [
          {
            name: 'Peoples Watching',
            type: 'value',
          },
          {
            gridIndex: 1,
            name: 'Number of Games',
            type: 'value',
            inverse: true
          }
        ],
        series: [
          {
            name: 'Peoples Watching',
            type: 'line',
            symbolSize: 8,
            hoverAnimation: false,
            data: [0, 1, 2, 3]
          },
          {
            name: 'Number of Games',
            type: 'line',
            xAxisIndex: 1,
            yAxisIndex: 1,
            symbolSize: 8,
            hoverAnimation: false,
            data: [2, 4, 6, 8]
          }
        ]
      }
    }
  },
  methods: {
    setGraphic () {
      let gamesDataWithoutModification = []
    for (var x in this.games) {
      let gameInfo = {
        date: this.games[x].game_date,
        watched: this.games[x].watched,
        games: 1
      }
      gamesDataWithoutModification.push(gameInfo)
    }
    gamesDataWithoutModification.sort(function (a, b) {
      // Turn your strings into dates, and then subtract them
      // to get a value that is either negative, positive, or zero.
      return new Date(b.date) - new Date(a.date)
    })

    for (var k = 0; k <= gamesDataWithoutModification.length; k++) {
      for (var p = k; p <= gamesDataWithoutModification.length; p++) {
        try {
          if (
            gamesDataWithoutModification[k].date ===
            gamesDataWithoutModification[p].date
          ) {
            gamesDataWithoutModification[k].games++
            gamesDataWithoutModification[k].watched +=
              gamesDataWithoutModification[p].watched
            gamesDataWithoutModification.splice([p], 1)
          }
        } catch (e) {}
      }
    }
    for (var info in gamesDataWithoutModification) {
      this.games_date.push(gamesDataWithoutModification[info].date)
      this.games_watched.push(gamesDataWithoutModification[info].watched)
      this.number_games.push(gamesDataWithoutModification[info].games)
    }
    this.option.series[0].data = this.games_watched
    this.option.series[1].data = this.number_games
    this.option.xAxis[0].data = this.games_date
    this.option.xAxis[1].data = this.games_date
    this.myChart = echarts.init(document.getElementById('main'))
    this.myChart.setOption(this.option)
    }
  },
  mounted () {
    // Checking if the data already are in VueX or if there's any update to do.
    if (
      this.$store.getters.getTeams.length === 0 ||
      this.$store.getters.getGames.length === 0
    ) {
      console.log('Catching the Data')
      this.$http.get('http://nhl.admin/api/teams').then(
        response => {
          // get body data
          this.$store.commit('setTeams', response.body)
          this.teams = response.body
          this.setGraphic()
        },
        response => {
          // error callback
        }
      )

      this.$http.get('http://nhl.admin/api/games').then(
        response => {
          // get body data
          this.$store.commit('setGames', response.body)
          this.games = response.body
          this.setGraphic()
        },
        response => {
          // error callback
        }
      )
      
      
      
    } else {
      console.log('The Data already are in VueX')
      // The Data already are in VueX
      this.games = this.$store.getters.getGames
      this.teams = this.$store.getters.getTeams
      this.setGraphic()
    }
    // this.timeData = this.timeData.map(function(str) {
    //   return str.replace('2009/', ')
    // })
  }
}
</script>
<style lang="scss" scoped>
</style>

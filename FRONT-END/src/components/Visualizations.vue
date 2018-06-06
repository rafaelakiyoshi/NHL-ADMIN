<template>
  <div id="visualizations">
    <div class="card" style="height: 250px;">
        <div id="visualizationsGraph" style="width: 100%; height:100%;"></div>
      </div>
  </div>
</template>
<script>
import echarts from 'echarts'
export default {
  name: 'visualizations',
  props: ['team'],
  data () {
    return {
      games: [],
      option: {
        title: {
          text: 'Games Visualizations',
          subtext: 'Views per Game',
          x: 'center'
        },
        tooltip: {
          trigger: 'axis'
        },
        legend: {
          data: ['Step Start', 'Step Middle', 'Step End']
        },
        grid: {
          left: '3%',
          right: '4%',
          bottom: '3%',
          containLabel: true
        },
        toolbox: {
          feature: {
            saveAsImage: {}
          }
        },
        xAxis: {
          type: 'category',
          data: []
        },
        yAxis: {
          type: 'value'
        },
        series: [
          {
            name: 'Views',
            type: 'line',
            step: 'end',
            data: []
          }
        ]
      }
    }
  },
  mounted () {
    this.$http
      .get(
        `http://nhl.admin/api/teamGames/${this.$store.getters.getTeamDetail.id}`
      )
      .then(
        response => {
          // get body data
          this.games = response.body

          for (var x in this.games) {
            this.games[x].game_date = this.games[x].game_date.replace(
              '2018-',
              ''
            )
            this.option.xAxis.data.push(this.games[x].game_date)
            this.option.series[0].data.push(this.games[x].watched)
          }
          this.myChart = echarts.init(
            document.getElementById('visualizationsGraph')
          )
          this.myChart.setOption(this.option)

          console.log(this.games)
        },
        response => {
          // error callback
        }
      )
  }
}
</script>

<style lang="scss">
</style>

<template>
  <div id="scores">
    <div class="card" style="height: 250px;">
        <div id="scoresGraph" style="width: 100%; height:100%;"></div>
      </div>
  </div>
</template>
<script>
import echarts from 'echarts'
export default {
  name: 'scores',
  props: ['team'],
  data () {
    return {
      games: [],
      option: {
        title: {
          text: 'Games Goals',
          subtext: 'Goals per Game Day',
          x: 'center'
        },
        color: ['#3398DB'],
        tooltip: {
          trigger: 'axis',
          axisPointer: {
            // 坐标轴指示器，坐标轴触发有效
            type: 'shadow' // 默认为直线，可选为：'line' | 'shadow'
          }
        },
        grid: {
          left: '3%',
          right: '4%',
          bottom: '3%',
          containLabel: true
        },
        xAxis: [
          {
            type: 'category',
            data: [],
            axisTick: {
              alignWithLabel: true
            }
          }
        ],
        yAxis: [
          {
            type: 'value'
          }
        ],
        series: [
          {
            name: 'Goals',
            type: 'bar',
            barWidth: '60%',
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
            this.option.xAxis[0].data.push(this.games[x].game_date)
            if (
              this.games[x].id_team1 === this.$store.getters.getTeamDetail.id
            ) {
              this.option.series[0].data.push(this.games[x].score_team1)
            } else {
              this.option.series[0].data.push(this.games[x].score_team2)
            }
          }
          this.myChart = echarts.init(document.getElementById('scoresGraph'))
          this.myChart.setOption(this.option)
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

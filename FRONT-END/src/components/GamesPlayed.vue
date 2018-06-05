<template>
  <div id="gamesplayed">
    <div class="card" style="height: 250px;">
        <div id="main" style="width: 100%; height:100%;"></div>
      </div>
  </div>
</template>
<script>
import echarts from 'echarts'
export default {
  name: 'gamesplayed',
  props: ['team'],
  data () {
    return {
      games: [],
      option: {
    title : {
        text: 'Games Played',
        subtext: 'Wins vs Losses',
        x:'center'
    },
    tooltip : {
        trigger: 'item',
        formatter: "{a} <br/>{b} : {c} ({d}%)"
    },
    legend: {
        orient: 'vertical',
        left: 'left',
        data: ['Wins','Losses','Draws']
    },
    series : [
        {
            name: 'Games',
            type: 'pie',
            radius : '55%',
            center: ['50%', '60%'],
            data:[
                {value:335, name:'Wins'},
                {value:310, name:'Losses'},
                {value:234, name:'Draws'},
            ],
            itemStyle: {
                emphasis: {
                    shadowBlur: 10,
                    shadowOffsetX: 0,
                    shadowColor: 'rgba(0, 0, 0, 0.5)'
                }
            }
        }
    ]
}
    }
  },
  mounted () {
    this.$http.get(`http://nhl.admin/api/teamGames/${this.$store.getters.getTeamDetail.id}`).then(response => {
        // get body data
          this.games = response.body
          let wins = 0
          let losses = 0
          let draws = 0
          for (var x in this.games) {
            if (this.games[x].id_team1 === this.$store.getters.getTeamDetail.id){
              if (this.games[x].score_team1 > this.games[x].score_team2){
                wins++
              } else if (this.games[x].score_team1 < this.games[x].score_team2){
                losses++
              } else {
                draws++
              }
            } else if (this.games[x].id_team2 === this.$store.getters.getTeamDetail.id){
              if (this.games[x].score_team2 > this.games[x].score_team1){
                wins++
              } else if (this.games[x].score_team2 < this.games[x].score_team1){
                losses++
              } else {
                draws++
              }
            }
          }
          this.option.series[0].data[0].value = wins
          this.option.series[0].data[1].value = losses
          this.option.series[0].data[2].value = draws
          this.myChart = echarts.init(document.getElementById('main'))
          this.myChart.setOption(this.option)
        }, response => {
        // error callback
        })
  }
}
</script>

<style lang="scss">

</style>

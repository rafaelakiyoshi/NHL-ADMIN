<template>
  <div class="animated fadeIn">
     <graphics></graphics>
    <hr>
      <div class="row">
        <div class="col">
          <lastgames></lastgames>
        </div>
        <div class="col-5">
          <ranking></ranking>
        </div>
      </div>
  </div>
</template>
<script>
import LastGames from '../components/LastGames.vue'
import Ranking from '../components/Ranking.vue'
import Graphics from '../components/Graphics.vue'
export default {
  name: 'dashboard',
  components: {
    graphics: Graphics,
    lastgames: LastGames,
    ranking: Ranking
  },
  data () {
    return {
    }
  },
  methods: {
  },
  mounted () {
    
  }
}
</script>

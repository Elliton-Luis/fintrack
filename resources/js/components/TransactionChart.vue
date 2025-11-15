<template>
  <div class="w-full bg-slate-700/20 border border-slate-600 rounded-xl shadow-lg p-6 flex flex-col backdrop-blur-sm">
    <h3 class="text-lg font-semibold text-white mb-4">Gastos por Categoria</h3>

    <div class="flex items-center justify-center h-64">
      <canvas ref="chartEl" class="max-h-full"></canvas>
    </div>

    <div class="mt-6 pt-4 text-center border-t border-slate-700">
      <button class="text-sm font-medium text-emerald-400 hover:text-emerald-300 transition-colors">
        Ver detalhes
      </button>
    </div>
  </div>
</template>

<script setup>
import { onMounted, ref } from 'vue'
import { Chart, PieController, ArcElement, Tooltip, Legend, Title } from 'chart.js'

Chart.register(PieController, ArcElement, Tooltip, Legend, Title)

const chartEl = ref(null)

onMounted(() => {
  new Chart(chartEl.value, {
    type: 'pie',
    data: {
      labels: ['Aluguel', 'Comida', 'Transporte', 'Lazer', 'Saúde', 'Investimentos'],
      datasets: [
        {
          data: [420, 680, 190, 310, 140, 500],
          backgroundColor: [
            'rgb(239,68,68)',
            'rgb(34,197,94)',
            'rgb(59,130,246)',
            'rgb(234,179,8)',
            'rgb(168,85,247)',
            'rgb(244,63,94)'
          ],
          borderColor: 'rgba(255,255,255,0.1)',
          borderWidth: 1,
        }
      ]
    },
    options: {
      responsive: true,
      maintainAspectRatio: false,
      plugins: {
        legend: {
          labels: { color: '#fff' }
        },
        title: {
          display: false
        }
      }
    }
  })
})
</script>

<style scoped>
canvas {
  max-width: 100%;
}
</style>

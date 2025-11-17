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
import { ref, onMounted, computed, watch } from 'vue'
import { Chart, PieController, ArcElement, Tooltip, Legend, Title } from 'chart.js'

Chart.register(PieController, ArcElement, Tooltip, Legend, Title)

const props = defineProps({
  transactions: Array
})

const chartEl = ref(null)
let chartInstance = null

const categoryTotals = computed(() => {
  return (props.transactions ?? []).reduce((acc, t) => {
    const category = t.category?.name ?? 'Sem categoria'
    acc[category] = (acc[category] || 0) + Number(t.amount)
    return acc
  }, {})
})

function distinctColor(index, total) {
  const hue = Math.round((360 / total) * index)
  return `hsl(${hue}, 70%, 50%)`
}

const chartData = computed(() => {
  const totals = categoryTotals.value
  const keys = Object.keys(totals)
  return {
    labels: keys,
    datasets: [
      {
        label: 'Gastos por Categoria',
        data: Object.values(totals),
        backgroundColor: keys.map((_, i) => distinctColor(i, keys.length)),
        borderColor: 'rgba(255,255,255,0.1)',
        borderWidth: 1,
      }
    ]
  }
})

function renderChart() {
  if (chartInstance) chartInstance.destroy()
  chartInstance = new Chart(chartEl.value, {
    type: 'pie',
    data: chartData.value,
    options: {
      responsive: true,
      maintainAspectRatio: false,
      plugins: {
        legend: { labels: { color: '#fff' } },
        title: { display: false }
      }
    }
  })
}

onMounted(renderChart)
watch(chartData, renderChart)
</script>

<style scoped>
canvas {
  max-width: 100%;
}
</style>

<template>
  <div class="w-full bg-slate-700/20 border border-slate-600 rounded-xl shadow-lg p-6 flex flex-col backdrop-blur-sm h-full">
    <h3 class="text-lg font-semibold text-white mb-4">Gastos por Categoria</h3>

    <div class="relative flex items-center justify-center h-64 w-full">
      <!-- Canvas do Gráfico -->
      <canvas ref="chartEl" class="max-h-full z-10 relative"></canvas>
    </div>

    <div class="mt-6 pt-4 text-center border-t border-slate-700">
      <button class="text-sm font-medium text-emerald-400 hover:text-emerald-300 transition-colors flex items-center justify-center gap-2 mx-auto group">
        Ver detalhes
        <i class="pi pi-arrow-right text-xs transition-transform group-hover:translate-x-1"></i>
      </button>
    </div>
  </div>
</template>

<script setup>
import { ref, onMounted, computed, watch } from 'vue'
import { Chart, DoughnutController, ArcElement, Tooltip, Legend, Title } from 'chart.js'

// Registrar DoughnutController
Chart.register(DoughnutController, ArcElement, Tooltip, Legend, Title)

const props = defineProps({
  transactions: {
    type: Array,
    default: () => []
  }
})

const chartEl = ref(null)
let chartInstance = null

// Paleta de cores moderna
const modernPalette = [
  '#10b981', // Emerald
  '#3b82f6', // Blue
  '#f59e0b', // Amber
  '#8b5cf6', // Violet
  '#ef4444', // Red
  '#ec4899', // Pink
  '#06b6d4', // Cyan
  '#6366f1', // Indigo
]

// Processar dados: Agrupar por categoria
const categoryData = computed(() => {
  const data = (props.transactions ?? []).reduce((acc, t) => {
    const categoryName = t.category?.name ?? 'Outros';
    acc[categoryName] = (acc[categoryName] || 0) + Number(t.amount);
    return acc;
  }, {});

  return {
    labels: Object.keys(data),
    values: Object.values(data)
  };
});

// Formatar moeda
const formatMoney = (val) => {
  return new Intl.NumberFormat('pt-BR', { style: 'currency', currency: 'BRL' }).format(val);
}

const chartConfig = computed(() => {
  return {
    labels: categoryData.value.labels,
    datasets: [
      {
        label: 'Gastos',
        data: categoryData.value.values,
        backgroundColor: categoryData.value.labels.map((_, i) => modernPalette[i % modernPalette.length]),
        borderColor: '#1e293b', // Cor de fundo do card para criar espaçamento
        borderWidth: 4,
        hoverOffset: 4
      }
    ]
  }
})

function renderChart() {
  if (!chartEl.value) return;
  if (chartInstance) chartInstance.destroy();

  chartInstance = new Chart(chartEl.value, {
    type: 'doughnut',
    data: chartConfig.value,
    options: {
      responsive: true,
      maintainAspectRatio: false,
      cutout: '75%', // Mantém o buraco da rosca
      plugins: {
        legend: {
          position: 'right',
          labels: {
            color: '#cbd5e1',
            usePointStyle: true,
            pointStyle: 'circle',
            padding: 15,
            font: {
              family: "ui-sans-serif, system-ui, sans-serif",
              size: 11
            }
          }
        },
        tooltip: {
          backgroundColor: '#0f172a',
          titleColor: '#fff',
          bodyColor: '#cbd5e1',
          borderColor: '#334155',
          borderWidth: 1,
          padding: 10,
          displayColors: true,
          callbacks: {
            label: function(context) {
              let label = context.label || '';
              if (label) {
                label += ': ';
              }
              if (context.parsed !== null) {
                label += formatMoney(context.parsed);
              }
              return label;
            }
          }
        },
        title: { display: false }
      }
    }
  })
}

onMounted(renderChart)

watch(() => props.transactions, renderChart, { deep: true })
</script>

<style scoped>
canvas {
  max-width: 100%;
}
</style>

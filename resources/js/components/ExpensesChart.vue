<template>
  <div class="w-full bg-slate-700/20 border border-slate-600 rounded-2xl shadow-lg p-6 flex flex-col backdrop-blur-sm h-full">
    <h3 class="text-lg font-semibold text-white">Gastos por Categoria</h3>

    <div class="relative flex items-center justify-center h-56 w-full mt-4">
      <canvas v-if="hasData" ref="chartEl" class="max-h-full z-10 relative"></canvas>

      <div v-else class="flex flex-col items-center justify-center text-slate-400 animate-pulse">
        <i class="pi pi-inbox text-4xl mb-3 opacity-50"></i>
        <span class="text-sm font-medium">Nenhuma transação encontrada nesse mês</span>
      </div>
    </div>

    <div class="mt-6 pt-4 text-center border-t border-slate-700">
      <button
        :class="{'opacity-50 cursor-not-allowed': !hasData}"
        class="text-sm font-medium text-emerald-400 hover:text-emerald-300 transition-colors flex items-center justify-center gap-2 mx-auto group"
      >
        Ver detalhes
        <i class="pi pi-arrow-right text-xs transition-transform group-hover:translate-x-1"></i>
      </button>
    </div>
  </div>
</template>

<script setup>
import { ref, onMounted, computed, watch } from 'vue'
import { Chart, DoughnutController, ArcElement, Tooltip, Legend, Title } from 'chart.js'

Chart.register(DoughnutController, ArcElement, Tooltip, Legend, Title)

const props = defineProps({
  transactions: {
    type: Array,
    default: () => []
  }
})

const chartEl = ref(null)
let chartInstance = null

const modernPalette = [
  '#10b981', '#3b82f6', '#f59e0b', '#8b5cf6',
  '#ef4444', '#ec4899', '#06b6d4', '#6366f1','#84cc16'
]

const hasData = computed(() => {
  return categoryData.value.values.length > 0;
});

const categoryData = computed(() => {
  const expensesOnly = (props.transactions ?? []).filter(t => t.type === 'expense');

  const data = expensesOnly.reduce((acc, t) => {
    const categoryName = t.category?.name ?? 'Outros';
    acc[categoryName] = (acc[categoryName] || 0) + Number(t.amount);
    return acc;
  }, {});

  return {
    labels: Object.keys(data),
    values: Object.values(data)
  };
});

const formatMoney = (val) => {
  return new Intl.NumberFormat('pt-BR', { style: 'currency', currency: 'BRL' }).format(val);
}

const formatCompactMoney = (val) => {
  if (val >= 1000000) {
    const millions = val / 1000000;
    const formattedNum = new Intl.NumberFormat('pt-BR', {
      minimumFractionDigits: 1,
      maximumFractionDigits: 2
    }).format(millions);

    return `R$ ${formattedNum}M`;
  }

  return formatMoney(val);
}

const centerTextPlugin = {
  id: 'centerText',
  beforeDraw: function(chart) {
    const { ctx, width, height } = chart;

    ctx.save();

    let total = 0;
    const dataset = chart.data.datasets[0];

    dataset.data.forEach((value, index) => {
      if (chart.getDataVisibility(index)) {
        total += value;
      }
    });

    const text = formatCompactMoney(total);

    const fontSizeBase = text.length > 10 ? 180 : 160;
    const fontSize = (height / fontSizeBase).toFixed(2);

    ctx.font = `bold ${fontSize}em ui-sans-serif, system-ui, sans-serif`;
    ctx.textBaseline = 'middle';
    ctx.fillStyle = '#ffffff';

    const chartAreaCenterX = (chart.chartArea.left + chart.chartArea.right) / 2;
    const chartAreaCenterY = (chart.chartArea.top + chart.chartArea.bottom) / 2;

    const trueTextX = Math.round(chartAreaCenterX - (ctx.measureText(text).width / 2));

    ctx.fillText(text, trueTextX, chartAreaCenterY + 10);

    ctx.font = `500 ${(height / 240).toFixed(2)}em ui-sans-serif`;
    ctx.fillStyle = '#94a3b8';

    const subText = "Total";
    const subTextX = Math.round(chartAreaCenterX - (ctx.measureText(subText).width / 2));
    ctx.fillText(subText, subTextX, chartAreaCenterY - 15);

    ctx.restore();
  }
};

const chartConfig = computed(() => {
  return {
    labels: categoryData.value.labels,
    datasets: [
      {
        label: 'Gastos',
        data: categoryData.value.values,
        backgroundColor: categoryData.value.labels.map((_, i) => modernPalette[i % modernPalette.length]),
        borderColor: '#1e293b',
        borderWidth: 4,
        hoverOffset: 4
      }
    ]
  }
})

function renderChart() {
  if (chartInstance) {
    chartInstance.destroy();
    chartInstance = null;
  }

  if (!chartEl.value || !hasData.value) return;

  chartInstance = new Chart(chartEl.value, {
    type: 'doughnut',
    data: chartConfig.value,
    plugins: [centerTextPlugin],
    options: {
      responsive: true,
      maintainAspectRatio: false,
      cutout: '75%',
      layout: {
        padding: 0
      },
      plugins: {
        legend: {
          position: 'right',
          labels: {
            color: '#e2e8f0',
            usePointStyle: true,
            pointStyle: 'circle',
            padding: 20,
            font: {
                family: "ui-sans-serif, system-ui, sans-serif",
                size: 12,
                weight: '500'
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
              if (label) label += ': ';
              if (context.parsed !== null) label += formatMoney(context.parsed);
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

watch(chartConfig, () => {
  renderChart();
}, { deep: true, flush: 'post' });

</script>

<style scoped>
canvas {
  max-width: 100%;
}
</style>

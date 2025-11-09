<template>
  <div class="w-full bg-slate-800 rounded-lg shadow-lg p-6">
    <h3 class="text-xl font-semibold text-white mb-6">Gráfico de Categorias</h3>

    <div class="flex justify-center gap-6 mb-8">
      <label class="flex items-center cursor-pointer">
        <input type="radio" v-model="chartType" value="Ganho" class="sr-only peer" />
        <span class="w-4 h-4 rounded-full border-2 border-gray-600 peer-checked:bg-emerald-500 peer-checked:border-emerald-500"></span>
        <span class="ml-2 font-medium text-emerald-500">Ganhos</span>
      </label>
      <label class="flex items-center cursor-pointer">
        <input type="radio" v-model="chartType" value="Gasto" class="sr-only peer" />
        <span class="w-4 h-4 rounded-full border-2 border-gray-600 peer-checked:bg-red-500 peer-checked:border-red-500"></span>
        <span class="ml-2 font-medium text-red-500">Gastos</span>
      </label>
    </div>

    <div v-if="chartData.datasets[0].data.length > 0" class="relative h-64">
      <Pie :chart-data="chartData" :chart-options="chartOptions" />
    </div>

    <div v-else class="text-center text-gray-400 py-10">
      Nenhum dado para exibir neste tipo de transação.
    </div>

  </div>
</template>

<script setup>
import { ref, computed, defineAsyncComponent } from 'vue';
import { Chart, registerables } from 'chart.js';
import colors from 'tailwindcss/colors';

const Pie = defineAsyncComponent(() =>
  import('vue-chart-3').then(module => module.Pie)
)

Chart.register(...registerables);

const chartType = ref('Gasto');

const dataGanhos = ref({
  Salário: 3000,
  Investimentos: 500,
  Freelance: 800,
});

const dataGastos = ref({
  Aluguel: 1200,
  Mercado: 700,
  Transporte: 250,
  Lazer: 400,
  Contas: 300,
});

const backgroundColors = [
  colors.rose[500],
  colors.blue[500],
  colors.yellow[400],
  colors.cyan[500],
  colors.purple[500],
  colors.orange[500],
  colors.emerald[500],
  colors.red[500]
];

const chartData = computed(() => {
  const data = chartType.value === 'Ganho' ? dataGanhos.value : dataGastos.value;
  const labels = Object.keys(data);
  const values = Object.values(data);

  return {
    labels: labels,
    datasets: [
      {
        data: values,
        backgroundColor: backgroundColors.slice(0, labels.length),
      },
    ],
  };
});

const chartOptions = ref({
  responsive: true,
  maintainAspectRatio: false,
  plugins: {
    legend: {
      labels: {
        color: colors.slate[300],
      },
    },
    tooltip: {
      callbacks: {
        label: function(context) {
          let label = context.label || '';
          if (label) {
            label += ': ';
          }
          if (context.parsed !== null) {
            label += new Intl.NumberFormat('pt-BR', { style: 'currency', currency: 'BRL' }).format(context.parsed);
          }
          return label;
        }
      }
    }
  },
});
</script>

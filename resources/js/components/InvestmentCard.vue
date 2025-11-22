<script setup>
import { computed } from 'vue';
import { Link } from '@inertiajs/vue3';

const props = defineProps({
    name: { type: String, default: 'Tesouro Selic' },
    type: { type: String, default: 'Renda Fixa' },
    investedAmount: { type: Number, default: 10000 },
    currentAmount: { type: Number, default: 10850.50 },
    allocation: { type: Number, default: 15 },
    lastUpdate: { type: String, default: '20/10' },
    icon: { type: String, default: 'pi-chart-line' }
});

const profit = computed(() => {
    return props.currentAmount - props.investedAmount;
});

const profitPercentage = computed(() => {
    if (props.investedAmount === 0) return 0;
    return ((props.currentAmount - props.investedAmount) / props.investedAmount) * 100;
});

const isPositive = computed(() => profit.value >= 0);

const formatMoney = (val) => {
    return new Intl.NumberFormat('pt-BR', { style: 'currency', currency: 'BRL' }).format(val);
}
</script>

<template>
    <!--
        Ajuste de Tamanho:
        1. Adicionado 'min-w-[300px]' para manter consistência com o GoalCard.
        2. Mantido 'w-full' e 'h-full' para preencher o grid corretamente.
        3. Padding padronizado 'p-5 sm:p-6'.
    -->
    <div class="bg-slate-700/20 border border-slate-600 rounded-xl p-5 sm:p-6 shadow-lg h-full flex flex-col justify-between relative overflow-hidden group w-full min-w-[300px]">

        <!-- Glow Effect (Violeta) -->
        <div class="absolute top-0 right-0 -mt-4 -mr-4 w-24 h-24 bg-violet-500/10 rounded-full blur-2xl group-hover:bg-violet-500/20 transition-all duration-500"></div>

        <div>
            <!-- Header -->
            <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center mb-4 gap-3 sm:gap-0">
                <div class="flex items-center gap-3">
                    <div class="p-2 bg-slate-800/50 rounded-lg border border-slate-600/50 backdrop-blur-sm">
                        <i :class="`pi ${icon} text-violet-400 text-xl`"></i>
                    </div>
                    <div>
                        <h3 class="text-lg font-semibold text-white tracking-wide leading-tight">{{ name }}</h3>
                        <span class="text-xs text-slate-400">{{ type }}</span>
                    </div>
                </div>

                <!-- Badge -->
                <span
                    class="text-xs font-bold px-2 py-1 rounded-md border whitespace-nowrap"
                    :class="isPositive ? 'bg-emerald-500/10 text-emerald-400 border-emerald-500/20' : 'bg-red-500/10 text-red-400 border-red-500/20'"
                >
                    {{ isPositive ? '+' : '' }}{{ profitPercentage.toFixed(2) }}%
                </span>
            </div>

            <!-- Valores -->
            <div class="mb-2">
                <span class="text-2xl font-bold text-white block">{{ formatMoney(currentAmount) }}</span>
                <span class="text-xs text-slate-400">
                    Investido: <span class="text-slate-300">{{ formatMoney(investedAmount) }}</span>
                </span>
            </div>

            <!-- Barra de Progresso -->
            <div class="relative w-full h-2 bg-slate-700 rounded-full mt-2 mb-6 overflow-hidden">
                <div
                    class="absolute top-0 left-0 h-full bg-violet-500 rounded-full transition-all duration-1000 ease-out shadow-[0_0_10px_rgba(139,92,246,0.6)]"
                    :style="{ width: `${allocation}%` }"
                ></div>
            </div>  
        </div>

        <div class="mt-1 pt-4 text-center border-t border-slate-700/50">
            <Link href="#" class="text-sm font-medium text-violet-400 hover:text-violet-300 transition-colors flex items-center justify-center gap-2 group-hover:gap-3 duration-300">
                Ver ativo
                <i class="pi pi-arrow-right text-xs"></i>
            </Link>
        </div>
    </div>
</template>

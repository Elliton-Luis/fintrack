<script setup>
import { computed } from 'vue';
import { Link } from '@inertiajs/vue3';

const props = defineProps({
    title: { type: String, default: 'Viagem dos Sonhos' },
    savedAmount: { type: Number, default: 1500 },
    targetAmount: { type: Number, default: 5000 },
    deadline: { type: String, default: '31/12/2024' },
    icon: { type: String, default: 'pi-globe' }
});

const percentage = computed(() => {
    if (props.targetAmount === 0) return 0;
    return Math.min((props.savedAmount / props.targetAmount) * 100, 100);
});

const remaining = computed(() => {
    return Math.max(props.targetAmount - props.savedAmount, 0);
});

const formatMoney = (val) => {
    return new Intl.NumberFormat('pt-BR', { style: 'currency', currency: 'BRL' }).format(val);
}
</script>

<template>
    <!--
        Estrutura Responsiva (baseada no exemplo):
        1. 'w-full' para se adaptar ao grid.
        2. 'p-5 sm:p-6' para padding dinâmico.
        3. Flexbox ajustado para mobile e desktop.
    -->
    <div class="bg-slate-700/20 border border-slate-600 rounded-xl p-5 sm:p-6 shadow-lg h-full flex flex-col justify-between relative overflow-hidden group w-full">

        <!-- Glow Effect (Verde Esmeralda) -->
        <div class="absolute top-0 right-0 -mt-4 -mr-4 w-24 h-24 bg-emerald-500/10 rounded-full blur-2xl group-hover:bg-emerald-500/20 transition-all duration-500"></div>

        <div>
            <!-- Header: Coluna no mobile, Linha no desktop -->
            <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center mb-4 gap-3 sm:gap-0">
                <div class="flex items-center gap-3">
                    <div class="p-2 bg-slate-800/50 rounded-lg border border-slate-600/50 backdrop-blur-sm">
                        <i :class="`pi ${icon} text-emerald-400 text-xl`"></i>
                    </div>
                    <h3 class="text-lg font-semibold text-white tracking-wide leading-tight">{{ title }}</h3>
                </div>

                <!-- Badge de Valor -->
                <span class="text-xs font-medium px-2 py-1 rounded-md bg-slate-800 text-slate-300 border border-slate-600 whitespace-nowrap">
                    {{ formatMoney(savedAmount) }} / {{ formatMoney(targetAmount) }}
                </span>
            </div>

            <!-- Barra de Progresso -->
            <div class="relative w-full h-2 bg-slate-700 rounded-full mt-2 mb-6 overflow-hidden">
                <div
                    class="absolute top-0 left-0 h-full bg-emerald-500 rounded-full transition-all duration-1000 ease-out shadow-[0_0_10px_rgba(16,185,129,0.6)]"
                    :style="{ width: `${percentage}%` }"
                ></div>
            </div>

            <!-- Grid de Detalhes -->
            <div class="grid grid-cols-2 gap-4 mb-2 bg-slate-800/30 p-3 rounded-lg border border-slate-700/50">
                <div class="flex flex-col">
                    <span class="text-[10px] text-slate-400 uppercase tracking-wider font-semibold mb-1">Prazo</span>
                    <div class="flex items-center gap-2 text-slate-200 font-bold text-base sm:text-lg">
                        <i class="pi pi-calendar text-emerald-500/70 text-sm"></i>
                        <span>{{ deadline }}</span>
                    </div>
                </div>

                <div class="flex flex-col items-end">
                    <span class="text-[10px] text-slate-400 uppercase tracking-wider font-semibold mb-1">Falta</span>
                    <div class="flex items-center gap-2 text-slate-200 font-bold text-base sm:text-lg">
                        <span>{{ formatMoney(remaining) }}</span>
                        <i class="pi pi-chart-line text-emerald-500/70 text-sm"></i>
                    </div>
                </div>
            </div>
        </div>

        <!-- Footer Action -->
        <div class="mt-4 pt-4 text-center border-t border-slate-700/50">
            <Link href="#" class="text-sm font-medium text-emerald-400 hover:text-emerald-300 transition-colors flex items-center justify-center gap-2 group-hover:gap-3 duration-300">
                Ver detalhes
                <i class="pi pi-arrow-right text-xs"></i>
            </Link>
        </div>
    </div>
</template>

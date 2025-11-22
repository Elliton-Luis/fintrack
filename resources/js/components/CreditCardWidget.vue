<script setup>
import { computed } from 'vue';
import { Link } from '@inertiajs/vue3';

const props = defineProps({
    name: { type: String, default: 'Mastercard' },
    currentAmount: { type: Number, default: 200 },
    limitAmount: { type: Number, default: 320 },
    closingDate: { type: String, default: '24/10' },
    dueDate: { type: String, default: '01/11' },
});

const percentage = computed(() => {
    if (props.limitAmount === 0) return 0;
    return Math.min((props.currentAmount / props.limitAmount) * 100, 100);
});

const formatMoney = (val) => {
    return new Intl.NumberFormat('pt-BR', { minimumFractionDigits: 2 }).format(val);
}
</script>

<template>
    <!--
        Ajustes de Responsividade:
        1. Removido 'w-126' (largura fixa).
        2. Adicionado 'w-full' para ocupar a largura do grid/container pai.
        3. 'min-w-[280px]' ou similar implícito para evitar que quebre muito em telas minúsculas.
        4. Ajuste de padding: 'p-5 sm:p-6' (um pouco mais compacto no mobile).
    -->
    <div class="bg-slate-700/20 border border-slate-600 rounded-xl p-5 sm:p-6 shadow-lg h-full flex flex-col justify-between relative overflow-hidden group w-full">

        <!-- Efeito de fundo -->
        <div class="absolute top-0 right-0 -mt-4 -mr-4 w-24 h-24 bg-blue-500/10 rounded-full blur-2xl group-hover:bg-blue-500/20 transition-all duration-500"></div>

        <div>
            <!-- Cabeçalho: Flex column no mobile, row no desktop se precisar, mas aqui row funciona bem -->
            <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center mb-4 gap-3 sm:gap-0">
                <div class="flex items-center gap-3">
                    <div class="p-2 bg-slate-800/50 rounded-lg border border-slate-600/50 backdrop-blur-sm">
                         <i class="pi pi-credit-card text-blue-400 text-xl"></i>
                    </div>
                    <h3 class="text-lg font-semibold text-white tracking-wide">{{ name }}</h3>
                </div>
                <!-- Valor: Texto menor no mobile -->
                <span class="text-xs font-medium px-2 py-1 rounded-md bg-slate-800 text-slate-300 border border-slate-600 whitespace-nowrap">
                    R$ {{ formatMoney(currentAmount) }} / {{ formatMoney(limitAmount) }}
                </span>
            </div>

            <!-- Barra de Progresso -->
            <div class="relative w-full h-2 bg-slate-700 rounded-full mt-2 mb-6 overflow-hidden">
                <div
                    class="absolute top-0 left-0 h-full bg-blue-500 rounded-full transition-all duration-1000 ease-out shadow-[0_0_8px_rgba(59,130,246,0.6)]"
                    :style="{ width: `${percentage}%` }"
                ></div>
            </div>

            <!-- Datas: Grid funciona bem, texto ajustado -->
            <div class="grid grid-cols-2 gap-4 mb-2 bg-slate-800/30 p-3 rounded-lg border border-slate-700/50">
                <div class="flex flex-col">
                    <span class="text-[10px] text-slate-400 uppercase tracking-wider font-semibold mb-1">Fechamento</span>
                    <div class="flex items-center gap-2 text-amber-300 font-bold text-base sm:text-lg">
                        <i class="pi pi-calendar text-sm opacity-70"></i>
                        <span>{{ closingDate }}</span>
                    </div>
                </div>

                <div class="flex flex-col items-end">
                    <span class="text-[10px] text-slate-400 uppercase tracking-wider font-semibold mb-1">Vencimento</span>
                    <div class="flex items-center gap-2 text-amber-500 font-bold text-base sm:text-lg">
                        <span>{{ dueDate }}</span>
                        <i class="pi pi-exclamation-circle text-sm opacity-70"></i>
                    </div>
                </div>
            </div>
        </div>

        <!-- Footer -->
        <div class="mt-4 pt-4 text-center border-t border-slate-700/50">
            <Link href="#" class="text-sm font-medium text-emerald-400 hover:text-emerald-300 transition-colors flex items-center justify-center gap-2 group-hover:gap-3 duration-300">
                Ver gastos
                <i class="pi pi-arrow-right text-xs"></i>
            </Link>
        </div>
    </div>
</template>

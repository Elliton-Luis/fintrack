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

// Porcentagem da barra
const percentage = computed(() => {
    if (props.limitAmount === 0) return 0;
    return Math.min((props.currentAmount / props.limitAmount) * 100, 100);
});

// Formatação de moeda (R$)
const formatMoney = (val) => {
    return new Intl.NumberFormat('pt-BR', { minimumFractionDigits: 2 }).format(val);
}
</script>

<template>
    <div class="bg-slate-700/20 border border-slate-600 rounded-xl p-6 shadow-lg h-full flex flex-col justify-between relative overflow-hidden group w-126">

        <div class="absolute top-0 right-0 -mt-4 -mr-4 w-24 h-24 bg-blue-500/10 rounded-full blur-2xl group-hover:bg-blue-500/20 transition-all duration-500"></div>

        <div>
            <div class="flex justify-between items-center mb-2">
                <div class="flex items-center gap-2">
                    <i class="pi pi-credit-card text-blue-400 text-xl"></i>
                    <h3 class="text-lg font-semibold text-white tracking-wide">{{ name }}</h3>
                </div>
                <span class="text-xs font-medium px-2 py-1 rounded-md bg-slate-800 text-slate-300 border border-slate-600">
                    R$ {{ formatMoney(currentAmount) }} / {{ formatMoney(limitAmount) }}
                </span>
            </div>

            <div class="relative w-full h-2 bg-slate-700 rounded-full mt-3 mb-6 overflow-hidden">
                <div
                    class="absolute top-0 left-0 h-full bg-blue-500 rounded-full transition-all duration-1000 ease-out shadow-[0_0_8px_rgba(59,130,246,0.6)]"
                    :style="{ width: `${percentage}%` }"
                ></div>
            </div>

            <div class="grid grid-cols-2 gap-4 mb-4">
                <div class="flex flex-col">
                    <span class="text-xs text-slate-400 uppercase tracking-wider font-semibold mb-1">Fechamento</span>
                    <div class="flex items-center gap-2 text-amber-300 font-bold text-lg"> <i class="pi pi-calendar text-sm opacity-70"></i>
                        <span>{{ closingDate }}</span>
                    </div>
                </div>

                <div class="flex flex-col items-end">
                    <span class="text-xs text-slate-400 uppercase tracking-wider font-semibold mb-1">Vencimento</span>
                    <div class="flex items-center gap-2 text-amber-500 font-bold text-lg"> <span>{{ dueDate }}</span>
                        <i class="pi pi-exclamation-circle text-sm opacity-70"></i>
                    </div>
                </div>
            </div>
        </div>

        <div class="mt-2 pt-4 text-center border-t border-slate-700">
            <Link href="#" class="text-sm font-medium text-emerald-400 hover:text-emerald-300 transition-colors flex items-center justify-center gap-2">
                Ver gastos
                <i class="pi pi-arrow-right text-xs"></i>
            </Link>
        </div>
    </div>
</template>


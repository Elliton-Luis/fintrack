<template>
    <div
        class="w-full bg-slate-700/20 backdrop-blur-md border border-slate-600 rounded-2xl shadow-[0_0_30px_-5px_rgba(255,255,255,0.08)] p-5 flex flex-col h-full">

        <h3 class="text-lg font-bold text-white mb-4">Contas a Vencer</h3>

        <div class="flex-1 overflow-y-auto custom-scrollbar">
            <ul class="divide-y divide-slate-700/50">
                <li v-for="bill in bills.slice(0, 3)" :key="bill.id"
                    class="py-3 flex items-center justify-between group">

                    <div class="flex items-center gap-4">
                        <div
                            class="flex flex-col items-center justify-center w-10 h-10 rounded-lg bg-slate-800/40 border border-slate-700/50 text-slate-300 flex-shrink-0">
                            <span class="text-[10px] uppercase font-bold text-slate-400">
                                {{ getDayMonth(bill.date).month }}
                            </span>
                            <span class="text-sm font-bold text-white leading-none">
                                {{ getDayMonth(bill.date).day }}
                            </span>
                        </div>

                        <div class="flex flex-col items-start gap-1">
                            <span class="font-medium text-slate-200 leading-tight">{{ bill.title }}</span>

                            <span
                                :class="[
                                    'text-[11px] px-1.5 py-0.5 rounded border border-opacity-30 font-bold uppercase tracking-wide whitespace-nowrap',
                                    getTimeStatus(bill.date).color
                                ]"
                            >
                                {{ getTimeStatus(bill.date).text }}
                            </span>
                        </div>
                    </div>

                    <div class="flex items-center gap-4">
                        <span class="text-sm font-bold text-white tracking-wide">{{ formatMoney(bill.amount) }}</span>

                        <button title="Marcar como pago"
                            class="w-8 h-8 rounded-full flex items-center justify-center border border-slate-600/50 text-slate-400 hover:text-white hover:bg-emerald-500 hover:border-emerald-500 transition-all duration-300 group-hover:border-slate-500">
                            <i class="pi pi-check text-xs"></i>
                        </button>
                    </div>
                </li>
            </ul>

            <div v-if="bills.length === 0"
                class="h-full flex flex-col items-center justify-center text-slate-500 py-6 text-sm">
                <i class="pi pi-check-circle text-2xl mb-0 opacity-30 text-emerald-500"></i>
                <span>Tudo pago!</span>
            </div>
        </div>

        <div class="mt-2 pt-4 text-center border-t border-slate-700/50">
            <a href="/bills"
                class="text-sm font-medium text-emerald-400 hover:text-emerald-300 transition-colors inline-flex items-center gap-2 group">
                Ver todas
                <i class="pi pi-arrow-right text-xs transition-transform group-hover:translate-x-1"></i>
            </a>
        </div>
    </div>
</template>

<script setup>
const props = defineProps({
    bills: {
        type: Array,
        default: () => []
    }
});

const formatMoney = (val) => new Intl.NumberFormat('pt-BR', { style: 'currency', currency: 'BRL' }).format(val);

const getDayMonth = (dateStr) => {
    const date = new Date(dateStr.includes('T') ? dateStr : dateStr + 'T12:00:00');
    return {
        day: date.getDate(),
        month: date.toLocaleString('pt-BR', { month: 'short' }).replace('.', '')
    };
};

const getTimeStatus = (dateStr) => {
    const today = new Date();
    today.setHours(0, 0, 0, 0);

    const billDate = new Date(dateStr.includes('T') ? dateStr : dateStr + 'T12:00:00');
    billDate.setHours(0, 0, 0, 0);

    const diffTime = billDate - today;
    const diffDays = Math.ceil(diffTime / (1000 * 60 * 60 * 24));

    switch (true) {
        case diffDays < 0:
            return {
                text: 'Vencida',
                color: 'bg-red-600/10 text-red-500 border-red-600/30'
            };

        case diffDays === 0:
            return {
                text: 'Vence Hoje',
                color: 'bg-rose-500/10 text-rose-400 border-rose-500/30'
            };

        case diffDays === 1:
            return {
                text: 'Amanhã',
                color: 'bg-orange-500/10 text-orange-400 border-orange-500/30'
            };

        case diffDays === 2:
            return {
                text: `Em ${diffDays} dias`,
                color: 'bg-amber-500/10 text-amber-400 border-amber-500/30'
            };

        case diffDays === 3:
            return {
                text: `Em ${diffDays} dias`,
                color: 'bg-yellow-500/10 text-yellow-400 border-yellow-500/30'
            };

        case diffDays === 4:
            return {
                text: `Em ${diffDays} dias`,
                color: 'bg-lime-500/10 text-lime-400 border-lime-500/30'
            };

        case diffDays <= 9:
            return {
                text: `Em ${diffDays} dias`,
                color: 'bg-emerald-500/10 text-emerald-400 border-emerald-500/30'
            };

        default:
            return {
                text: `Em ${diffDays} dias`,
                color: 'bg-purple-500/10 text-purple-400 border-purple-500/30'
            };
    }
};
</script>

<style scoped>
.custom-scrollbar::-webkit-scrollbar {
    width: 4px;
}

.custom-scrollbar::-webkit-scrollbar-track {
    background: transparent;
}

.custom-scrollbar::-webkit-scrollbar-thumb {
    background: #334155;
    border-radius: 4px;
}
</style>

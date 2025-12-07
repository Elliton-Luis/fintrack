<template>
    <div class="bg-slate-700/20 border border-slate-600 rounded-2xl p-6 shadow-lg flex flex-col h-full">
        <h3 class="text-lg font-semibold text-white mb-2">Últimas Transações</h3>

        <ul v-if="props.transactions && props.transactions.length > 0" class="divide-y divide-slate-700 flex-1">
            <li v-for="t in props.transactions" :key="t.id" class="py-4 flex items-center justify-between">
                <div class="flex items-center gap-3 overflow-hidden">
                    <div
                        class="flex flex-col items-center justify-center w-10 h-10 rounded-lg bg-slate-800/40 border border-slate-700/50 text-slate-300 flex-shrink-0">
                        <span class="text-[9px] uppercase font-bold text-slate-400">
                            {{ getDayMonth(t.transaction_date).month }}
                        </span>
                        <span class="text-sm font-bold text-white leading-none">
                            {{ getDayMonth(t.transaction_date).day }}
                        </span>
                    </div>

                    <div v-if="t.category && t.category.icon" class="flex-shrink-0">
                        <i :class="['pi', t.category.icon.class, 'text-xl text-slate-400']"></i>
                    </div>
                    <div v-else class="flex-shrink-0">
                        <i class="pi pi-tag text-xl text-slate-500"></i>
                    </div>

                    <div class="flex flex-col min-w-0 gap-1">
                        <span class="text-stone-300 font-medium truncate leading-tight">
                            {{ t.title }}
                        </span>

                        <span v-if="t.category"
                            :class="[
                                'text-[12px] px-1.5 py-0.5 rounded border font-bold uppercase tracking-wide whitespace-nowrap w-fit',
                                getCategoryColor(t.category.name)
                            ]">
                            {{ t.category.name }}
                        </span>
                    </div>
                </div>

                <span :class="t.type === 'income' ? 'text-emerald-400' : 'text-red-400'"
                    class="font-semibold whitespace-nowrap ml-4 text-sm">
                    {{ t.type === 'income' ? '+' : '-' }} {{ formatMoney(t.amount) }}
                </span>
            </li>
        </ul>

        <div v-else class="flex-1 flex flex-col items-center justify-center text-slate-400 animate-pulse">
            <i class="pi pi-inbox text-4xl mb-2 opacity-50"></i>
            <span class="text-sm font-medium">Nenhuma transação encontrada nesse mês</span>
        </div>

        <div class="mt-auto pt-4 text-center border-t border-slate-700">
            <a href="/transactions"
                :class="{ 'opacity-50 pointer-events-none': !props.transactions || props.transactions.length === 0 }"
                class="inline-flex items-center gap-2 text-sm font-medium text-emerald-400 hover:text-emerald-300 transition-colors group">
                Ver Todas
                <i class="pi pi-arrow-right text-xs transition-transform group-hover:translate-x-1"></i>
            </a>
        </div>
    </div>
</template>

<script setup>
const props = defineProps({
    categories: Array,
    transactions: {
        type: Array,
        default: () => []
    }
})

const formatMoney = (value) => {
    return new Intl.NumberFormat('pt-BR', {
        style: 'currency',
        currency: 'BRL'
    }).format(value);
}

const getDayMonth = (dateStr) => {
    if (!dateStr) return { day: '--', month: '---' };
    const date = new Date(dateStr.includes('T') ? dateStr : dateStr + 'T12:00:00');
    return {
        day: date.getDate(),
        month: date.toLocaleString('pt-BR', { month: 'short' }).replace('.', '')
    };
};

const categoryColors = [
    'bg-blue-500/10 text-blue-400 border-blue-500/30',
    'bg-pink-500/10 text-pink-400 border-pink-500/30',
    'bg-emerald-500/10 text-emerald-400 border-emerald-500/30',
    'bg-amber-500/10 text-amber-400 border-amber-500/30',
    'bg-violet-500/10 text-violet-400 border-violet-500/30',
    'bg-cyan-500/10 text-cyan-400 border-cyan-500/30',
    'bg-rose-500/10 text-rose-400 border-rose-500/30',
    'bg-lime-500/10 text-lime-400 border-lime-500/30',
    'bg-fuchsia-500/10 text-fuchsia-400 border-fuchsia-500/30',
    'bg-indigo-500/10 text-indigo-400 border-indigo-500/30',
    'bg-orange-500/10 text-orange-400 border-orange-500/30',
    'bg-teal-500/10 text-teal-400 border-teal-500/30'
];

const getCategoryColor = (name) => {
    if (!name) return categoryColors[0];

    let hash = 0;
    for (let i = 0; i < name.length; i++) {
        hash = name.charCodeAt(i) + ((hash << 5) - hash);
    }

    const index = Math.abs(hash) % categoryColors.length;

    return categoryColors[index];
};
</script>

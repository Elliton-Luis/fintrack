<template>
    <div class="bg-slate-700/20 border border-slate-600 rounded-xl p-6 shadow-lg">
        <h3 class="text-lg font-semibold text-white mb-4">Últimas Transações</h3>

        <ul class="divide-y divide-slate-700">
            <li v-for="t in props.transactions" :key="t.id" class="py-4 flex items-center justify-between">

                <div class="flex items-center space-x-3">

                    <i v-if="t.category && t.category.icon" :class="['pi', t.category.icon.class, 'text-xl']"></i>
                    <span>{{ t.title }}</span>
                </div>

                <span :class="t.type === 'income' ? 'text-green-400' : 'text-red-400'">
                    {{ t.type === 'income' ? '+' : '-' }} R$ {{ t.amount }}
                </span>

            </li>
        </ul>
        <div class="mt-6 pt-4 text-center border-t border-slate-700">
            <a href="/transactions" class="btn text-sm font-medium text-emerald-400 hover:text-emerald-300 transition-colors">
                Ver Todas
            </a>
        </div>
    </div>
</template>

<script setup>
const props = defineProps({
    categories: Array,
    transactions: Array
})
</script>

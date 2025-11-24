<template>
    <form @submit.prevent="submit" class="flex flex-col gap-6 h-130">

        <h3 class="text-2xl font-bold text-white mb-8 text-center">Criar Categoria</h3>
        <div class="flex justify-center gap-1 p-1 bg-slate-950/60 border border-slate-800 rounded-xl w-full shadow-sm">
            <label class="relative flex-1 flex items-center justify-center cursor-pointer group px-4 py-2.5 rounded-lg transition-all duration-300"
                :class="form.type === 'income' ? 'bg-emerald-500/10 shadow-[inset_0_0_10px_rgba(16,185,129,0.1)]' : 'hover:bg-slate-900/50'">
                <input type="radio" v-model="form.type" value="income" class="sr-only peer" />
                <div class="w-2.5 h-2.5 rounded-full border-2 border-slate-500 peer-checked:bg-emerald-400 peer-checked:border-emerald-400 transition-all scale-90 peer-checked:scale-110 peer-checked:shadow-emerald-500/50 peer-checked:shadow-sm"></div>
                <span class="ml-2 font-medium text-slate-400 peer-checked:text-emerald-300 transition-colors text-sm">Receita</span>
            </label>

            <label class="relative flex-1 flex items-center justify-center cursor-pointer group px-4 py-2.5 rounded-lg transition-all duration-300"
                :class="form.type === 'expense' ? 'bg-red-500/10 shadow-[inset_0_0_10px_rgba(239,68,68,0.1)]' : 'hover:bg-slate-900/50'">
                <input type="radio" v-model="form.type" value="expense" class="sr-only peer" />
                <div class="w-2.5 h-2.5 rounded-full border-2 border-slate-500 peer-checked:bg-red-400 peer-checked:border-red-400 transition-all scale-90 peer-checked:scale-110 peer-checked:shadow-red-500/50 peer-checked:shadow-sm"></div>
                <span class="ml-2 font-medium text-slate-400 peer-checked:text-red-300 transition-colors text-sm">Despesa</span>
            </label>
        </div>

        <div>
            <IconPicker
                label="Ícone"
                v-model="form.icon_id"
                :options="icons"
            />
            <div v-if="form.errors.icon_id" class="text-red-400 text-xs mt-2 pl-1 font-medium">{{ form.errors.icon_id }}</div>
        </div>

        <div>
            <label class="block text-sm font-medium text-slate-300 mb-2 pl-1">Nome</label>
            <input v-model="form.name" type="text"
                class="block w-full bg-slate-950/50 border border-slate-800 rounded-xl py-3 px-4 text-slate-100 placeholder-slate-500 shadow-sm focus:ring-2 focus:ring-blue-500/40 focus:border-blue-500 hover:border-slate-700 outline-none transition-all duration-200"
                placeholder="Ex: Assinaturas, Mercado..." required />
            <div v-if="form.errors.name" class="text-red-400 text-xs mt-2 pl-1 font-medium">{{ form.errors.name }}</div>
        </div>

        <div class="pt-10">
            <button type="submit" :disabled="form.processing"
                class="w-full bg-gradient-to-r from-blue-600 via-blue-700 to-blue-600 hover:from-blue-500 hover:to-blue-500 text-white font-bold py-3 px-4 rounded-xl shadow-lg shadow-blue-900/20 hover:shadow-blue-600/30 transition-all duration-200 transform active:scale-[0.99] flex justify-center items-center gap-2 disabled:opacity-70 disabled:cursor-not-allowed">
                <i v-if="form.processing" class="pi pi-spinner pi-spin"></i>
                <span v-else>Criar Categoria</span>
            </button>
        </div>
    </form>
</template>

<script setup>
import { useForm } from '@inertiajs/vue3';
import IconPicker from '../components/IconPicker.vue';

const emit = defineEmits(['success']);

const props = defineProps({
    icons: {
        type: Array,
        default: () => []
    }
})

const form = useForm({
    name: '',
    type: 'expense',
    icon_id: null,
});

const submit = () => {
    form.post(route('categories.store'), {
        preserveScroll: true,
        onSuccess: (page) => {
            const newCategoryData = page.props.flash?.newCategory || {
                id: Date.now(),
                name: form.name,
                type: form.type,
                icon_id: form.icon_id
            };

            emit('success', newCategoryData);
            form.reset();
        },
    });
};
</script>

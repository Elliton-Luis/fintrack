<template>
    <form @submit.prevent="submit" class="flex flex-col gap-5">

        <div>
            <label class="block text-sm font-medium text-slate-300 mb-1">Nome</label>
            <input
                v-model="form.name"
                type="text"
                class="w-full bg-slate-950/50 border border-slate-700/80 rounded-lg px-4 py-2.5 text-slate-100 placeholder-slate-500 focus:border-blue-500 focus:ring-1 focus:ring-blue-500 outline-none transition-all"
                placeholder="Ex: Assinaturas, Mercado..."
                required
            />
            <div v-if="form.errors.name" class="text-red-400 text-xs mt-1">{{ form.errors.name }}</div>
        </div>

        <div>
            <label class="block text-sm font-medium text-slate-300 mb-2">Tipo</label>
            <div class="flex gap-4">
                <label class="flex items-center gap-2 cursor-pointer">
                    <input type="radio" v-model="form.type" value="income" class="accent-emerald-500 w-4 h-4 bg-slate-900 border-slate-600" />
                    <span class="text-slate-300 text-sm">Receita</span>
                </label>
                <label class="flex items-center gap-2 cursor-pointer">
                    <input type="radio" v-model="form.type" value="expense" class="accent-red-500 w-4 h-4 bg-slate-900 border-slate-600" />
                    <span class="text-slate-300 text-sm">Despesa</span>
                </label>
            </div>
        </div>

        <div class="flex justify-end pt-2">
            <button
                type="submit"
                :disabled="form.processing"
                class="bg-blue-600 hover:bg-blue-500 text-white font-medium py-2 px-6 rounded-lg shadow-lg shadow-blue-900/20 transition-colors flex items-center gap-2"
            >
                <span v-if="form.processing">Salvando...</span>
                <span v-else>Criar Categoria</span>
            </button>
        </div>
    </form>
</template>

<script setup>
import { useForm } from '@inertiajs/vue3';

const emit = defineEmits(['success']);

const form = useForm({
    name: '',
    type: 'expense',
    icon_id: 1,
});

const submit = () => {
    form.post(route('categories.store'), {
        preserveScroll: true,
        onSuccess: (page) => {

            const newCategoryData = page.props.flash?.newCategory || {
                id: Date.now(),
                name: form.name,
                type: form.type
            };

            emit('success', newCategoryData);

            form.reset();
        },
    });
};
</script>

<template>
    <div class="relative group">
        <label v-if="label" class="block text-sm font-medium text-slate-300 mb-1">
            {{ label }}
        </label>

        <button type="button" @click="toggleDropdown"
            class="relative w-full flex items-center gap-3 bg-slate-950/50 border border-slate-700/80 rounded-lg px-4 py-2.5 text-left transition-all hover:border-slate-600 focus:outline-none focus:ring-2 focus:ring-blue-500/50"
            :class="{ 'ring-2 ring-blue-500/50 border-blue-500': isOpen }">
            <div
                class="flex items-center justify-center w-8 h-8 rounded bg-slate-800 text-blue-400 border border-slate-700 shadow-sm">
                <i :class="selectedIcon ? `pi ${selectedIcon.class}` : 'pi pi-box'" class="text-lg"></i>
            </div>

            <span class="flex-1 text-slate-200 text-sm truncate">
                {{ selectedIcon ? selectedIcon.name : 'Selecione um ícone...' }}
            </span>

            <i class="pi pi-chevron-down text-xs text-slate-500 transition-transform duration-200"
                :class="{ 'rotate-180': isOpen }"></i>
        </button>

        <div v-if="isOpen"
            class="absolute z-50 mt-2 w-full bg-slate-900 border border-slate-700 rounded-xl shadow-2xl shadow-black/50 overflow-hidden flex flex-col max-h-[18rem]">

            <div class="p-2 border-b border-slate-800 bg-slate-900 sticky top-0 z-10">
                <div class="relative">
                    <i class="pi pi-search absolute left-3 top-1/2 -translate-y-1/2 text-slate-500 text-xs"></i>
                    <input ref="searchInput" v-model="search" type="text" placeholder="Buscar ícone..."
                        class="w-full bg-slate-800 border border-slate-700 text-slate-200 text-sm rounded-lg pl-8 pr-3 py-2 focus:outline-none focus:border-blue-500 focus:bg-slate-800/80 placeholder-slate-500">
                </div>
            </div>

            <div class="overflow-y-auto p-2 custom-scrollbar flex-1">

                <div v-if="filteredOptions.length === 0" class="text-center py-6 text-slate-500 text-sm">
                    <i class="pi pi-ban mb-2 block text-lg"></i>
                    Nenhum ícone encontrado
                </div>

                <div v-else class="grid grid-cols-5 gap-2">
                    <button v-for="icon in filteredOptions" :key="icon.id" type="button" @click="selectIcon(icon)"
                        :title="icon.name"
                        class="flex flex-col items-center justify-center p-2 rounded-lg transition-all duration-200 group hover:bg-slate-800 border border-transparent"
                        :class="modelValue === icon.id ? 'bg-blue-600/10 border-blue-500/50' : 'hover:border-slate-700'">
                        <i class="text-xl mb-1 transition-colors" :class="[
                            `pi ${icon.class}`,
                            modelValue === icon.id ? 'text-blue-400' : 'text-slate-400 group-hover:text-slate-200'
                        ]">
                        </i>
                    </button>
                </div>
            </div>

            <div class="px-3 py-1.5 bg-slate-950/50 border-t border-slate-800 text-[10px] text-slate-500 text-center">
                {{ filteredOptions.length }} opções disponíveis
            </div>
        </div>

        <div v-if="isOpen" @click="close" class="fixed inset-0 z-40 bg-transparent cursor-default"></div>
    </div>
</template>

<script setup>
import { ref, computed, nextTick } from 'vue';

const props = defineProps({
    modelValue: [Number, String], // O ID do ícone
    options: {                    // A lista completa vinda do banco
        type: Array,
        default: () => []
    },
    label: {
        type: String,
        default: 'Ícone'
    }
});

const emit = defineEmits(['update:modelValue']);

const isOpen = ref(false);
const search = ref('');
const searchInput = ref(null);

// Encontra o objeto completo do ícone baseado no ID selecionado
const selectedIcon = computed(() => {
    return props.options.find(opt => opt.id === props.modelValue);
});

// Filtra a lista baseada na busca
const filteredOptions = computed(() => {
    if (!search.value) return props.options;
    const term = search.value.toLowerCase();
    return props.options.filter(opt =>
        opt.name.toLowerCase().includes(term) ||
        opt.class.toLowerCase().includes(term)
    );
});

const toggleDropdown = () => {
    isOpen.value = !isOpen.value;
    if (isOpen.value) {
        nextTick(() => {
            searchInput.value?.focus();
        });
    } else {
        search.value = '';
    }
};

const close = () => {
    isOpen.value = false;
    search.value = '';
};

const selectIcon = (icon) => {
    emit('update:modelValue', icon.id); // Emite o ID para o form
    close();
};
</script>

<style scoped>
/* Scrollbar escura e fina */
.custom-scrollbar::-webkit-scrollbar {
    width: 6px;
}

.custom-scrollbar::-webkit-scrollbar-track {
    background: #0f172a;
    /* Slate 900 */
}

.custom-scrollbar::-webkit-scrollbar-thumb {
    background: #334155;
    /* Slate 700 */
    border-radius: 10px;
}

.custom-scrollbar::-webkit-scrollbar-thumb:hover {
    background: #475569;
    /* Slate 600 */
}
</style>

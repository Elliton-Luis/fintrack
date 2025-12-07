<template>
    <div class="relative">
        <button type="button" @click="toggle"
            class="relative w-full flex items-center gap-3 bg-slate-950/30 border border-slate-600 rounded-md py-2 pl-3 pr-10 text-left transition-all focus:outline-none focus:ring-1 focus:ring-blue-500 focus:border-blue-500 h-[42px]"
            :class="{ 'ring-1 ring-blue-500 border-blue-500': isOpen }">
            <template v-if="selectedOption">
                <i :class="[getIconClass(selectedOption), 'text-lg text-blue-400 shrink-0']"></i>
                <span class="block truncate text-slate-100">{{ selectedOption.name }}</span>
            </template>

            <span v-else class="text-slate-500 block truncate">{{ placeholder }}</span>

            <span class="absolute inset-y-0 right-0 flex items-center pr-2 pointer-events-none">
                <i class="pi pi-chevron-down text-xs text-slate-400 transition-transform duration-200"
                    :class="{ 'rotate-180': isOpen }"></i>
            </span>
        </button>

        <div v-if="isOpen"
            class="absolute z-50 mt-1 w-full bg-slate-800 border border-slate-700 rounded-md shadow-xl shadow-black/50 max-h-60 overflow-y-auto custom-scrollbar focus:outline-none">
            <ul class="py-1">
                <li v-if="options.length === 0" class="px-3 py-3 text-sm text-slate-500 text-center">
                    Nenhuma categoria disponível.
                </li>

                <li v-for="category in options" :key="category.id" @click="select(category)"
                    class="cursor-pointer select-none relative py-2.5 pl-3 pr-4 hover:bg-slate-700 transition-colors flex items-center gap-3 border-b border-slate-700/50 last:border-0"
                    :class="modelValue === category.id ? 'bg-slate-700/80' : ''">
                    <i :class="[
                        getIconClass(category),
                        'text-lg shrink-0 transition-colors',
                        modelValue === category.id ? 'text-blue-400' : 'text-slate-500 group-hover:text-slate-300'
                    ]"></i>

                    <span class="block truncate text-sm flex-1"
                        :class="modelValue === category.id ? 'font-medium text-white' : 'text-slate-300'">
                        {{ category.name }}
                    </span>

                    <i v-if="modelValue === category.id" class="pi pi-check text-xs text-emerald-500"></i>
                </li>
            </ul>
        </div>

        <div v-if="isOpen" @click="isOpen = false" class="fixed inset-0 z-40 bg-transparent cursor-default"></div>
    </div>
</template>

<script setup>
import { ref, computed } from 'vue';

const props = defineProps({
    modelValue: [Number, String],
    options: { type: Array, default: () => [] },
    placeholder: { type: String, default: 'Selecione...' }
});

const emit = defineEmits(['update:modelValue']);
const isOpen = ref(false);

const selectedOption = computed(() => {
    return props.options.find(opt => opt.id === props.modelValue);
});

const toggle = () => isOpen.value = !isOpen.value;

const select = (option) => {
    emit('update:modelValue', option.id);
    isOpen.value = false;
};


const getIconClass = (category) => {
    if (!category) return 'pi pi-tag';


    if (category.icon && category.icon.class) {

        return category.icon.class.startsWith('pi ') ? category.icon.class : `pi ${category.icon.class}`;
    }

    if (category.icon_class) {
        return `pi ${category.icon_class}`;
    }

    return 'pi pi-tag';
}
</script>

<style scoped>
.custom-scrollbar::-webkit-scrollbar {
    width: 5px;
}

.custom-scrollbar::-webkit-scrollbar-track {
    background: #1e293b;
}

.custom-scrollbar::-webkit-scrollbar-thumb {
    background: #475569;
    border-radius: 4px;
}
</style>

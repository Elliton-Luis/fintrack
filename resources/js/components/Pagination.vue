<script setup>
import { Link } from '@inertiajs/vue3';

defineProps({
    links: {
        type: Array,
        required: true,
    },
});

const getLabel = (label) => {
    if (label.includes('Previous')) return 'Anterior';
    if (label.includes('Next')) return 'Próximo';
    return label;
}

const getClassName = (label, active) => {
    const baseClasses = "mb-1 mr-1 px-4 py-2 text-sm leading-4 border rounded-lg transition-colors";

    const colorClasses = active
        ? 'bg-blue-600 text-white border-blue-600'
        : 'text-slate-300 border-slate-700 hover:bg-slate-800 focus:text-blue-500 focus:border-blue-500';

    const isNavButton = label.includes('Previous') || label.includes('Next');
    const visibilityClasses = isNavButton
        ? 'inline-flex'
        : 'hidden md:inline-flex';

    return `${baseClasses} ${colorClasses} ${visibilityClasses}`;
}
</script>

<template>
    <div v-if="links.length > 3">
        <div class="flex flex-wrap -mb-1 justify-center gap-1">
            <template v-for="(link, key) in links">

                <div v-if="link.url === null"
                     :key="key"
                     class="mb-1 mr-1 px-4 py-2 text-sm leading-4 text-slate-600 border border-slate-800 rounded-lg cursor-not-allowed opacity-50 select-none"
                     :class="link.label.includes('Previous') || link.label.includes('Next') ? 'inline-flex' : 'hidden md:inline-flex'"
                     v-html="getLabel(link.label)"
                />

                <Link v-else
                      :key="`link-${key}`"
                      :class="getClassName(link.label, link.active)"
                      :href="link.url"
                      v-html="getLabel(link.label)"
                />
            </template>
        </div>
    </div>
</template>

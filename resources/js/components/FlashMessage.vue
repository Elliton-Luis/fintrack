<template>
    <Teleport to="body">
        <transition
            enter-active-class="transform ease-out duration-300 transition"
            enter-from-class="translate-y-2 opacity-0 sm:translate-y-0 sm:translate-x-2"
            enter-to-class="translate-y-0 opacity-100 sm:translate-x-0"
            leave-active-class="transition ease-in duration-100"
            leave-from-class="opacity-100"
            leave-to-class="opacity-0">

            <div v-if="show"
                class="fixed bottom-5 right-5 z-[9999] w-full max-w-sm border px-4 py-4 rounded-xl shadow-2xl flex items-center gap-4"
                :class="currentStyle.container">

                <div class="w-6 h-6 shrink-0" :class="currentStyle.iconColor">
                    <svg v-if="type === 'success'" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                        stroke-width="2" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M9 12.75L11.25 15 15 9.75M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                    <svg v-if="type === 'error'" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                        stroke-width="2" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M12 9v3.75m9-.75a9 9 0 11-18 0 9 9 0 0118 0zm-9 3.75h.008v.008H12v-.008z" />
                    </svg>
                </div>

                <div class="flex-1">
                    <p class="text-sm font-semibold text-white">
                        {{ type === 'success' ? 'Sucesso!' : 'Atenção' }}
                    </p>
                    <p class="text-sm font-medium opacity-90" :class="currentStyle.text">
                        {{ message }}
                    </p>
                </div>

                <button @click="show = false" class="ml-auto text-slate-400 hover:text-white transition-colors">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="w-5 h-5">
                        <path
                            d="M6.28 5.22a.75.75 0 00-1.06 1.06L8.94 10l-3.72 3.72a.75.75 0 101.06 1.06L10 11.06l3.72 3.72a.75.75 0 101.06-1.06L11.06 10l3.72-3.72a.75.75 0 00-1.06-1.06L10 8.94 6.28 5.22z" />
                    </svg>
                </button>
            </div>
        </transition>
    </Teleport>
</template>

<script setup>
import { ref, computed, watch } from 'vue';
import { usePage } from '@inertiajs/vue3';

const page = usePage();
const show = ref(false);
const message = ref('');
const type = ref('success');

const styles = {
    success: {
        container: 'bg-slate-900 border-emerald-500 shadow-emerald-900/20',
        text: 'text-slate-300',
        iconColor: 'text-emerald-400',
    },
    error: {
        container: 'bg-slate-900 border-red-500 shadow-red-900/20',
        text: 'text-slate-300',
        iconColor: 'text-red-400',
    }
};

const currentStyle = computed(() => styles[type.value]);
let timeout = null;

watch(() => page.props.flash, (newFlash) => {
    show.value = false;
    clearTimeout(timeout);

    if (newFlash?.success) {
        type.value = 'success';
        message.value = newFlash.success;
        show.value = true;
    } else if (newFlash?.error) {
        type.value = 'error';
        message.value = newFlash.error;
        show.value = true;
    }

    if (show.value) {
        timeout = setTimeout(() => {
            show.value = false;
        }, 4000);
    }
}, { deep: true, immediate: true });
</script>

<template>
    <Transition name="modal-transition">
        <div v-if="modelValue" @click="closeModal"
            class="fixed inset-0 z-50 flex items-center justify-center p-4 bg-slate-950/60 backdrop-blur-[10px]">

            <div @click.stop class="modal-card w-full max-w-md flex flex-col overflow-hidden relative
                bg-slate-900/85 backdrop-blur-xl
                border border-white/10 shadow-2xl shadow-black/50
                rounded-xl text-slate-100 ring-1 ring-white/5">

                <div class="flex items-center justify-between px-6 py-4 border-b border-white/5 bg-white/[0.02]">
                    <slot name="header">
                        <h3 class="text-lg font-medium text-slate-100 tracking-wide">
                            {{ title }}
                        </h3>
                    </slot>

                    <button @click="closeModal"
                        class="text-slate-400 hover:text-white hover:bg-white/10 p-1.5 rounded-lg transition-colors duration-200">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M6 18L18 6M6 6l12 12"></path>
                        </svg>
                    </button>
                </div>

                <div v-if="flash?.success" class="mx-6 mt-6 p-3 bg-emerald-500/10 border border-emerald-500/20 text-emerald-400 rounded text-sm">
                    {{ flash.success }}
                </div>

                <div class="p-6">
                    <slot />
                </div>

                <div v-if="$slots.footer" class="flex justify-end gap-3 px-6 py-4 border-t border-white/5 bg-slate-950/30">
                    <slot name="footer" />
                </div>
            </div>
        </div>
    </Transition>
</template>

<script setup>
import { watchEffect, onUnmounted } from 'vue';

const props = defineProps({
    modelValue: {
        type: Boolean,
        default: false,
    },
    title: {
        type: String,
        default: '',
    },
    flash: {
        type: Object,
        default: () => ({})
    }
});

const emit = defineEmits(['update:modelValue']);

const closeModal = () => {
    emit('update:modelValue', false);
};

const handleKeydown = (e) => {
    if (e.key === 'Escape') {
        closeModal();
    }
};

watchEffect(() => {
    if (props.modelValue) {
        document.body.style.overflow = 'hidden'; // Evita scroll no fundo
        window.addEventListener('keydown', handleKeydown);
    } else {
        document.body.style.overflow = '';
        window.removeEventListener('keydown', handleKeydown);
    }
});

onUnmounted(() => {
    document.body.style.overflow = '';
    window.removeEventListener('keydown', handleKeydown);
});
</script>

<style scoped>
.modal-transition-enter-active,
.modal-transition-leave-active {
    transition: all 0.3s ease-out;
}

.modal-transition-enter-from,
.modal-transition-leave-to {
    opacity: 0;
}

.modal-transition-enter-active .modal-card {
    transition: all 0.3s cubic-bezier(0.34, 1.56, 0.64, 1); /* Efeito elástico sutil ao abrir */
}

.modal-transition-leave-active .modal-card {
    transition: all 0.2s cubic-bezier(0.4, 0, 0.2, 1);
}

.modal-transition-enter-from .modal-card {
    opacity: 0;
    transform: scale(0.95) translateY(10px);
}

.modal-transition-leave-to .modal-card {
    opacity: 0;
    transform: scale(0.95) translateY(10px);
}
</style>

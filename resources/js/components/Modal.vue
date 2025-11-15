<template>
  <Transition name="modal-transition">

    <div
      v-if="modelValue"
      @click="closeModal"
      class="fixed inset-0 z-40 flex items-center justify-center p-4
             bg-slate-900/60 backdrop-blur-sm"
    >
      <div
        @click.stop
        class="modal-card w-full max-w-md flex flex-col overflow-hidden shadow-lg
               border border-slate-600 bg-slate-800/30 text-white
               rounded-lg"
      >
        <div class="flex items-center justify-between p-5 border-b border-slate-600">
          <slot name="header">
            <h3 class="text-lg font-semibold text-white">
              {{ title }}
            </h3>
          </slot>

          <button @click="closeModal" class="text-gray-300 hover:text-white p-1 -mt-1 -mr-1">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
            </svg>
          </button>
        </div>

        <div class="p-6">
          <slot />
        </div>

        <div v-if="$slots.footer" class="flex justify-end gap-3 p-5 border-t border-slate-600 bg-slate-800/30">
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
    default: 'Título Padrão',
  }
});

const emit = defineEmits(['update:modelValue']);

const closeModal = () => {
  emit('update:modelValue', false);
};

// --- Fechar com 'Esc' ---
const handleKeydown = (e) => {
  if (e.key === 'Escape') {
    closeModal();
  }
};

watchEffect(() => {
  if (props.modelValue) {
    window.addEventListener('keydown', handleKeydown);
  } else {
    window.removeEventListener('keydown', handleKeydown);
  }
});

onUnmounted(() => {
  window.removeEventListener('keydown', handleKeydown);
});
</script>

<style>
/* --- Animação (Overlay) --- */
.modal-transition-enter-active,
.modal-transition-leave-active {
  transition: opacity 0.3s ease-in-out;
}

.modal-transition-enter-from,
.modal-transition-leave-to {
  opacity: 0;
}

/* --- Animação (Card 'Pop') --- */
.modal-transition-enter-active .modal-card,
.modal-transition-leave-active .modal-card {
  transition: all 0.3s cubic-bezier(0.52, 0.02, 0.19, 1.02);
}

/* MODIFICAÇÃO AQUI:
  - Removido: 'translateY(20px)'
*/
.modal-transition-enter-from .modal-card {
  opacity: 0;
  transform: scale(0.95);
}

.modal-transition-leave-to .modal-card {
  opacity: 0;
  transform: scale(0.95);
}
</style>

<script setup>
defineProps({
    type: {
        type: String,
        default: 'button',
    },
});
</script>

<template>
    <button :type="type" class="items-center px-4 py-2 bg-green border border-green-500 rounded-md font-semibold text-xs text-white uppercase tracking-widest shadow-sm hover:text-green-900 hover:bg-white focus:outline-none focus:border-blue-300 focus:ring focus:ring-blue-200 active:text-white active:bg-white-50 disabled:opacity-25 transition">
        <slot />
    </button>
</template>

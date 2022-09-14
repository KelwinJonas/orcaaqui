<script setup>
defineProps({
    type: {
        type: String,
        default: 'button',
    },
});
</script>

<template>
    <button :type="type" class="items-center px-1 py-0 bg-blue-500 border border-blue-500 rounded-md font-extrabold text-sm text-white uppercase tracking-widest shadow-sm focus:outline-none active:text-white active:bg-white-50 disabled:opacity-25 transition">
        <slot />
    </button>
</template>

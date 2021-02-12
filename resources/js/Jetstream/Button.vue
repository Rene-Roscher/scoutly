<template>
    <button :type="type" class="px-4 py-2 bg-primary hover:bg-primary-700 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest active:bg-primary-900 focus:outline-none focus:border-primary-900 focus:shadow-outline-primary transition ease-in-out duration-150">
        <slot></slot>
    </button>
</template>

<script>
    export default {
        props: {
            type: {
                type: String,
                default: 'submit',
            },
        }
    }
</script>

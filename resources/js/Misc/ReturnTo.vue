<template>
    <div>
        <div class="flex items-center">
            <inertia-link :href="href">
                <svg class="h-8 w-8 text-primary hover:text-primary-600 mr-2"  width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">  <path stroke="none" d="M0 0h24v24H0z"/>  <line x1="5" y1="12" x2="19" y2="12" />  <line x1="5" y1="12" x2="9" y2="16" />  <line x1="5" y1="12" x2="9" y2="8" /></svg>
            </inertia-link>
            <slot/>
        </div>
    </div>
</template>

<script>
    export default {
        props: {
            href: String
        }
    }
</script>

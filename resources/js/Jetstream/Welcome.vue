<template>
    <div>
        <div class="p-6 sm:px-20 bg-white border-b border-gray-200">
            <div>
                <jet-application-logo class="block h-12 w-auto" />
            </div>

            <div class="mt-8 text-2xl">
                Welcome to your Scoutly database!
            </div>

            <div class="mt-6 text-gray-500">
                Scoutly is a database of many companies, and it's completely free.
                This offers them a free advertising space. We are growing restive at and implemented ideas to turn.<br><br>
                Do not be surprised, this version of Scoutly is a beta v1, so it is possible that some bugs will appear, so we ask for your understanding and also that you report bugs.
            </div>
        </div>

    </div>
</template>

<script>
    import JetApplicationLogo from '@/Jetstream/ApplicationLogo'

    export default {
        components: {
            JetApplicationLogo,
        },
    }
</script>

<template>
    <div>
        <!-- Generate API Token -->
        <jet-form-section @submitted="submitStoreRequest">
            <template #title>
                Create Organization
            </template>

            <template #description>
                Add your company to the scoutly-database to have better chances for growth.
            </template>

            <template #form>
                <!-- Organisation Name -->
                <div class="col-span-6 sm:col-span-4">
                    <jet-label for="name" value="Name" />
                    <jet-input id="name" type="text" class="mt-1 block w-full" v-model="storeRequestForm.name" autofocus/>
                    <jet-input-error :message="storeRequestForm.errors.name" class="mt-2" />
                </div>
                <!-- Organisation Homepage -->
                <div class="col-span-6 sm:col-span-4">
                    <jet-label for="homepage" value="Homepage" />
                    <jet-input id="homepage" type="url" class="mt-1 block w-full" v-model="storeRequestForm.homepage"/>
                    <jet-input-error :message="storeRequestForm.errors.homepage" class="mt-2" />
                </div>
                <!-- Organisation Datacenter -->
                <div class="col-span-6 sm:col-span-4">
                    <jet-label for="datacenter" value="Datacenter" />
                    <jet-input id="datacenter" type="text" class="mt-1 block w-full" v-model="storeRequestForm.datacenter"/>
                    <jet-input-error :message="storeRequestForm.errors.datacenter" class="mt-2" />
                </div>
                <!-- Organisation Solution -->
                <div class="col-span-6 sm:col-span-4">
                    <jet-label for="solution" value="Webinterface Solution" />
                    <jet-input id="solution" type="text" class="mt-1 block w-full" v-model="storeRequestForm.solution"/>
                    <jet-input-error :message="storeRequestForm.errors.solution" class="mt-2" />
                </div>
                <!-- Organisation Legal -->
                <div class="col-span-6 sm:col-span-4">
                    <jet-label for="legal" value="Form of foundation (Legal)" />
                    <jet-input id="legal" type="text" class="mt-1 block w-full" v-model="storeRequestForm.legal"/>
                    <jet-input-error :message="storeRequestForm.errors.legal" class="mt-2" />
                </div>
                <!-- Organisation Type -->
                <div class="col-span-6 sm:col-span-4">
                    <jet-label for="type" value="Oriented to"/>
                    <select id="type" class="form-select mt-1 block w-full border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm" v-model="storeRequestForm.type">
                        <option value="B2C">Business to Customer (B2C)</option>
                        <option value="B2B">Business to Business (B2B)</option>
                    </select>
                    <jet-input-error :message="storeRequestForm.errors.type" class="mt-2" />
                </div>
                <!-- Organisation Logo -->
                <div class="col-span-6 sm:col-span-4">
                    <jet-label for="logo" value="Logo (400x400)" />
                    <input id="logo" type="file" class="mt-1 block w-full" accept="image/*" ref="logo" v-on:change="storeAsDataURI" />
                    <jet-input-error :message="storeRequestForm.errors.logo" class="mt-2" />
                </div>
            </template>

            <template #actions>
                <jet-action-message :on="storeRequestForm.errors.message" class="mr-3">
                    <p class="text-red-600">{{ storeRequestForm.errors.message }}</p>
                </jet-action-message>
                <jet-action-message :on="storeRequestForm.recentlySuccessful && !storeRequestForm.errors.length >= 1" class="mr-3">
                    The request has been submitted and is being reviewed.
                </jet-action-message>

                <jet-button :class="{ 'opacity-25': storeRequestForm.processing }" :disabled="storeRequestForm.processing">
                    Send
                </jet-button>
            </template>
        </jet-form-section>

        <div v-if="organisations.length > 0">
            <jet-section-border />

            <!-- Manage API Tokens -->
            <div class="mt-10 sm:mt-0">
                <jet-action-section>
                    <template #title>
                        Manage Organizations
                    </template>

                    <template #description>
                        You may delete any of your existing organizations if they are no longer needed.
                    </template>

                    <!-- API Token List -->
                    <template #content>
                        <div class="space-y-6">
                            <div class="flex items-center justify-between" v-for="organisation in organisations" :key="organisation.id">
                                <div>
                                    {{ organisation.name }}
                                </div>

                                <div class="flex items-center">
                                    <div class="text-sm text-gray-400">
                                        {{ organisation.state }}
                                    </div>

                                    <button class="cursor-pointer ml-6 text-sm text-red-500" @click="confirmOrganisationDeletion(organisation.id)">
                                        Delete
                                    </button>
                                </div>
                            </div>
                        </div>
                    </template>
                </jet-action-section>
            </div>
        </div>

        <!-- Delete Organisation Confirmation Modal -->
        <jet-confirmation-modal :show="organisationBeingDeleted" @close="organisationBeingDeleted = null">
            <template #title>
                Delete Organisation
            </template>

            <template #content>
                Are you sure you would like to delete this organization?
            </template>

            <template #footer>
                <jet-secondary-button @click.native="organisationBeingDeleted = null">
                    Nevermind
                </jet-secondary-button>

                <jet-danger-button class="ml-2" @click.native="deleteOrganisation" :class="{ 'opacity-25': deleteOrganisationForm.processing }" :disabled="deleteOrganisationForm.processing">
                    Delete
                </jet-danger-button>
            </template>
        </jet-confirmation-modal>
    </div>
</template>

<script>
    import JetActionMessage from '@/Jetstream/ActionMessage'
    import JetActionSection from '@/Jetstream/ActionSection'
    import JetButton from '@/Jetstream/Button'
    import JetConfirmationModal from '@/Jetstream/ConfirmationModal'
    import JetDangerButton from '@/Jetstream/DangerButton'
    import JetDialogModal from '@/Jetstream/DialogModal'
    import JetFormSection from '@/Jetstream/FormSection'
    import JetInput from '@/Jetstream/Input'
    import JetCheckbox from '@/Jetstream/Checkbox'
    import JetInputError from '@/Jetstream/InputError'
    import JetLabel from '@/Jetstream/Label'
    import JetSecondaryButton from '@/Jetstream/SecondaryButton'
    import JetSectionBorder from '@/Jetstream/SectionBorder'
    import FileInput from "@/Jetstream/FileInput";

    export default {
        components: {
            JetActionMessage,
            JetActionSection,
            JetButton,
            JetConfirmationModal,
            JetDangerButton,
            JetDialogModal,
            JetFormSection,
            JetInput,
            JetCheckbox,
            JetInputError,
            JetLabel,
            JetSecondaryButton,
            JetSectionBorder,
        },
        name: "StoreRequest",
        props: {
            organisations: Array,
        },
        data() {
            return {
                storeRequestForm: this.$inertia.form({
                    name: '',
                    homepage: '',
                    solution: '',
                    datacenter: '',
                    legal: '',
                    type: '',
                    logo: '',
                }),

                deleteOrganisationForm: this.$inertia.form(),

                organisationBeingDeleted: null,
            }
        },
        methods: {
            submitStoreRequest() {
                this.storeRequestForm.post(route('organisation.store'), {
                    preserveScroll: true,
                    onSuccess: () => {
                        this.storeRequestForm.reset()
                    }
                })
            },
            confirmOrganisationDeletion(id) {
                this.organisationBeingDeleted = id
            },
            deleteOrganisation() {
                this.deleteOrganisationForm.delete(route('organisation.destroy', this.organisationBeingDeleted), {
                    preserveScroll: true,
                    preserveState: true,
                    onSuccess: () => (this.organisationBeingDeleted = null),
                })
            },
            storeAsDataURI() {
                const reader = new FileReader();

                reader.onload = (e) => {
                    this.storeRequestForm.logo = e.target.result;
                };

                reader.readAsDataURL(document.getElementById('logo').files[0]);
            },
        }
    }
</script>

<style scoped>

</style>

<template>
    <div class="submit-section-vue">

        <p class="lead">
            If you wish to save your changes and return to the home page, use the following link.
        </p>

        <button class="btn btn-warning mb-3"
            v-on:click="saveAndQuit()">Save and Quit</button>

        <p class="lead">
            If this assessment is complete and you wish to start the submission process, use the following link.
        </p>

        <div class="alert alert-warning" v-if="assessment.submitted">
            This assessment has already been submitted. Are you sure you want to do it again?
        </div>

        <button class="btn btn-danger mb-3"
            v-on:click="submit()">Submit</button>

        <div v-if="waiting" class="alert alert-info">
            I am processing your request, please wait...
        </div>

        <div v-if="successful" class="alert alert-success">
            Assessment saved successfully. Returning home...
        </div>

        <template v-if="unsuccessful">
            <template v-if="errorHasMessage(errors)">
                <div class="alert alert-danger">
                    {{ errors.message }}
                </div>
                <div class="alert alert-warning" v-for="(msgs, key) in errors.errors">
                    {{ key }}
                    <template v-for="msg in msgs">
                        {{ msg }}
                    </template>
                </div>
            </template>
            <template v-if="connectionError">
                <div class="alert alert-danger">
                    Connection error.
                </div>
            </template>
        </template>

    </div>
</template>

<script>
    import FormMixin from '../../mixins/form.js'

    export default {
        props: ['assessment', 'baseUrl'],
        mixins: [FormMixin],
        data() {
            return {
                submitAvailable: true,
                successful: false,
                unsuccessful: false,
                waiting: false,
                connectionError: false,
                errors: []
            }
        },
        computed: {
            completedParts() {
                return this.$store.getters.getCompletedParts
            },
            completedImprovements() {
                return this.$store.getters.getCompletedImprovements
            }
        },
        methods: {
            errorHasMessage(error) {
                return _.has(error, 'message')
            },
            saveAndQuit() {
                this.waiting = true
                this.submitEditForm(false)
            },
            submit() {
                this.waiting = true
                this.connectionError = false
                this.submitEditForm(true)
            },
            respondToSuccess(data) {
                this.waiting = false
                this.successful = true
                this.unsuccessful = false
                setTimeout(() => {
                  window.location.replace(this.baseUrl)
                }, 1200)
            },
            respondToFailure(errors, requestFailure = false) {
                this.waiting = false
                this.successful = false
                this.unsuccessful = true
                if (requestFailure) {
                    this.connectionError = true
                } else {
                    this.errors = errors
                    this.$emit('formErrors', errors)
                }

            }
        }
    }
</script>

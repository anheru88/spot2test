<template>
    <div>
        <div class="modal fade" id="addUrlModal" tabindex="-1" aria-labelledby="addUrlModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="addUrlModalLabel">Add New URL</h5>
                        <button type="button" class="btn-close" @click="closeModal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form @submit.prevent="addUrl">
                            <div class="mb-3">
                                <label for="originalUrlInput" class="form-label">Original URL</label>
                                <input type="url" class="form-control" id="originalUrlInput" v-model="originalUrl" required>
                            </div>
                            <button type="submit" class="btn btn-primary">Add URL</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import axios from 'axios';

export default {
    props: {
        value: Boolean
    },
    data() {
        return {
            originalUrl: ''
        };
    },
    methods: {
        addUrl() {
            axios.post('/api/urls', { original_url: this.originalUrl })
                .then(response => {
                    this.$emit('url-added');
                    this.originalUrl = '';
                    this.$emit('update:value', false);
                })
                .catch(error => {
                    console.error(error);
                });
        },
        closeModal() {
            this.originalUrl = '';
            this.$emit('update:value', false);
        }
    },
    watch: {
        value(newValue) {
            if (newValue) {
                $('#addUrlModal').modal('show');
            } else {
                $('#addUrlModal').modal('hide');
            }
        }
    }
};
</script>

<style>
/* No additional styles needed */
</style>

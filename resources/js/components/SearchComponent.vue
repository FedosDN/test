<template>
    <div class="container" style="margin: 10px auto">
        <div class="row justify-content-center">
            <div class="card">
                <div class="card-header">Search city by zip code or name</div>

                <div class="card-body">
                    <label>
                        <input class="form-control"
                               placeholder="Search..."
                               type="text"
                               ref="phrase"
                               v-bind:value="this.phrase"
                               v-on:input="handleSearchChanged"
                        >
                    </label>
                </div>
                <div class="card-footer"></div>
            </div>
        </div>
    </div>
</template>

<script>
    import _ from 'lodash'

    const vm = {
        name: "SearchComponent",
        data: () => ({
            phrase: ''
        }),
        methods: {
            updateFilters() {
                this.$emit('update:phrase', this.$refs.phrase.value);
            },
            handleSearchChanged: _.debounce(function() {
                this.updateFilters();
            }, 500),
        },
    }

    export default vm;
</script>

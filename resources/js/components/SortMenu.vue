<template>
    <div>
        <select v-model="sortType" @change="changeSort(sortType)" class="form-control">
            <option v-for="item in sortOptions" v-bind:value="item" v-bind:key="item">{{item}}</option>
        </select>
    </div>
</template>

<script>
    export default {
        props: ['restaurant_id'],

        mounted() {
            console.log('Component mounted.')
        },

        data: function() {
            return {
                sortType: new URLSearchParams(window.location.search).get('sort') || (this.restaurant_id ? 'new' : 'default'),
                sortOptions: this.restaurant_id ? ['new', 'old', 'best', 'worst'] : ['default', 'best']
            };
        },

        methods: {
            changeSort(sortType) {
                window.location = '/restaurants/' + (this.restaurant_id || '') + '?sort=' + sortType;
            }
        }
    }
</script>
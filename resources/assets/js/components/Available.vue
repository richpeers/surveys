<template>
    <div class="question">
        <div class="q-head">
            <div class="q-title">
                <span class="q-icon"><i class="fa fa-lg" v-bind:class="icon"></i></span>
                <span class="q-type">{{type}}</span>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        props: {
            params: {
                type: Object,
                required: true
            }
        },
        computed: {
            icon () {
                return this.params.icon;
            },
            type () {
                return this.params.type;
            }
        }
    }
</script>
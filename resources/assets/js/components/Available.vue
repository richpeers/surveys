<template>
    <div class="question">
        <div class="q-head">
            <div class="q-title">
                <span class="q-icon"><i class="fa fa-lg" v-bind:class="iconClass"></i></span>
                <span class="q-type">{{type}}</span>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        props: {
            type: {
                type: String,
                required: true
            },
            icon: {
                type: String,
                required: true
            }
        },
        computed: {
            iconClass () {
                return {
                    [this.icon]: true,
                }
            }
        }
    }
</script>
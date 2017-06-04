<template>
    <div class="question">
        <div class="q-head">
            <div class="q-title">
                <span class="q-icon"><i class="fa fa-lg" v-bind:class="iconClass"></i></span>
                <span class="q-type">{{params.type}}</span>
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
            iconClass () {
                return {
                    [this.params.icon]: true,
                }
            }
        }
    }
</script>
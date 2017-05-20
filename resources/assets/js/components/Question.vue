<template>
    <div class="question">
        <div class="q-head">
            <div class="q-handle"><i class="fa fa-bars"></i></div>
            <div class="q-title" v-on:click="toggleBody">
                <span class="q-left">{{question.title}}</span>
                <span class="q-right"><i class="fa fa-caret-down"></i></span>
            </div>
            <div class="q-right" v-on:click="removeQuestion"><i class="fa fa-times"></i></div>
        </div>
        <div class="q-body" v-show="question.showBody">
            <p>body is visible</p>
        </div>
    </div>
</template>

<script>
    export default {
        props: {
            index: {
                type: Number,
                required: true
            },
            question: {
                type: Object,
                required: true
            }
        },
        methods: {
            removeQuestion () {
                this.$emit('remove_question', this.index);
            },
            toggleBody () {
                this.$emit('toggle_question_body', this.index);
            }
        }
    }
</script>

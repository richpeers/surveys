<template>
    <div class="question">
        <div class="q-head">
            <div class="q-handle"><i class="fa fa-bars"></i></div>
            <div class="q-title" v-on:click="toggleCollapse">
                <span class="q-left">{{question.title}}</span>
                <span class="q-right">
                    <i class="fa"
                       v-bind:class="question.showBody ? 'fa-caret-up' : 'fa-caret-down'">
                    </i>
                </span>
            </div>
            <div class="q-right" v-on:click="remove"><i class="fa fa-times"></i></div>
        </div>
        <div class="q-body" v-show="question.showBody" v-bind:class="{expanded: question.showBody}">

            <div class="field">
                <label class="label">Question</label>
                <p class="control">
                    <input class="input" type="text" v-model="question.title">
                </p>
            </div>

            <div class="field">
                <label class="label">Description</label>
                <p class="control">
                    <textarea class="textarea" v-model="question.description"></textarea>
                </p>
            </div>

        </div>
    </div>
</template>

<script>
    export default {
        props: {
            question: { // is synchronous because prop is object
                type: Object,
                required: true
            }
        },
        methods: {
            remove () {
                this.$emit('remove_question');
            },
            toggleCollapse () {
                this.$emit('toggle_collapse');
            }
        }
    }
</script>

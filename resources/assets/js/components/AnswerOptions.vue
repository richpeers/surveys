<template>
    <div id="answer-options">
        <label class="label">Answers</label>
        <draggable v-model="options" :options="dragOptions">
            <answer-option v-for="(option, index) in options" :key="index"
                           :question-index="questionIndex"
                           :index="index"
                           :option="option">
            </answer-option>
        </draggable>
    </div>
</template>

<script>
    import draggable from 'vuedraggable';
    import AnswerOption from './AnswerOption.vue';

    export default {
        name: 'answer-options',
        components: {draggable,AnswerOption},
        props: {
            questionIndex: {
                type: Number,
                required: true
            }
        },
        data: () => ({
            dragOptions: {name: 'options', animation: 150, handle: '.o-handle'}
        }),
        computed: {
            options: {
                get() {
                    return this.$store.getters.getAnswerOptions(this.questionIndex);
                },
                set(value) { // necessary for SortableJS/Vue.Draggable with Vuex
                    this.$store.commit('updateAnswerOptions', {index: this.questionIndex, value});
                }
            },
        }
    }
</script>

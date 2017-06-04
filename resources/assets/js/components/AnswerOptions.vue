<template>
    <div id="answer-options">
        <label class="label">Answers</label>
        <draggable
                   v-model="options"
                   :options="dragOptions">
            <answer-option v-for="(option, index) in options"
                           :key="index"
                           :answer="option.answer"
                           :can-comment="option.canComment">
            </answer-option>
        </draggable>

    </div>
</template>

<script>
    import AnswerOption from './AnswerOption.vue';

    export default {
        components: {
            AnswerOption
        },
        props: {
            answerOptions: {
                type: Array,
                default () {
                    return [];
                }
            }
        },
        data () {
            return {
                dragOptions: {animation: 150, handle: '.o-handle'},
                options: this.answerOptions
            }
        }
    }
</script>
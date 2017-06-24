<template>
    <div id="answer-options" class="field">
        <div class="field">
            <label class="label">Answers</label>
            <draggable v-model="options" :options="dragOptions">
                <answer-option v-for="(option, index) in options" :key="index"
                               :question-index="questionIndex"
                               :index="index"
                               :option="option">
                </answer-option>
            </draggable>
        </div>

        <div class="has-text-right">
            <a @click="addAnswer">Add answer</a>
        </div>


        <div class="field">
            <p class="control">
                <label :for="'comment-placeholder-' + questionIndex" class="label">Comment Placeholder</label>
                <input :id="'comment-placeholder-' + questionIndex" class="input" type="text"
                       v-model="commentPlaceholder" :disabled="!canCommentOnOption">
            </p>
        </div>

    </div>
</template>

<script>
    import draggable from 'vuedraggable';
    import AnswerOption from './AnswerOption.vue';

    export default {
        name: 'answer-options',
        components: {draggable, AnswerOption},
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
            commentPlaceholder: {
                get() {
                    return this.$store.getters.getQuestion(this.questionIndex).commentPlaceholder;
                },
                set(value) {
                    return this.$store.commit('updateQuestionProperty', {
                        index: this.questionIndex,
                        property: 'commentPlaceholder',
                        value
                    })
                }
            },
            canCommentOnOption () {
                for (let option of this.options) {
                    if (option.canComment === true) {
                        return true;
                    }
                }
                return false;
            }
        },
        methods: {
            addAnswer () {
                this.$store.commit('addAnswerOption', this.questionIndex);
            }
        }
    }
</script>

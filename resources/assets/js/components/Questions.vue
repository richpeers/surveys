<template>
    <div class="columns is-gapless">

        <div class="column">
            <div class="field title-edit">
                <p class="control has-icons-right">
                    <input class="input" type="text" v-model="title" autofocus/>
                    <span class="icon is-right"> <i class="fa fa-pencil-square-o"></i></span>
                </p>
            </div>
            <draggable v-model="questions" :options="DragQuestion" @add="onAdd"
                       id="questions" v-bind:class="{ 'obvious-drop-area': questionsEmpty }">
                <question v-for="(question, index) in questions" :key="index"
                          :index="index"
                          :question="question"
                          :params="questionTypeParams[question.type_id]"
                ></question>
            </draggable>
        </div>

        <div class="column">
            <h2 class="title available-title">Question Types
                <span class="subtitle"><i> - drag & drop into {{title}}</i></span>
            </h2>
            <draggable v-model="available" :options="DragAvailable"
                       id="available" :clone="clone">
                <available v-for="(question, index) in available" :key="index"
                           :params="questionTypeParams[question.type_id]"
                ></available>
            </draggable>
        </div>



    </div>
</template>

<script>
    import cloneDeep from 'lodash.clonedeep';

    import draggable from 'vuedraggable';
    import Question from './Question.vue';
    import Available from './Available.vue';

    export default {
        components: {draggable, Question, Available},
        data: () => ({
            DragAvailable: {group: {name: 'survey', pull: 'clone', put: false}, sort: false},
            DragQuestion: {group: 'survey', animation: 150, handle: '.q-handle'},
            editTitle: false,
            title: "New Survey"
        }),
        computed: {
            questions: {
                get() {
                    return this.$store.getters.getQuestions
                },
                set(value) { // necessary for SortableJS/Vue.Draggable with Vuex
                    this.$store.commit('updateQuestions', value);
                }
            },
            questionTypeParams () {
                return this.$store.getters.getQuestionTypeParams;
            },
            available () {
                return this.$store.getters.getAvailableQuestions;
            },
            questionsEmpty () {
                return !this.questions.length;
            }
        },
        methods: {
            clone (el) {
                return cloneDeep(el); // lodash.clonedeep 4.17.4
            },
            onAdd (evt) {
                this.$store.dispatch('expand', evt.newIndex);
            }
        }
    }
</script>

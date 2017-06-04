<template>
    <div class="columns is-gapless">

        <div class="column">

            <div class="field title-edit">
                <p class="control has-icons-right">
                    <input class="input" type="text" v-model="title" autofocus/>
                    <span class="icon is-right"> <i class="fa fa-pencil-square-o"></i></span>
                </p>
            </div>


            <draggable id="questions"
                       v-bind:class="{ 'obvious-drop-area': questionsEmpty }"
                       v-model="SurveyQuestions"
                       :options="DragQuestion" v-on:add="onAdd">
                <question v-for="(q, index) in SurveyQuestions"
                          :key="index"
                          :params="QuestionTypeParams[q.type_id]"
                          :title="q.title"
                          :description="q.description"
                          :answer-options="q.options"
                          :required="q.required"
                          :show-body="q.showBody"
                          @update:title="title => q.title = title"
                          @update:description="description => q.description = description"
                          @change:required="required => q.required = required"
                          v-on:remove_question="remove(index)"
                          v-on:toggle_collapse="toggleCollapse(index)">
                </question>
            </draggable>
        </div>

        <div class="column">
            <h2 class="title available-title">Question Types
                <span class="subtitle"><i> - drag & drop into {{title}}</i></span>
            </h2>
            <draggable id="available"
                       v-model="AvailableQuestions"
                       :options="DragAvailable"
                       :clone="clone">
                <available v-for="(q, index) in AvailableQuestions"
                           v-bind:key="index"
                           :params="QuestionTypeParams[q.type_id]">
                </available>
            </draggable>
        </div>

    </div>
</template>

<script>
    import {AvailableQuestions, SurveyQuestions, QuestionTypeParams} from '../utils/sharedState.js';
    import cloneDeep from 'lodash.clonedeep';

    import Available from './Available.vue';
    import Question from './Question.vue';

    export default {
        components: {
            Available,
            Question
        },
        data: () => ({
            AvailableQuestions,
            SurveyQuestions,
            QuestionTypeParams,
            DragAvailable: {group: {name: 'survey', pull: 'clone', put: false}, sort: false},
            DragQuestion: {group: 'survey', animation: 150, handle: '.q-handle'},
            editTitle: false,
            title: "New Survey"
        }),
        computed: {
            questionsEmpty () {
                return !this.SurveyQuestions.length;
            }
        },
        methods: {
            clone (el) {
                return cloneDeep(el); // lodash.clonedeep 4.17.4
            },
            onAdd (evt) {
                this.expand(evt.newIndex);
            },
            expand (index) {
                this.collapseAll();
                this.SurveyQuestions[index].showBody = true;
            },
            collapseAll () {
                for (let question of this.SurveyQuestions) {
                    question.showBody = false;
                }
            },
            toggleCollapse (index) {
                this.SurveyQuestions[index].showBody ? this.collapseAll() : this.expand(index);
            },
            remove (index) {
                this.SurveyQuestions.splice(index, 1);
            }
        }
    }
</script>

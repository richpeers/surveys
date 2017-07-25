<template>
    <div class="columns is-gapless">

        <div class="column">
            <div class="field title-edit">
                <p class="control has-icons-right">
                    <input class="input val" type="text" v-model="title"
                           placeholder="Enter survey name"
                           :class="{'is-danger': !$v.title.required}" autofocus />
                    <span class="icon is-right"> <i class="fa fa-pencil-square-o"></i></span>
                </p>
            </div>
            <draggable id="questions"
                       v-model="questions"
                       :options="DragQuestion"
                       v-bind:class="{ 'obvious-drop-area': questionsEmpty }">
                <question v-for="(question, index) in questions" :key="index"
                          :index="index"
                          :question="question"
                          :params="questionTypeParams[question.type_id]"
                          :$v="$v.questions.$each[index]"
                ></question>
            </draggable>
            <div class="field">
                <p class="control has-text-right">
                    <span v-if="!isLoggedIn">
                        <button href="#" class="button is-link" disabled>Find out more..</button>
                        <button href="/register" class="button is-primary" disabled>Register</button>
                        <button class="button is-danger is-outlined" disabled>Save</button>
                    </span>
                    <button v-else @click="save" class="button is-danger is-outlined" :disabled="$v.$invalid">Save
                    </button>
                </p>
            </div>
        </div>

        <div class="column">
            <h2 class="title available-title">Question Types
                <span class="subtitle"><i> - drag & drop into {{title}}</i></span>
            </h2>
            <draggable id="available"
                       v-model="available"
                       :options="DragAvailable"
                       :clone="clone">
                <available v-for="(question, index) in available"
                           :key="index"
                           :params="questionTypeParams[question.type_id]"
                ></available>
            </draggable>
        </div>

    </div>
</template>

<script>
    import draggable from 'vuedraggable';
    import Question from './Question.vue';
    import Available from './Available.vue';

    import {required, numeric, maxLength, between, requiredIf} from 'vuelidate/lib/validators'

    export default {
        components: {draggable, Question, Available},
        data: () => ({
            DragAvailable: {group: {name: 'survey', pull: 'clone', put: false}, sort: false},
            DragQuestion: {group: 'survey', animation: 150, handle: '.q-handle'},
            editTitle: false,
        }),
        computed: {
            isLoggedIn() {
                return isLoggedIn;
            },
            questions: {
                get() {
                    return this.$store.getters.getQuestions
                },
                set(value) { // necessary for SortableJS/Vue.Draggable with Vuex
                    this.$store.commit('updateQuestions', value);
                }
            },
            questionTypeParams() {
                return this.$store.getters.getQuestionTypeParams;
            },
            available() {
                return this.$store.getters.getAvailableQuestions;
            },
            questionsEmpty() {
                return !this.questions.length;
            },
            title: {
                get() {
                    return this.$store.getters.getTitle;
                },
                set(value) {
                    this.$store.commit('updateTitle', value)
                }
            }
        },
        validations: {
            title: {
                required,
                maxLength: maxLength(140),
            },
            questions: {
                required,
                $each: {
                    title: {
                        required,
                        maxLength: maxLength(140),
                    },
                    description: {
                        maxLength: maxLength(255),
                    },
                    options: {
                        requiredIf: requiredIf((key) => {
                            return key.type_id === 2 || key.type_id === 3 || key.type_id === 4
                        }),
                        $each: {
                            answer: {
                                required,
                                maxLength: maxLength(140),
                            }
                        }
                    }
                }
            }
        },
        methods: {
            clone(el) {
                return cloneDeep(el); // lodash.clonedeep 4.17.4
            },
            save() {
                this.$store.dispatch('saveNewSurvey', {
                    title: this.title,
                    questions: this.questions
                });
            }
        }
    }
</script>

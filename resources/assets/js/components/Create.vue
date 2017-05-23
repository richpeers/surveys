<script>
    import {AvailableQuestions, SurveyQuestions} from '../utils/sharedState.js';

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
            DragAvailable: {group: {name: 'survey', pull: 'clone', put: false}, sort: false},
            DragQuestion: {group: 'survey', animation: 150, handle: '.q-handle'},

        }),
        computed: {
            questionsEmpty () {
                return !this.SurveyQuestions.length;
            }
        },
        methods: {
            clone (el) {
                return JSON.parse(JSON.stringify(el));
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

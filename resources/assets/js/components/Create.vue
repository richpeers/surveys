<script>
    //    Vue.component('question', require('./Question.vue'));
    import Question from './Question.vue';
    import AvailableQuestion from './AvailableQuestion.vue';

    export default {
        components: {
            Question,
            AvailableQuestion
        },
        data () {
            return {
                DragQuestionOptions: {
                    group: 'survey',
                    animation: 150,
                    handle: '.q-handle'
                },
                DragAvailableOptions: {
                    group: {
                        name: 'survey',
                        pull: 'clone',
                        put: false
                    },
                    sort: false
                },
                available: [{
                    type: "Welcome page",
                    type_id: 1,
                    showBody: false,
                    title: "Tell us what you think!",
                    description: "Please take a moment to fill out this short survey to let us know how we did and where we can improve.",
                    titleLabel: "Title",
                    buttonText: "Start Survey",
                    required: 0
                }, {
                    type: "Radio buttons",
                    type_id: 2,
                    showBody: false,
                    title: "What question do you want to ask?",
                    description: "",
                    options: [{
                        answer: "Answer 1",
                        canComment: 0
                    }, {
                        answer: "Answer 2",
                        canComment: 0
                    }, {
                        answer: "Other",
                        canComment: 1
                    }],
                    required: 0
                }, {
                    type: "Checkboxes",
                    type_id: 3,
                    showBody: false,
                    title: "What question do you want to ask?",
                    description: "",
                    options: [{
                        answer: "Answer 1",
                        canComment: 0
                    }, {
                        answer: "Answer 2",
                        canComment: 0
                    }, {
                        answer: "Other",
                        canComment: 1
                    }],
                    required: 0
                }, {
                    type: "Dropdown list",
                    type_id: 4,
                    showBody: false,
                    title: "What question do you want to ask?",
                    description: "",
                    options: [{
                        answer: "Answer 1",
                        canComment: 0
                    }, {
                        answer: "Answer 2",
                        canComment: 0
                    }, {
                        answer: "Answer 3",
                        canComment: 0
                    }],
                    required: 0,
                }, {
                    type: "Single line text",
                    type_id: 5,
                    showBody: false,
                    title: "What question do you want to ask?",
                    description: "",
                    required: 0,
                }, {
                    type: "Multiple line text",
                    type_id: 6,
                    showBody: false,
                    title: "What question do you want to ask?",
                    description: "",
                    required: 0,
                }, {
                    type: "Email address",
                    type_id: 7,
                    showBody: false,
                    title: "Enter your email",
                    description: "",
                    required: 1,
                }, {
                    type: "Rating",
                    type_id: 8,
                    showBody: false,
                    title: "How would you rate us?",
                    description: "",
                    required: 1,
                }, {
                    type: "Success page",
                    type_id: 9,
                    showBody: false,
                    title: "Thank you!",
                    description: "Your feedback is very important to us.",
                    required: 0,
                }],
                questions: [{
                    type: "Multiple line text",
                    type_id: 6,
                    showBody: false,
                    title: "What question do you want to ask?",
                    description: "",
                    required: 0,
                }, {
                    type: "Success page",
                    type_id: 9,
                    showBody: false,
                    title: "Thank you!",
                    description: "Your feedback is very important to us.",
                    required: 0,
                }]
            }

        },
        computed: {
            questionsEmpty () {
                return this.questions.length < 1;
            }
        },
        methods: {
            clone (el) {
                return JSON.parse(JSON.stringify(el));
            },
            onAddQuestion (evt) {
                this.showQuestionBody(evt.newIndex);
            },
            removeQuestion (index) {
                this.questions.splice(index, 1);
            },
            hideQuestionBodyAll () {
                var i;
                for (i = 0; i < this.questions.length; ++i) {
                    this.questions[i].showBody = false;
                }
            },
            showQuestionBody (index) {
                this.hideQuestionBodyAll();
                this.questions[index].showBody = true;
            },
            toggleQuestionBody (index) {
                if (this.questions[index].showBody) {
                    this.hideQuestionBodyAll();
                } else {
                    this.showQuestionBody(index);
                }
            }
        }
    }
</script>
